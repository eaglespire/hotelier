<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingHistory;
use App\Models\Guest;
use App\Models\Room;
use Curl\Curl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends BaseController
{
    public function create()
    {
        $this->data['title'] = 'Add Booking';
        $this->data['titleDesc'] = 'Add Booking';
        $this->data['description'] = 'Add Booking';
        return view('admin.bookings.create',$this->data);
    }
    public function index()
    {
        $this->data['title'] = 'All Bookings';
        $this->data['titleDesc'] = 'All Bookings';
        $this->data['description'] = 'All Bookings';
        return view('admin.bookings.index',$this->data);
    }
//    public function GetBookings(Request $request)
//    {
//        if ($request->ajax()) {
//            $data = Booking::latest()->get();
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('action', function($row){
//                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
//                    return $actionBtn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//    }
    public function ProcessPayment()
    {
        $this->data['title'] = 'Process Booking';
        $this->data['titleDesc'] = 'Process Booking';
        $this->data['description'] = 'Process Booking';

        $data = session()->get('booking');
        if (!isset($data)){
            toast('Session has expired','error');
            return redirect(route('usr.booking.create'));
        }
        $this->data['booking'] = $data;
        return view('admin.bookings.process-payment',$this->data);
    }
    public function SuccessfulPayment(string $reference)
    {
        try {
            $curl = new Curl();
            $curl->setHeaders([
                "Authorization: Bearer ". config('app.PK_SECRET'),
                "Cache-Control: no-cache",
            ]);
            $curl->get("https://api.paystack.co/transaction/verify/$reference");
            if ($curl->error) {
                echo 'Error: ' . $curl->errorMessage . "\n";
                $curl->diagnose();
                Log::error($curl->error);
                toast('Something went wrong in communicating with the payment provider','error');
                return back();
            } else {
                //dd(json_decode(json_encode($curl->response),true));
                $response = json_decode(json_encode($curl->response),true);
                if ($response['data']['status'] === 'success')
                {
                    //payment was successfully verified
                    /*
                     * Get the user data and booking information stored in session
                     */
                    $booking = session()->get('booking');
                    if (!isset($booking))
                    {
                        toast('User session is not valid','error');
                        return redirect(route('usr.booking.create'));
                    }
                    //save the information
                    $response = save_booking_information($booking);
                    if ($response){
                        $fullname = $booking['firstname']. " ". $booking['lastname'];
                        toast("Reservation made for $fullname",'success');
                        //clear the booking session
                        session()->forget('booking');
                        return redirect(route('usr.booking.create'));
                    }
                }
            }
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            toast('Something went wrong in communicating with the payment provider','error');
            return back();
        }
    }
    public function BookingRecords()
    {
        $this->data['title'] = 'Records';
        $this->data['titleDesc'] = 'Records';
        $this->data['description'] = 'Records';
        return view('admin.bookings.records',$this->data);
    }
    public function BookingRecord($phone)
    {
        $this->data['title'] = 'Records of '. $phone;
        $this->data['titleDesc'] = 'Records of '. $phone;
        $this->data['description'] = 'Records of '. $phone;
        $this->data['phone'] = $phone;
        return view('admin.bookings.record',$this->data);
    }
    public function guests()
    {
        $this->data['title'] = 'Guests';
        $this->data['titleDesc'] = 'Guests';
        $this->data['description'] = 'Guests';
        return view('admin.bookings.guests',$this->data);
    }

}
