<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RolePermissionRepository;
use App\Entities\RolePermission;
use App\Validators\RolePermissionValidator;

/**
 * Class RolePermissionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RolePermissionRepositoryEloquent extends BaseRepository implements RolePermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RolePermission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RolePermissionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
