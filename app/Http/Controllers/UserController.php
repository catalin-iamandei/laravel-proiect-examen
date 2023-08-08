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
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect()->route('users.index')->with('status', 'Utilizator adaugat cu success!');

    }

    /**
    * Edit new user - page.
    */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($id);

        if ( $request->filled( 'name' ) ) {
            $user->update([ 'name' => $request->name ]);
        }
        if ( $request->filled( 'email' ) ) {
            $user->update([ 'email' => $request->email ]);
        }
        if ( $request->filled( 'password' ) ) {
            $user->update([ 'password' => $request->password ]);
        }
  
        return redirect()->route('users.index')->with('status','Utilizator a fost updatat cu success!');
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