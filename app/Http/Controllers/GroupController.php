<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
    * Afișeaza lista de grupe.
    */
    public function index()
    {
        $groups = Group::latest()->paginate(10);
        return view('admin.group.index', ['groups' => $groups]);
    }

    /**
    * Afișează pagina single a unui grupe.
    */
    public function show($id) {
        $group = Group::findOrFail($id);
        return view('admin.group.single', ['group' => $group]);
    }

    /**
    * Pagina de creare a unuei noi grupe.
    */
    public function create()
    {
        return view('admin.group.create');
    }

    /**
    * Salvarea datelor competate din pagina de adaugare grupa in baza de date.
    *
    * @param \Illuminate\Http\Request $request
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'started_at' => 'required',
            'finished_at' => 'required',
            'exam_at' => 'required',
        ]);

        Group::create([
            'name' => $request->name,
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
            'exam_at' => $request->exam_at
        ]);

        return redirect()->route('groups.index')->with('status', 'Grupul a fost adaugat cu success!');

    }

    /**
    * Pagina de editare a unuei grupe.
    */
    public function edit($id)
    {
        $group = Group::findOrFail($id);

        return view('admin.group.edit',compact('group'));
    }

    /**
    * Editarea datelor completate din pagina de editare grupa.
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'started_at' => 'required',
            'finished_at' => 'required',
            'exam_at' => 'required',
        ]);

        $group = Group::findOrFail($id);

        if ( $request->filled( 'name' ) ) {
            $group->update([ 'name' => $request->name ]);
        }
        if ( $request->filled( 'started_at' ) ) {
            $group->update([ 'started_at' => $request->started_at ]);
        }
        if ( $request->filled( 'finished_at' ) ) {
            $group->update([ 'finished_at' => $request->finished_at ]);
        }
        if ( $request->filled( 'exam_at' ) ) {
            $group->update([ 'exam_at' => $request->exam_at ]);
        }
  
        return redirect()->route('groups.index')->with('status','Grupul a fost updatat cu success!');
    }

    /**
    * Sterge o grupa.
    */
    public function destroy($id)
    {
        Group::findOrFail($id)->delete();

        return redirect()->route('groups.index')
            ->with('status', 'Grupul a fost sters cu succes!');
    }
}