<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
    * Afișează o listă de utilizatori.
    */
    public function index()
    {
        $users = User::latest()->paginate(10);  

        return view('admin.user.index', ['users' => $users]);
    }

    /**
    * Afișează pagina single a unui utilizator.
    */
    public function show($id) {
        $user = User::findOrFail($id);

        return view('admin.user.single', ['user' => $user]);
    }

    /**
    * Pagina de creare a unui nou utilizator.
    */
    public function create()
    {
        $groups = Group::get()->pluck('name', 'id');
        return view('admin.user.create', compact('groups'));
    }

    /**
    * Salvarea datelor competate din pagina de adaugare utilizator in baza de date.
    *
    * @param \Illuminate\Http\Request $request
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
            'group_id' => $request->group,
            'password' => $request->password
        ]);

        return redirect()->route('users.index')->with('status', 'Utilizator adaugat cu success!');

    }

    /**
    * Pagina de editare a unui utilizator.
    */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $groups = Group::get()->pluck('name', 'id');

        return view('admin.user.edit',compact(['user', 'groups']));
    }

    /**
    * Editarea datelor competate din pagina de editare utilizator.
    */
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
        if ( $request->filled( 'group' ) ) {
            $user->update([ 'group_id' => $request->group ]);
        }
        if ( $request->filled( 'password' ) ) {
            $user->update([ 'password' => $request->password ]);
        }
  
        return redirect()->route('users.index')->with('status','Utilizator a fost updatat cu success!');
    }

    /**
    * Sterge un utilizator.
    */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        
        return redirect()->route('users.index')
            ->with('status', 'Utilizatorul a fost sters cu succes!');
    }
}