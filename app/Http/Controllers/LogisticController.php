<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistic;
use App\Models\events;

//Manages event logistics (equipment, supplies, status tracking)

class LogisticController extends Controller
{
    public function index()
    {
        $logistics = Logistic::with('event')
                          ->orderBy('created_at','desc')
                          ->get();
        $events     = events::all();

        return view('logistics.index', compact('logistics','events'));
    }

    public function postLogistic(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'name'     => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'status'   => 'required|in:Pending,In Progress,Completed',
        ]);

        if ($request->type === 'C') {
            Logistic::create($data);
            return redirect()->back()->with('success','Logistic entry created successfully.');
        }

        if ($request->type === 'E') {
            $log = Logistic::findOrFail($request->id);
            $log->update($data);
            return redirect()->back()->with('success','Logistic entry updated successfully.');
        }

        return redirect()->back()->with('error','Invalid operation.');
    }

    public function fetchLogistic(Request $request)
    {
        $logistic = Logistic::findOrFail($request->id);
        return response()->json($logistic);
    }

    public function removeLogistic($id)
    {
        Logistic::findOrFail($id)->delete();
        return redirect()->back()->with('success','Logistic entry removed successfully.');
    }
}
