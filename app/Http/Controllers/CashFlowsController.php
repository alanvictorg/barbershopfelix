<?php

namespace App\Http\Controllers;

use App\Entities\CashFlow;
use Carbon\Carbon;
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
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $cashFlows = $this->repository->findWhere(['day' => Carbon::now(-3)->format('Y-m-d')]);
        $date = true;
        $actualDate = Carbon::now(-3)->format('Y-m-d');
        $statusDay = CashFlow::where(['day' => Carbon::now(-3)->format('Y-m-d'), 'type' => 'reserve'])->get();
        if ($statusDay->isNotEmpty()) {
            $opened = true;
        } else {
            $opened = false;
        }
        $types = ['input_stream' => 'Entrada', 'output_stream' => 'Saída'];

        $balance = $this->balanceOfDay();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cashFlows,
            ]);
        }
        return view('cashflows.index', compact('cashFlows', 'types', 'opened', 'actualDate', 'balance', 'input', 'output', 'date'));
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
            $data = $request->all();

            if (!isset($data['day']) && !isset($data['type'])) {
                $data['day'] = Carbon::now(-3)->format('Y-m-d');
                $data['type'] = 'reserve';
                $data['value'] = $data['openVal'];
                $data['description'] = 'FUNDO DE CAIXA';
            }

            $cashFlow = $this->repository->create($data);

            $response = [
                'message' => 'Item adicionado ao fluxo de caixa',
                'data' => $cashFlow->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect(route('cashflows.index'))->with('message', $response['message']);
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
        $cashFlow = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cashFlow,
            ]);
        }

        return view('cashflows.show', compact('cashFlow'));
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
        $types = ['input_stream' => 'Entrada', 'output_stream' => 'Saída'];

        return view('cashflows.edit', compact('cashFlow','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CashFlowUpdateRequest $request
     * @param  string $id
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
                'message' => 'Fluxo editado.',
                'data' => $cashFlow->toArray(),
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
                'message' => 'CashFlow deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CashFlow deleted.');
    }

    public function filterByDate(Request $request)
    {
        $data = $request->all();
        $cashFlows = CashFlow::where('day', $data['filter_date'])->get();
        $actualDate = $data['filter_date'];
        if ($actualDate == Carbon::now(-3)->format('Y-m-d')) {
            $statusDay = CashFlow::where(['day' => $actualDate, 'type' => 'reserve'])->get();
            if ($statusDay->isNotEmpty()) {
                $opened = true;
            } else {
                $opened = false;
            }
            $balance = $this->balanceOfDay();

        } else {
            $opened = "hide";
            $balance = 0;
        }
        $types = ['input_stream' => 'Entrada', 'output_stream' => 'Saída'];
        return view('cashflows.index', compact('cashFlows', 'types', 'opened', 'balance', 'actualDate'));
    }

    public function closeDay()
    {
        $cashflows = CashFlow::where(['day' => Carbon::now(-3)->format('Y-m-d')])->delete();
        $statusDay = CashFlow::where(['day' => Carbon::now(-3)->format('Y-m-d'), 'type' => 'reserve'])->get();
        $actualDate = Carbon::now(-3)->format('Y-m-d');

        if ($statusDay->isNotEmpty()) {
            $opened = true;
        } else {
            $opened = false;
        }
        $types = ['input_stream' => 'Entrada', 'output_stream' => 'Saída'];

        $balance = $this->balanceOfDay();

        $cashFlows = $this->repository->findWhere(['day' => Carbon::now(-3)->format('Y-m-d')]);

        return view('cashflows.index', compact('cashFlows', 'types', 'opened', 'balance', 'input', 'output','actualDate'));
    }

    public function balanceOfDay()
    {
        $reserve = CashFlow::where(['day' => Carbon::now(-3)->format('Y-m-d'), 'type' => 'reserve'])->sum('value');
        $output = CashFlow::where(['day' => Carbon::now(-3)->format('Y-m-d'), 'type' => 'output_stream'])->sum('value');
        $input = CashFlow::where(['day' => Carbon::now(-3)->format('Y-m-d'), 'type' => 'input_stream'])->sum('value');
        $balance = $input + $reserve - $output;

        return $balance;
    }
}
