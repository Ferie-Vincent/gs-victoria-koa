<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{
    /**
     * Guard : accessible seulement si aucun utilisateur n'existe.
     */
    private function guardOrRedirect()
    {
        if (User::count() > 0) {
            return redirect()->route('admin.login')
                ->with('error', 'Configuration déjà effectuée. Connectez-vous.');
        }
        return null;
    }

    public function index()
    {
        if ($redirect = $this->guardOrRedirect()) {
            return $redirect;
        }

        return view('setup');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->guardOrRedirect()) {
            return $redirect;
        }

        $data = $request->validate([
            'name'                  => 'required|string|max:100',
            'email'                 => 'required|email|max:255',
            'password'              => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.login')
            ->with('success', 'Compte administrateur créé. Vous pouvez maintenant vous connecter.');
    }
}
