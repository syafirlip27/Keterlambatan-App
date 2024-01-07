<?php

namespace App\Http\Controllers;

use App\Models\rayons;
use App\Models\rombels;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = students::all();
        $rayon = rayons::all();
        $rombel = rombels::all();
        if (Auth::user()-> role == 'ps') {

        $rayon_id = Auth::user()->rayon_id;
        //    $students = students::with('rayon')
        //        ->whereHas('rayon', function ($query) use ($rayon_id) {
        //            $query->where('id', $rayon_id);
        //        });
        $students = $student->where('rayon_id', $rayon_id);
       return view('student.index', compact('rayon', 'rombel','student','students' ));

       }

        return view('Student.index', compact('rayon','rombel','student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rayon = rayons::all();
        $rombel = rombels::all();
        $student = students::all();
        return view('Student.create', compact('rayon','rombel','student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' =>'required',
            'name'=> 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required'
        ]);

        students::create($request->all());

        return redirect()->route('student.index')->with('success','data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(students $students, $id)
    {
        $student = students::find($id);
        $rombel = rombels::all();
        $rayon = rayons::all();
        return view('Student.edit', compact('rayon','rombel','student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, students $students, $id)
    {
        $request->validate([
            'nis'=>'required',
            'name'=>'required',
            'rombel_id'=>'required',
            'rayon_id'=>'required',
        ]);

        students::where('id', $id)->update([
            'nis'=>$request->nis,
            'name'=>$request->name,
            'rombel_id'=>$request->rombel_id,
            'rayon_id'=>$request->rayon_id,
        ]);

        return redirect()->route('student.index')->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(students $students)
    {
        //
    }
}