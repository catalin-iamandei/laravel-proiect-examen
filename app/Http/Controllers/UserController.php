<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
    * Afișează o listă de utilizatori.
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.user.index', ['users' => $users]);
    }

    /**
    * Afișează pagina single a unui utilizator.
    * @return \Illuminate\Http\Response
    */
    public function show($id) {
        $user = User::findOrFail($id);
        return view('admin.user.single', ['user' => $user]);
    }

    /**
    * Create a new user - page.
    */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
    * Store a new user.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect()->route('users.index')->with('status', 'Utilizator adaugat cu success!');

    }

    /**
    * Sterge un utilizator.
    * @return \Illuminate\Http\Response
    */
    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')
            ->with('status', 'Utilizatorul a fost sters cu succes!');
    }
}