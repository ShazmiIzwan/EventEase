<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    protected $table = 'logistics';
    protected $primaryKey = 'logistic_id';
    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'name',
        'quantity',
        'status',
    ];

    public function event()
    {
        return $this->belongsTo(events::class, 'event_id');
    }
}
