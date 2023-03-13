<?php

use App\Constants\CacheConstants;
use App\Models\Booking;
use App\Models\BookingHistory;
use App\Models\Guest;
use App\Models\Room;
use App\Services\Mailer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


if (!function_exists('generate_random_string'))
{
    function generate_random_string($length = 10): string
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
if (!function_exists('save_booking_information'))
{
    function save_booking_information($booking): bool
    {
        $guest = Guest::create([
            'firstname' => $booking['firstname'],
            'lastname' => $booking['lastname'],
            'email' => $booking['email'],
            'address' => $booking['address'],
            'phone' => $booking['phone'],
            'title' => $booking['guestTitle'],
            'gender' => $booking['gender']
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
            'room_category_id' => $booking['type'],
            'payment_done' => true,
            'departure' => build_departure_date($booking['arrival'],$booking['nights'])
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
            'uuid' => $bk->id,
            'mode' => $booking['mode'],
            'nights' => $booking['nights'],
            'arrival' => $booking['arrival'],
            'room_id' => $booking['room'],
            'room_category_id' => $booking['type'],
            'firstname' => $booking['firstname'],
            'lastname' => $booking['lastname'],
            'email' => $booking['email'],
            'address' => $booking['address'],
            'phone' => $booking['phone'],
            'title' => $booking['guestTitle'],
            'gender' => $booking['gender'],
            'departure' => build_departure_date($booking['arrival'],$booking['nights'])
        ]);

        if ($guest && $bk && $history){
            //send a mail to the guest
            $msg="Hi ".$booking['firstname']." ". $booking['lastname'] . ", thanks for making a reservation with us.";
            $msg .= "<br/>";
            $msg .= "You are scheduled to arrive on ". $booking['arrival'] . " at 3 p.m ";
            $msg .= "and is scheduled to spend ". $booking['nights']. " nights" ;
            $msg .= "<br/>";
            $msg .= "You have booked ".$booking['title'] . " with room number ". $booking['number'];
            $mailer = new Mailer;
            $arr['emailRecipient'] = $booking['email'];
            $arr['emailSubject'] = "Room Reservation For ".$booking['firstname']." ". $booking['lastname'];
            $arr['emailBody'] = $msg;
            $mailer->compose($arr);
            return true;
        }else{
            return false;
        }
    }
}

if (!function_exists('build_pdf'))
{
    function build_pdf($view,$data)
    {
        return PDF::loadView($view, $data);
    }
}
if (!function_exists('build_departure_date'))
{
    function build_departure_date($arrival,$nights): \Carbon\Carbon
    {
        $date = \Carbon\Carbon::parse($arrival);
        return $date->addDays($nights);
    }
}

if (!function_exists('check_out_guest'))
{
    function check_out_guest($id,$departure) : bool
    {
        $booking = Booking::find($id);
        $history = BookingHistory::find($booking->id);
        $history?->update(['departure'=> $departure]);
        $booking->room()->update(['is_available' => true]);
        $booking->delete();
        //update the room status
        return true;
    }
}

if (!function_exists('get_full_name_of_guest'))
{
    function get_full_name_of_guest($email)
    {
        return BookingHistory::where('email',$email)->first();
    }
}

if (!function_exists('get_user_role'))
{
    function get_user_role($userId)
    {
//       $assignedRole = Cache::remember(CacheConstants::AssignedRoleCache, now()->addDays(3), function () use($userId){
//            return DB::table('assigned_roles')->where('entity_id',$userId)->first();
//        });
//       $role = Cache::remember(CacheConstants::UserRoleCache,now()->addDays(3),function () use ($assignedRole){
//           return DB::table('roles')->where('id',$assignedRole->role_id)->first();
//       });
        //return $role?->title;
        return 'moderator';
    }
}
if (!function_exists('log_activity'))
{
    function log_activity(string $type, int $userId) : bool
    {
        DB::table('activity_logs')->insert([
            'type' =>$type,
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return true;
    }
}

