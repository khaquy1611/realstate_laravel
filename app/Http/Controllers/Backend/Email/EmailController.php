<?php

namespace App\Http\Controllers\Backend\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\CustomMail;
use App\Models\User;
use App\Models\ComposeEmail;
use Illuminate\Support\Facades\Mail;



class EmailController extends Controller
{
    public function __construct() {

    }

    public function email_compose() {
        $data['getEmail'] = User::whereIn('role', ['agent', 'user'])->where('status', '=', 1)->get();
        return view('backend.admin.email.compose', compact('data'));
    }

    public function email_compose_post(Request $request) {
       $query = new ComposeEmail;
       $query->user_id = trim($request->input('user_id'));
       $query->cc_email = trim($request->input('cc_email'));
       $query->subject = trim($request->input('subject'));
       $query->description = trim($request->input('description'));
       $query->save();
       $getUserEmail = User::where('id', '=', $request->user_id)->first();
       $composeEmail = Mail::to($getUserEmail->email)->cc(trim($request->input('cc_email')))->send(new CustomMail($query));
       if ($composeEmail) {
        return redirect()->route('admin.email.compose')->with('success', 'Gửi Email thành công.');
       }
       return redirect()->route('admin.email.compose')->with('error', 'Gửi Email thất bại. Vui lòng gửi lại');
    }
}