<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'sujet'   => 'required|string|max:255',
            'message' => 'required|string|min:10|max:2000',
        ]);

        ContactMessage::create([
            'nom'       => $validated['name'],
            'email'     => $validated['email'],
            'telephone' => $validated['phone'] ?? null,
            'sujet'     => $validated['sujet'],
            'message'   => $validated['message'],
        ]);

        try {
            Mail::to('direction@gsvictoriakoa.ci')
                ->send(new ContactFormMail($validated));
        } catch (\Exception) {
            // Mail failure is non-blocking — message is saved to DB
        }

        return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondons rapidement !');
    }
}
