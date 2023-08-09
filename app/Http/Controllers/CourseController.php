<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
    * Afișeaza lista de cursuri.
    */
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.course.index', ['courses' => $courses]);
    }

    /**
    * Afișează pagina single a unui curs.
    */
    public function show($id) {
        $course = Course::findOrFail($id);
        return view('admin.course.single', ['course' => $course]);
    }

    /**
    * Pagina de creare a unui nou curs.
    */
    public function create()
    {
        return view('admin.course.create');
    }

    /**
    * Salvarea datelor competate din pagina de adaugare curs in baza de date.
    *
    * @param \Illuminate\Http\Request $request
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'file' => 'required',
        ]);

        $fileName = $request->name . '.' . $request->file->extension();
        $request->file->move(public_path('uploads/courses'), $fileName);

        Course::create([
            'name' => $request->name,
            'date' => $request->date,
            'file' => 'uploads/courses/' . $fileName,
        ]);

        return redirect()->route('courses.index')->with('status', 'Cursul a fost adaugat cu success!');

    }

    /**
    * Pagina de editare a unui curs.
    */
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return view('admin.course.edit',compact('course'));
    }

    /**
    * Editarea datelor completate din pagina de editare curs.
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'file' => 'required',
        ]);

        $course = Course::findOrFail($id);

        if ( $request->filled( 'name' ) ) {
            $course->update([ 'name' => $request->name ]);
        }
        if ( $request->filled( 'date' ) ) {
            $course->update([ 'date' => $request->date ]);
        }

        if(File::exists(public_path($course->file))){
            File::delete(public_path($course->file));
        }
        $fileName = $request->name . '.' . $request->file->extension();
        $request->file->move(public_path('uploads/courses'), $fileName);
        $course->update([ 'file' => 'uploads/courses/' . $fileName ]);
  
        return redirect()->route('courses.index')->with('status','Cursul a fost updatat cu success!');
    }

    /**
    * Stergerea unui curs.
    */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if(File::exists(public_path($course->file))){
            File::delete(public_path($course->file));
        }

        $course->delete();

        return redirect()->route('courses.index')
            ->with('status', 'Cursul a fost sters cu succes!');
    }
}
