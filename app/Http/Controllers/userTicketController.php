<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   $rules = [
        'firstname' => 'required|string|min:4|max:255',
        'lastname' => 'required|string|min:4|max:255',
        'citation-number' => 'required|string|min:4|max:255',
        'license-plate-number' => 'required|string|min:4|max:255',
        'total-amount-owed' => 'required|string|min:4|max:255',
        'ticket-pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',        
        ];

        $messages = [
            'firstname.required' => 'Please provide your First name.',
            'firstname.min' => 'Your name must be at least 4 characters long.',
        ];

        $request->validate($rules, $messages);
            
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
