<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ServiceItem.
 *
 * @package namespace App\Entities;
 */
class ServiceItem extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'product_id',
        'discount',
        'observation'
    ];
    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
