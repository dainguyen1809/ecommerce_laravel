<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubscribersDataTable;
use App\Http\Controllers\Controller;
use App\Jobs\SendSubscribersEmail;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function index(SubscribersDataTable $dataTable)
    {
        return $dataTable->render('admin.subscriber.index');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $subscribers = Subscriber::where('is_verified', 1)->pluck('email')->toArray();

        //        Mail::to($subscribers)->send(new Subscribers($request->subject, $request->message));
        foreach ($subscribers as $email) {
            SendSubscribersEmail::dispatch($email, $request->subject, $request->message);
        }
        toastr()->success('Email sent!');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Done',
        ]);
    }
}
