<?php

namespace App\Http\Controllers;

use App\Models\Mahal;
use Illuminate\Http\Request;

class UserMahal extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $judulpage = 'Katalog';
        // $mahals = Mahal::all();
        $mahals = Mahal::paginate(12);
        return view('user.usermahal', compact(
            'judulpage',
            'mahals'
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
        $mahal = Mahal::find($id); // Ganti $mahals dengan $mahal
        return view('actions.detailmahal', compact('mahal')); // Ganti $mahals dengan $mahal
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

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
