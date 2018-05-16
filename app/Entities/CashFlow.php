<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CashFlow.
 *
 * @package namespace App\Entities;
 */
class CashFlow extends Model implements Transformable
{
    use SoftDeletes;
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'service_id',
        'payment_id',
        'value',
        'type',
        'description',
        'day'
    ];

}
