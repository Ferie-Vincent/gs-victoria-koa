<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderByDesc('created_at')->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message, Request $request)
    {
        $message->update(['lu' => true]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'id'          => $message->id,
                'nom'         => $message->nom,
                'email'       => $message->email,
                'telephone'   => $message->telephone,
                'sujet'       => $message->sujet,
                'message'     => $message->message,
                'lu'          => true,
                'created_at'  => $message->created_at->format('d/m/Y'),
                'created_time'=> $message->created_at->format('H:i'),
                'initiale'    => strtoupper(substr($message->nom, 0, 1)),
            ]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé.');
    }
}
