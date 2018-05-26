<?php

namespace App\Http\Controllers;

use App\Entities\Client;
use App\Entities\EventModel;
use App\Entities\Payment;
use App\Entities\Product;
use App\Entities\Service;
use App\Repositories\CashFlowRepository;
use Carbon\Carbon;
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
        $this->validator = $validator;
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
        $services = Service::where('status' ,'waiting')->where('scheduled_day', Carbon::now(-3)->format('Y-m-d'))->orderBy('scheduled_hour')->get();

        $clients = Client::all()->pluck('name', 'id');
        $payments = Payment::all();
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $services,
            ]);
        }

        return view('schedules.index', compact('services', 'clients', 'payments'));
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
            if($data['select_day'] == 'today') {
                $data['scheduled_day'] = Carbon::now(-3)->format('Y-m-d');
            } elseif ($data['select_day'] == 'tomorrow') {
                $data['scheduled_day'] = Carbon::now(-3)->addDay()->format('Y-m-d');
            }
            if (!isset($data['scheduled_day'])) {
                $data['scheduled_day'] = Carbon::now(-3)->format('Y-m-d');
            }
            $hour = explode(':',$data['scheduled_hour']);
            $eventModel = EventModel::create(['title'=> Client::find($data['client_id'])->name, 'all_day' => 0,
                'start' => Carbon::parse($data['scheduled_day'])->addHour($hour[0])->addMinutes(isset($hour[1]) ? $hour[1] : 0),
                'end' => Carbon::parse($data['scheduled_day'])->addHour($hour[0]+1)->addMinutes(isset($hour[1]) ? $hour[1] : 0)]);

            $data['status'] = 'waiting';
            $service = $this->repository->create($data);

            $response = [
                'message' => 'Agendamento feito',
                'data' => $service->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
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
        $products = Product::all()->pluck('name', 'id');
        $serviceItems = $service->items;
        $valorTotal = 0;
        foreach ($serviceItems as $servicei) {
            $valorTotal += $servicei->product->price->price;
            if ($servicei->discount) {
                $valorTotal -= $servicei->discount;
            }
        }
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $service,
            ]);
        }

        return view('schedules.show', compact('service', 'serviceItems', 'products', 'valorTotal'));
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
        $clients = Client::all()->pluck('name', 'id');
        return view('schedules.edit', compact('service', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ServiceUpdateRequest $request
     * @param  string $id
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
                'message' => 'Agendamento atualizado.',
                'data' => $service->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
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
                'message' => 'Serviço deletado.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Serviço deletado');
    }

    public function done(Request $request)
    {
        $dataRequest = $request->all();
        $service = $this->repository->find($dataRequest['service_id']);

        if ($service->items->isEmpty()) {
            return redirect(route('schedules.index'))->with('error', 'Adicione um serviço');
        }

        $data['status'] = "done";
        $namesServices = "";
        $valorService = 0;

        foreach ($service->items as $key => $item) {
            $valorService += $item->product->price->price;
            $namesServices = $namesServices . "," . $item->product->name;
            if ($item->discount) {
                $valorService -= $item->discount;
            }
        }

        $this->createInputStream($valorService, $dataRequest, $namesServices);

        $this->repository->update($data, $dataRequest['service_id']);

        return redirect()->back()->with('message', 'Serviço finalizado e entrada de caixa criada');
    }

    private function createInputStream($valorService, $dataRequest, $namesServices)
    {
        if ($dataRequest['value_credit']) {
            $dataFlow['payment_id'] = 2;
        } else {
            $dataFlow['payment_id'] = 1;
        }
        $dataFlow['service_id'] = $dataRequest['service_id'];
        $dataFlow['value'] = $valorService;
        $dataFlow['type'] = 'input_stream';
        $dataFlow['description'] = 'Serviço concluído' . $namesServices;
        $dataFlow['day'] = Carbon::now(-3)->toDateString();

        $inputStream = $this->getCashFlowRepository()->create($dataFlow);
    }

    public function filterByDate(Request $request)
    {
        $data = $request->all();
        $services = $this->repository->findWhere(['status' => 'waiting', 'scheduled_day' => $data['filter_date']]);

        $clients = Client::all()->pluck('name', 'id');
        $payments = Payment::all();
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $services,
            ]);
        }

        return view('schedules.index', compact('services', 'clients', 'payments'));
    }
}
