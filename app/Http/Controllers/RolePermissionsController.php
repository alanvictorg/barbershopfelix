<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RolePermissionCreateRequest;
use App\Http\Requests\RolePermissionUpdateRequest;
use App\Repositories\RolePermissionRepository;
use App\Validators\RolePermissionValidator;

/**
 * Class RolePermissionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class RolePermissionsController extends Controller
{
    /**
     * @var RolePermissionRepository
     */
    protected $repository;

    /**
     * @var RolePermissionValidator
     */
    protected $validator;

    /**
     * RolePermissionsController constructor.
     *
     * @param RolePermissionRepository $repository
     * @param RolePermissionValidator $validator
     */
    public function __construct(RolePermissionRepository $repository, RolePermissionValidator $validator)
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
        $rolePermissions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $rolePermissions,
            ]);
        }

        return view('rolePermissions.index', compact('rolePermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RolePermissionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RolePermissionCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $rolePermission = $this->repository->create($request->all());

            $response = [
                'message' => 'RolePermission created.',
                'data'    => $rolePermission->toArray(),
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
        $rolePermission = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $rolePermission,
            ]);
        }

        return view('rolePermissions.show', compact('rolePermission'));
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
        $rolePermission = $this->repository->find($id);

        return view('rolePermissions.edit', compact('rolePermission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RolePermissionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RolePermissionUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $rolePermission = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'RolePermission updated.',
                'data'    => $rolePermission->toArray(),
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
                'message' => 'RolePermission deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'RolePermission deleted.');
    }
}
