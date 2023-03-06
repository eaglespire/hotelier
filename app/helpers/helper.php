<?php

use App\Models\Booking;
use App\Models\BookingHistory;
use App\Models\Guest;
use App\Models\Room;

if (!function_exists('generate_random_string'))
{
    function generate_random_string($length = 10): string
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
if (!function_exists('save_booking_information'))
{
    function save_booking_information($booking)
    {
        $guest = Guest::create([
            'firstname' => $booking['firstname'],
            'lastname' => $booking['lastname'],
            'email' => $booking['email'],
            'address' => $booking['address'],
            'phone' => $booking['phone']
        ]);
        /*
         * Add the user to the bookings table
         */
        $bk = Booking::create([
            'guest_id' => $guest->id,
            'mode' => $booking['mode'],
            'nights' => $booking['nights'],
            'arrival' => $booking['arrival'],
            'room_id' => $booking['room'],
            'room_category_id' => $booking['type']
        ]);
        /*
         * Update the status of the booked room
         */
        $room = Room::find($booking['room']);
        $room->update([
            'is_available' => false
        ]);
        /*
         * Add an entry in the booking histories table
         */
        $history = BookingHistory::create([
            'guest_id' => $guest->id,
            'mode' => $booking['mode'],
            'nights' => $booking['nights'],
            'arrival' => $booking['arrival'],
            'room_id' => $booking['room'],
            'room_category_id' => $booking['type']
        ]);

        if ($guest && $bk && $history){
            return true;
        }else{
            return false;
        }
    }
}
