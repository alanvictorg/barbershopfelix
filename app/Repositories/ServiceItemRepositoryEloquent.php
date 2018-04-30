<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ServiceItemRepository;
use App\Entities\ServiceItem;
use App\Validators\ServiceItemValidator;

/**
 * Class ServiceItemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ServiceItemRepositoryEloquent extends BaseRepository implements ServiceItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ServiceItem::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ServiceItemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
