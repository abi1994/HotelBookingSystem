<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Response;

class ContactController extends Controller
{
    public function index() {
        $contacts = Contact::with('responses')->get();
        return view('contact-us', compact('contacts'));
    }

    public function store(Request $request) {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->status = 'open';
        $contact->save();

        return redirect('/contact-us');
    }

    public function respond(Request $request, $id) {
        $response = new Response();
        $response->contact_id = $id;
        $response->response = $request->response;
        $response->user_id = auth()->id();
        $response->save();

        return redirect('/contact-us');
    }

    public function close($id) {
        $contact = Contact::find($id);
        $contact->status = 'closed';
        $contact->save();

        return redirect('/contact-us');
    }

}
