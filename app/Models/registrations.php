<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registrations extends Model
{
    protected $table = 'registrations';
    protected $fillable = [
        'registrations_id', 'event_id', 'first_name', 'last_name', 'email', 'address', 'phone', 'created_at', 'created_by', 'updated_at', 'updated_by' 
    ];
    protected $primaryKey = 'registrations_id';

    public function events()
    {
        return $this->belongsTo('App\Models\events', 'event_id')->withTrashed();
    }


    public function student()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }


    
}
