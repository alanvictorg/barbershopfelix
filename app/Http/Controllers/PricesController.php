<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PriceCreateRequest;
use App\Http\Requests\PriceUpdateRequest;
use App\Repositories\PriceRepository;
use App\Validators\PriceValidator;

/**
 * Class PricesController.
 *
 * @package namespace App\Http\Controllers;
 */
class PricesController extends Controller
{
    /**
     * @var PriceRepository
     */
    protected $repository;

    /**
     * @var PriceValidator
     */
    protected $validator;

    /**
     * PricesController constructor.
     *
     * @param PriceRepository $repository
     * @param PriceValidator $validator
     */
    public function __construct(PriceRepository $repository, PriceValidator $validator)
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
        $prices = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $prices,
            ]);
        }

        return view('prices.index', compact('prices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PriceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PriceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $price = $this->repository->create($request->all());

            $response = [
                'message' => 'Price created.',
                'data'    => $price->toArray(),
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
        $price = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $price,
            ]);
        }

        return view('prices.show', compact('price'));
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
        $price = $this->repository->find($id);

        return view('prices.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PriceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PriceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $price = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Price updated.',
                'data'    => $price->toArray(),
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
                'message' => 'Price deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Price deleted.');
    }
}
