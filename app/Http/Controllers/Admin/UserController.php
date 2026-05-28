<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.utilisateurs.index', compact('users'));
    }

    public function create()
    {
        $user = new User;
        return view('admin.utilisateurs.form', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', Password::min(8)->letters()->numbers()],
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.utilisateurs.index')
            ->with('success', "Utilisateur « {$data['name']} » créé.");
    }

    public function edit(User $utilisateur)
    {
        return view('admin.utilisateurs.form', ['user' => $utilisateur]);
    }

    public function update(Request $request, User $utilisateur)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $utilisateur->id,
            'password' => ['nullable', Password::min(8)->letters()->numbers()],
        ]);

        $utilisateur->name  = $data['name'];
        $utilisateur->email = $data['email'];
        if (!empty($data['password'])) {
            $utilisateur->password = Hash::make($data['password']);
        }
        $utilisateur->save();

        return redirect()->route('admin.utilisateurs.index')
            ->with('success', "Utilisateur « {$utilisateur->name} » mis à jour.");
    }

    public function destroy(User $utilisateur)
    {
        if ($utilisateur->id === auth()->id()) {
            return back()->with('error', 'Impossible de supprimer votre propre compte.');
        }

        $name = $utilisateur->name;
        $utilisateur->delete();

        return redirect()->route('admin.utilisateurs.index')
            ->with('success', "Utilisateur « {$name} » supprimé.");
    }
}
