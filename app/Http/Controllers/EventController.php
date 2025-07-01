<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\events;
use App\Models\registrations;
use App\Models\event_category;
use Mpdf\Mpdf;
use App\Models\User;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function fetchEvent(Request $request)
    {
        $data = events::withTrashed()->where('event_id',$request->id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function myreg()
    {
        $registrations = registrations::where('created_by',auth()->user()->id)->latest()->get();
        return view('Student.myreg',compact('registrations'));
    }

    public function bookingconfirmed($id)
    {
        $order = registrations::where('registrations_id',$id)->first();
        return view('Student.bookingconfirmed',compact('order'));
    }

    

    public function testing(){
        $registrations = registrations::where('registrations_id','7')->first();
        return view('test',compact('registrations'));
    }

    public function printTicket($id)
    {
        $registrations = registrations::where('registrations_id',$id)->first();

        return view('Student.ticket',compact('registrations'));  
    }

    public function events(Request $request)
    {

        $category = event_category::orderBy('category')->get();


        $events = events::where('event_date', '>=', now())->get();
     
        $organisers = User::whereIn('role',['Lecturer','Committee'])->where('status','A')->get();

        return view('Student.events',compact('category','events','organisers'));
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');

        if($type == 'C'){
        $events = new events;
        $events->event_name = $request->input('event_name');
        $events->event_date = $request->input('event_date');
        $events->event_time = $request->input('event_time');
        $events->category = $request->input('category');
        $events->event_description = $request->input('event_description');
        $events->event_duration_hours = $request->input('event_duration_hours');
        $events->created_by =  auth()->user()->id;
        $events->updated_by =  auth()->user()->id;

        $file = $request->file('event_image');
        $filename = auth()->user()->id.time().'-'.$file->getClientOriginalName();
        $file->move(public_path('/EventImage'), $filename);

        $events->event_image = $filename;

        $events->save();

        return redirect()->back()->with('success','Event has been successfully added!');
        }
        else{
        $events = events::where('event_id',$id)->first();
        $events->event_name = $request->input('event_name');
        $events->event_date = $request->input('event_date');
        $events->event_time = $request->input('event_time');
        $events->category = $request->input('category');
        $events->event_description = $request->input('event_description');
        $events->updated_by =  auth()->user()->id;

        if($request->file('event_image')){
            $file = $request->file('event_image');
            $filename = auth()->user()->id.time().'-'.$file->getClientOriginalName();
            $file->move(public_path('/EventImage'), $filename);
            $events->event_image = $filename;
        }

        $events->save();

        return redirect()->back()->with('success','Event has been successfully updated!');
    }
    }

    public function removeEvent($id){
        events::where('event_id',$id)->delete();

        return redirect()->back()->with('success','Event has been successfully deleted!');
    }

    /**
     * Display the specified resource.
     */
    public function returnPayment($id,Request $request)
    {

    $order = registrations::where('registrations_id',$id)->first();
    $order->payment_status = $request->status_id == 1 ? 'Success' : 'Failed';
    $order->transaction_id = $request->transaction_id;
    $order->billcode = $request->billcode;
    $order->save();

    if( $request->status_id == 1){

    $url = request()->getSchemeAndHttpHost();

    $getOrganiserEmail = User::where('id',$order->events->created_by)->first();
    
    \Mail::to(auth()->user()->email)->send(new \App\Mail\purchaseConfirmation($order,$url));
    \Mail::to($getOrganiserEmail->email)->send(new \App\Mail\newPurchase($order,$url));
    
    return redirect("bookingconfirmed/$id")->with('success','Event has been successfully booked!');
    
    }
    else{
    $event = events::withTrashed()->where('event_id',$order->event_id )->first();


    $latesttotal = $event->event_total_ticket + $order->quantity;

    $event->event_total_ticket =   $latesttotal;
    $event->save();



    return redirect('/student-home')->with('error','Whoops! Payment Failed! Please try again!');   
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function viewEvent($id)
    {
        $event = events::where('event_id',$id)->first();
        $relatedevents = events::where('category',$event->category)->where('event_id','!=',$id)->get();

        return view('Student.viewEvent',compact('event','relatedevents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function checkout(Request $request)
    {
        $quantity =  $request->input('quantity');
        $totalprice =  $request->input('totalprice');
        $id =  $request->input('id');

        $event = events::withTrashed()->where('event_id',$id)->first();

        return view('Student.checkout',compact('event','quantity','totalprice'));
    }

    /**
     * Remove the specified resource from storage.
     */

     public function formatAmount($amt)
     {

         $amt = str_replace(',', '', $amt);
         

         $formattedAmount = number_format((float)$amt, 2, '.', '');
      
 
         return $formattedAmount;
     }
     
    public function confirmregister(Request $request)
    {

        $registrations = new registrations;
        $registrations->event_id = $request->input('id');
        $registrations->first_name = $request->input('first_name');
        $registrations->last_name = $request->input('last_name');
        $registrations->email = $request->input('email');
        $registrations->address = $request->input('address');
        $registrations->phone = $request->input('phone');
        $registrations->created_by = auth()->user()->id;
        $registrations->updated_by = auth()->user()->id;
        $registrations->save();

        return redirect("myreg")->with('success','Event has been successfully Registered!');
    }

    public function generateCert($id){
        $reg = registrations::findOrFail($id);
        $reg->status = 'Completed';
        $reg->certificate = 'Y';
        $reg->certificate_issued_at = Carbon::now();
        $reg->save();

        return redirect()->back()
        ->with('success', 'Certificate has been successfully generated!');

    }

    public function cancel(Request $request, $id)
    {
        $reg = registrations::findOrFail($id);
        // ensure this user owns it, etc.
        $reg->status = 'Cancelled';
        $reg->updated_by = auth()->id();
        $reg->save();

        return redirect()->back()
                         ->with('success', 'Your registration has been cancelled.');
    }

    public function printCertificate($id)
    {
        $reg   = registrations::with('events.getcategory')->findOrFail($id);
        // build the HTML certificate
        $html = view('registrations.certificate', compact('reg'))->render();

        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top'    => 20,
            'margin_bottom' => 20,
            'margin_left'   => 15,
            'margin_right'  => 15,
        ]);
        $mpdf->SetTitle('Certificate of Participation');
        $mpdf->WriteHTML($html);

        // Output to browser (new tab)
        return response($mpdf->Output('', 'S'), 200)
            ->header('Content-Type','application/pdf')
            ->header('Content-Disposition','inline; filename="certificate.pdf"');
    }
}
