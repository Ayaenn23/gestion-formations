<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

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

        return response()->json(['success' => true, 'message' => 'Message envoyé !']);
    }
}
