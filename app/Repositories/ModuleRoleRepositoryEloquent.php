<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ModuleRoleRepository;
use App\Entities\ModuleRole;
use App\Validators\ModuleRoleValidator;

/**
 * Class ModuleRoleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ModuleRoleRepositoryEloquent extends BaseRepository implements ModuleRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ModuleRole::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ModuleRoleValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
