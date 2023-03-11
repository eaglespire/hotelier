<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class MailController extends BaseMailController
{
    private function responseRedirect($response)
    {
        if ($response[0] === 'failed'){
            return back()->with("failed", $response[1])->withErrors($response[2]);
        }
        if ($response[0] === 'success'){
            return back()->with("success", $response[1]);
        }
        if ($response[0] === 'error'){
            return back()->with("error", $response[1]);
        }
    }
    public function TestEmail()
    {
        return view('admin.emails.test');
    }
    public function ComposeTestEmail(Request $request)
    {
        $response = $this->ComposeEmail($request);
        return $this->responseRedirect($response);
    }



}
