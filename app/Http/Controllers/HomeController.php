<?php

namespace App\Http\Controllers;

use App\Models\event_category;
use App\Models\events;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash; 

class HomeController extends Controller
{
    public function index(){

        $category = event_category::orderBy('category')->get();
        $events = events::where('event_date', '>=', now())->get();

        $currentWeek = Carbon::now()->weekOfYear;

        return view('Student.home',compact('category','events'));
    }

    
}
