<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Mail\DefaultHtmlMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SendEmailRequest $request)
    {
        if (!auth()->user()->hasRole('admin') && $request->hasFile('attachment')) {
            return back()->with([
                'success' => false,
                'message' => 'You are not allowed to send a file!',
            ]);
        }

        $data = $request->only(['subject', 'content']);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')
                ->storeAs('attachments', $request->file('attachment')->getClientOriginalName(), 'public');
        }

        try {
            Mail::to($request->to)
                ->cc($request->cc)
                ->bcc($request->bcc)
                ->send(new DefaultHtmlMail($data));
        } catch (\Throwable $th) {
            return back()->with([
                'success' => false,
                'message' => 'Something went wrong!',
            ]);
        }

        return back()->with([
            'success' => true,
            'message' => 'Success!',
        ]);
    }
}