<?php

namespace App\Http\Controllers;

use App\Models\rayons;
use App\Models\User;
use Illuminate\Http\Request;

class RayonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rayon = Rayons::with('user')->simplePaginate(5);
        $user = User::all();
        return view('Rayon.index', compact('rayon','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('Rayon.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon'=>'required',
            'user_id' => 'required'
        ]);

        rayons::create([
            'rayon'=>$request->rayon,
            'user_id'=>$request->user_id
        ]);

        return redirect()->route('rayon.index')->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(rayons $rayons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rayon = rayons::find($id);
        $user = User::all();
        return view('Rayon.edit', compact('user', 'rayon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rayons $rayon, $id)
    {
        $request->validate([
            'rayon'=>'required',
            'user_id'=>'required' 
        ]);

        rayons::where('id', $id)->update([
            'rayon' =>$request->rayon,
            'user_id'=> $request->user_id
        ]);

        return redirect()->route('rayon.index')->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rayons  $id)
    {
        rayons::where('id', $id)->delete();

        return redirect()->back()->with('deleted','Data berhasil dihapus');
    }
}
