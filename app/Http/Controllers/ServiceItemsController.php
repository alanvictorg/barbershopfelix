<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ServiceItemCreateRequest;
use App\Http\Requests\ServiceItemUpdateRequest;
use App\Repositories\ServiceItemRepository;
use App\Validators\ServiceItemValidator;

/**
 * Class ServiceItemsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ServiceItemsController extends Controller
{
    /**
     * @var ServiceItemRepository
     */
    protected $repository;

    /**
     * @var ServiceItemValidator
     */
    protected $validator;

    /**
     * ServiceItemsController constructor.
     *
     * @param ServiceItemRepository $repository
     * @param ServiceItemValidator $validator
     */
    public function __construct(ServiceItemRepository $repository, ServiceItemValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $serviceItems = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $serviceItems,
            ]);
        }

        return view('serviceItems.index', compact('serviceItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ServiceItemCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ServiceItemCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $data = $request->all();

            $serviceItem = $this->repository->create($data);

            $response = [
                'message' => 'Serviço adicionado',
                'data'    => $serviceItem->toArray(),
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
        $serviceItem = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $serviceItem,
            ]);
        }

        return view('serviceItems.show', compact('serviceItem'));
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
        $serviceItem = $this->repository->find($id);

        return view('serviceItems.edit', compact('serviceItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ServiceItemUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ServiceItemUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $serviceItem = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ServiceItem updated.',
                'data'    => $serviceItem->toArray(),
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
                'message' => 'Item excluído.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Item excluído.');
    }
}
