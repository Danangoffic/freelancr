<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'updated_at',
        'created_at'
    ];

    protected $fillable = [
        'name',
    ];

    function orders()
    {
        return $this->hasMany(Order::class, 'order_status_id', 'id');
    }
}
