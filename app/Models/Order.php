<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'expired'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'buyer_id',
        'freelancer_id',
        'service_id',
        'file',
        'note',
        'expired',
        'order_status_id'
    ];

    /**
     * the attributes to call buyer data
     */
    public function user_buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function user_freelancer()
    {
        $this->belongsTo(User::class, 'freelancer_id', 'id');
    }

    public function service()
    {
        $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function status()
    {
        $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }
}
