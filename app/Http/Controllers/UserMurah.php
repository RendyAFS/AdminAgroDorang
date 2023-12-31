<?php

namespace App\Http\Controllers;

use App\Models\Murah;
use Illuminate\Http\Request;

class UserMurah extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $judulpage = 'Katalog';
        $murahs = Murah::all();
        // $murahs = Murah::paginate(12);
        return view('user.usermurah', compact(
            'judulpage',
            'murahs'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $murah = Murah::find($id); // Ganti $murahs dengan $murah
        return view('actions.detailmurah', compact('murah')); // Ganti $mahals dengan $mahal
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
