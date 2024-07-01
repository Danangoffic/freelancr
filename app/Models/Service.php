<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
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
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'delivery_time',
        'revision_limit',
        'price',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'service_id', 'id');
    }

    public function advantageUsers()
    {
        return $this->hasMany(AdvantageUser::class);
    }

    public function taglines()
    {
        return $this->hasMany(Tagline::class);
    }

    public function advantageServices()
    {
        return $this->hasMany(AdvantageService::class);
    }

    public function thumbnails()
    {
        return $this->hasMany(ThumbnailService::class);
    }
}
