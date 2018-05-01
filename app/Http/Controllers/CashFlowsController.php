<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CashFlowCreateRequest;
use App\Http\Requests\CashFlowUpdateRequest;
use App\Repositories\CashFlowRepository;
use App\Validators\CashFlowValidator;

/**
 * Class CashFlowsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CashFlowsController extends Controller
{
    /**
     * @var CashFlowRepository
     */
    protected $repository;

    /**
     * @var CashFlowValidator
     */
    protected $validator;

    /**
     * CashFlowsController constructor.
     *
     * @param CashFlowRepository $repository
     * @param CashFlowValidator $validator
     */
    public function __construct(CashFlowRepository $repository, CashFlowValidator $validator)
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
        $cashFlows = $this->repository->paginate(8);

        $types = ['input_stream' => 'Entrada', 'output_stream' => 'Saída'];
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cashFlows,
            ]);
        }

        return view('cashFlows.index', compact('cashFlows','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CashFlowCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CashFlowCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $cashFlow = $this->repository->create($request->all());

            $response = [
                'message' => 'Item adicionado ao fluxo de caixa',
                'data'    => $cashFlow->toArray(),
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
        $cashFlow = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cashFlow,
            ]);
        }

        return view('cashFlows.show', compact('cashFlow'));
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
        $cashFlow = $this->repository->find($id);

        return view('cashFlows.edit', compact('cashFlow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CashFlowUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CashFlowUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $cashFlow = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CashFlow updated.',
                'data'    => $cashFlow->toArray(),
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
                'message' => 'CashFlow deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CashFlow deleted.');
    }
}
