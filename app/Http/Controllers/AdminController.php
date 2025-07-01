<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\events;
use App\Models\registrations;
use DB;

class AdminController extends Controller
{
    public function index()
{
    $totalRegs = Registrations::where('status','!=','Cancelled')
                  ->count();

    $uniqueParts = Registrations::where('status','!=','Cancelled')
                      ->distinct('email')
                      ->count('email');

    $totalEvents = Events::withTrashed()
                   ->where('created_by', auth()->id())
                   ->count();

    $yearRegs = Registrations::where('status','!=','Cancelled')
                 ->whereYear('created_at', now()->year)
                 ->count();

    $monthly = Registrations::where('status','!=','Cancelled')
               ->whereYear('created_at', now()->year)
               ->select(DB::raw('MONTH(created_at) as m'), DB::raw('COUNT(*) as cnt'))
               ->groupBy('m')
               ->orderBy('m')
               ->pluck('cnt','m')
               ->toArray();

    $byCat = Registrations::join('events','events.event_id','registrations.event_id')
            ->join('event_category','event_category.id','events.category')
            ->where('registrations.status','!=','Cancelled')
            ->groupBy('event_category.category')
            ->select('event_category.category',DB::raw('COUNT(*) as cnt'))
            ->pluck('cnt','category');

    return view('Admin.home', compact(
        'totalRegs','uniqueParts','totalEvents','yearRegs','monthly','byCat'
    ));
}
    
}
