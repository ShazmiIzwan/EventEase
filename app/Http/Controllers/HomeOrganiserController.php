<?php

namespace App\Http\Controllers;

use App\Models\announcement;
use App\Models\event_category;
use Illuminate\Http\Request;
use App\Models\venue;
use App\Models\events;
use App\Models\feedback;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 
use App\Rules\MatchOldPassword;
use App\Models\registrations;
use Mpdf\Mpdf;
use Carbon\Carbon;

class HomeOrganiserController extends Controller
{

    public function regmanagement(){

        $myevents =  events::withTrashed()->where('created_by',auth()->user()->id)->pluck('event_id');

        if(auth()->user()->role != 'Admin'){
            $registrations = registrations::whereIn('event_id',$myevents)->get();
        }
        else{
            $registrations = registrations::get();
        }

        return view('Org.registrations',compact('registrations'));
    }

   

   
    public function fetchReg(Request $request)
    {
        $data = registrations::where('registrations_id',$request->id)->first();

        return response()->json($data);
    }


    public function eventsmanagement(){
        
        $events = events::where('created_by',auth()->user()->id)->latest()->get();
        $category = event_category::all();

        return view('Org.events-index',compact('events','category'));
    }

}
