<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagline extends Model
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
        'service_id',
        'tagline',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
