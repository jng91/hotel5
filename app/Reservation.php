<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';

    public static function getAllReservations($id_user=null)
    {
        if(!empty($id_user))
            $reservations = Reservation::where('id_user', $id_user)->get();
        else
            $reservations = Reservation::all();

        foreach($reservations as $reservation)
        {
            $reservation->customer = User::find($reservation->id_user);
            $reservation->hotel = Hotel::find($reservation->id_hotel);
        }
        return $reservations;
    }

    public static function getReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->customer = User::find($reservation->id_user);
        $reservation->hotel = Hotel::find($reservation->id_hotel);
        return $reservation;
    }

    public static function confirmReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->confirm = true;
        return $reservation->save();
    }

    public static function rejectedReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->rejected = true;
        return $reservation->save();
    }
}
