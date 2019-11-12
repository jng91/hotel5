<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotel';
    protected $primaryKey = 'id';

    public static function getRooms($id)
    {
        $rooms_final = array();
        $rooms = HotelRoom::where('id_hotel', $id)->get();
        $i = 0;
        foreach($rooms as $room)
        {
            $aux = Room::find($room->id_room); 
            $aux->price = $room->price;
            $rooms_final[$i] = $aux; 
            $i++;
        }
        return $rooms_final;
    }

    public static function getPriceRoom($id_hotel, $id_room)
    {
        $room = HotelRoom::where('id_hotel', $id_hotel)->where('id_room', $id_room)->first();
        return $room->price;
    }
}
