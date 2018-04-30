<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CashFlowRepository;
use App\Entities\CashFlow;
use App\Validators\CashFlowValidator;

/**
 * Class CashFlowRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CashFlowRepositoryEloquent extends BaseRepository implements CashFlowRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CashFlow::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CashFlowValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
