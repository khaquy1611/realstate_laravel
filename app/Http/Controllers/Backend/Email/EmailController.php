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

    public function email_compose_send() {
       $data['getRecord'] = ComposeEmail::getRecord();
       return view('backend.admin.email.send', compact('data'));
    }
    
    public function email_compose_send_delete(Request $request) {
        $ids = trim($request->query('ids'));
        if (!empty($ids)) {
            $idsArray = explode(',', $ids);
            $deleted = ComposeEmail::whereIn('id', $idsArray )->delete();
            if ($deleted) {
                return redirect()->back()->with('success', 'Đã xóa thư đã gửi thành công.');
            }
            return redirect()->back()->with('error', 'Xóa thư đã gửi không thành công. Vui lòng thử lại.');
        }
    }

    public function email_compose_read($id = '', Request $request) {
        $data['getRecord'] = ComposeEmail::find($id);
        return view('backend.admin.email.read', compact('data'));
    }

    public function email_compose_read_delete($id, Request $request) {
        $dataRecord = ComposeEmail::find($id);
        if ($dataRecord->delete()) {
            return redirect()->route('admin.email.send')->with('success', 'Xóa thư đã gửi thành công');
        }
        return redirect()->route('admin.email.send')->with('success', 'Xóa thư đã gửi thất bại, Vui lòng thử lại!');
    }
}