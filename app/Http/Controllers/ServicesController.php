<?php

namespace App\Http\Controllers;

use App\Entities\Client;
use App\Entities\Product;
use App\Repositories\CashFlowRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ServiceCreateRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Repositories\ServiceRepository;
use App\Validators\ServiceValidator;

/**
 * Class ServicesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ServicesController extends Controller
{
    /**
     * @var ServiceRepository
     */
    protected $repository;

    /**
     * @var CashFlowRepository
     */
    protected $cashFlowRepository;

    /**
     * @var ServiceValidator
     */
    protected $validator;

    /**
     * ServicesController constructor.
     *
     * @param ServiceRepository $repository
     * @param ServiceValidator $validator
     */
    public function __construct(ServiceRepository $repository, ServiceValidator $validator, CashFlowRepository $cashFlowRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->cashFlowRepository = $cashFlowRepository;
    }

    /**
     * @return CashFlowRepository
     */
    public function getCashFlowRepository()
    {
        return $this->cashFlowRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $services = $this->repository->findWhere(['status'=>'waiting']);

        $clients = Client::all()->pluck('name','id');

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $services,
            ]);
        }

        return view('schedules.index', compact('services','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ServiceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ServiceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data = $request->all();
            $data['status'] = 'waiting';
            $service = $this->repository->create($data);

            $response = [
                'message' => 'Serviço criado',
                'data'    => $service->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = $this->repository->find($id);
        $products = Product::all()->pluck('name','id');
        $serviceItems = $service->items;
        $valorTotal = 0;
        foreach ($serviceItems as $servicei)
        {
            $valorTotal += $servicei->product->price->price;
            if($servicei->discount)
            {
                $valorTotal -= $servicei->discount;
            }
        }
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $service,
            ]);
        }

        return view('schedules.show', compact('service','serviceItems','products','valorTotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = $this->repository->find($id);
        $clients = Client::all()->pluck('name','id');
        return view('schedules.edit', compact('service','clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ServiceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ServiceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $service = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Service updated.',
                'data'    => $service->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Service deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Service deleted.');
    }

    public function done($id)
    {
        $service = $this->repository->find($id);
        $data['status'] = "done";
        $valorService = 0;
        foreach($service->items as $item){
            $valorService += $item->product->price->price;
            if($item->discount)
            {
                $valorService -= $item->discount;
            }
        }
        $dataFlow['value'] = $valorService;
        $dataFlow['type'] = 'input_stream';
        $dataFlow['description'] = 'Serviço concluído';

        $inputStream = $this->getCashFlowRepository()->create($dataFlow);

        $serviceUpdate = $this->repository->update($data, $id);

        return redirect()->back()->with('message', 'Serviço finalizado e entrada de caixa criada');
    }
}
