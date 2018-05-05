<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Service.
 *
 * @package namespace App\Entities;
 */
class Service extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'status',
        'scheduled_day',
        'scheduled_hour',
        'observation'
    ];

    protected $dates = ['deleted_at'];

    public function items()
    {
        return $this->hasMany(ServiceItem::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }
}
