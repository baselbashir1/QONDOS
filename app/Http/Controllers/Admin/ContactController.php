<?php

namespace App\Http\Controllers\Admin;

use App\Mail\Email;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(5);
        return view('pages.contacts.list', ['contacts' => $contacts]);
    }

    public function show(Contact $contact)
    {
        return view('pages.contacts.details', ['contact' => $contact]);
    }

    public function messageSendReply(Contact $contact)
    {
        return view('pages.contacts.reply', ['contact' => $contact]);
    }

    public function messageReply(Request $request, Contact $contact)
    {
        $formFields = $request->validate([
            'reply' => 'nullable'
        ]);

        Mail::to($contact->client->email)->send(new Email($contact->subject, $formFields['reply']));

        try {
            $contact->update([
                'reply' => $formFields['reply']
            ]);

            notify()->success('تم ارسال الرد بنجاح');
            return redirect()->route('contacts.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء ارسال الرد');
        }
    }
}
