<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EventModelRepository;
use App\Entities\EventModel;
use App\Validators\EventModelValidator;

/**
 * Class EventModelRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EventModelRepositoryEloquent extends BaseRepository implements EventModelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventModel::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
