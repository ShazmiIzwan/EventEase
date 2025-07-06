<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Event categories (Academic, Workshop, Seminar, etc.)

class event_category extends Model
{
    protected $table = 'event_category';
    protected $fillable = [
        'id', 'category', 'created_at', 'updated_at'
    ];


}
