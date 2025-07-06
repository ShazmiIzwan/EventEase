<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Event model with relationships to categories and organizers

class events extends Model
{
    protected $table = 'events';
    protected $fillable = [
      'event_id', 'event_name', 'event_date', 'event_time', 'event_description', 'event_image', 'event_duration_hours', 'category', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'
    ];

    use SoftDeletes;

    protected $primaryKey = 'event_id';


    public function getcategory()
    {
        return $this->belongsTo('App\Models\event_category', 'category');
    }
    public function organiser()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    
}
