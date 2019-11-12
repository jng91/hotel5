<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        //$user_email = auth()->user()->email;
        $hotels = App\Hotel::all();
        return view('hotels', compact('hotels'));
    }

    public function hotels(){
        $hotels = App\Hotel::all();
        return view('hotels', compact('hotels'));
    }

    public function hotel($id){
        $hotel = App\Hotel::find($id);
        $rooms = App\Hotel::getRooms($id);
        return view('hotel', compact('hotel', 'rooms'));
    }
 
    public function savereservation(Request $request){

        $request->validate([
            'checkin' => ['required', 'string', 'max:255'], 
            'checkout' => ['required', 'string', 'max:255'],
            'room' => ['required'],
            'num_people' => ['required']
            ]);
        $reservation = new App\Reservation;

        //Calculating number of days
        $datetime1 = date_create($request->checkin);
        $datetime2 = date_create($request->checkout);
        if($datetime1 <= $datetime2)
        {
            $interval = date_diff($datetime1, $datetime2);
            $num_days = $interval->format('%a');
            if($num_days < 1)
                $num_days = 1;
        }
    
        //Save reservation
        $reservation->id_hotel = $request->id_hotel;
        $reservation->id_room = $request->room;
        $reservation->id_user = auth()->user()->id;
        $reservation->total_price = App\Hotel::getPriceRoom($request->id_hotel, $request->room)*$num_days;
        $reservation->checkin = $request->checkin;
        $reservation->checkout = $request->checkout;
        $reservation->comment = $request->comment;
        $reservation->num_people = $request->num_people;
        $reservation->save();

        //Send mail
        $content = 'Lorem ipsum dolor sit amet consectetur adipiscing elit<br>';
        $content .= "Reference: {$reservation->id}<br>";
        $content .= "Total price: {$reservation->total_price}<br>";
        $content .= "Checkin: {$reservation->checkin}<br>";
        $content .= "Checkout: {$reservation->checkout}<br>";
        $content .= "comment: {$reservation->comment}<br>";
        $content .= "Number of people: {$reservation->checkin}<br>";
        try{
            $success = mail( $request->email , 'Confirmed reservation' , $content);
        }catch(Exception $e)
        {
            return back()->with('msg-error', 'Error send mail');
        }
        $reservation = App\Reservation::getReservation($reservation->id);
        return view('reservation', compact('reservation'));
    }

    public function confirmreservation($id_reservation){
        if(auth()->user()->admin == true)
        {
            $success = App\Reservation::confirmReservation($id_reservation);
            return back()->with('msg', 'Save reservation');
        }
    }

    public function rejectedreservation($id_reservation){
        if(auth()->user()->admin == true)
        {
            $success = App\Reservation::rejectedReservation($id_reservation);
            return back()->with('msg', 'Reservation rejected');
        }
    }

    public function reservations(){
        if(auth()->user()->admin == true)
            $reservations = App\Reservation::getAllReservations();
        else
            $reservations = App\Reservation::getAllReservations(auth()->user()->id);
        return view('reservations', compact('reservations'));
    }


}
