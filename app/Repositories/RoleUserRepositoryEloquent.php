<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RoleUserRepository;
use App\Entities\RoleUser;
use App\Validators\RoleUserValidator;

/**
 * Class RoleUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoleUserRepositoryEloquent extends BaseRepository implements RoleUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoleUser::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RoleUserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
