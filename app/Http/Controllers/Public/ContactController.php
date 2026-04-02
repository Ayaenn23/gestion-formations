<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;


class ContactController extends Controller
{
    public function index(string $locale)
    {
        session(['locale' => $locale]);
        return view('public.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->only('name', 'email', 'phone', 'subject', 'message'));
        $contact = Contact::create($request->only('name', 'email', 'phone', 'subject', 'message'));
        Mail::to(config('mail.from.address'))->send(new ContactMessageMail($contact));

        return response()->json(['success' => true, 'message' => 'Message envoyé !']);
    }
}
