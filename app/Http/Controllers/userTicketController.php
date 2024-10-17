<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
class userTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Ticket = Ticket::paginate(10);
        return view('ticket.index',compact('Ticket'));
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
        'citation_number' => 'required|string|min:4|max:255',
        'license_plate_number' => 'required|string|min:4|max:255',
        'total_amount_owed' => 'required|string|min:4|max:255',
        'ticket_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',        
        ];

        $messages = [
            'firstname.required' => 'Please provide your First name.',
            'firstname.min' => 'Your name must be at least 4 characters long.',
        ];

        $request->validate($rules, $messages);
        
        $ticket = new Ticket();
        $ticket->firstname = $request->firstname;
        $ticket->lastname = $request->lastname;
        $ticket->citation_number = $request->citation_number;
        $ticket->license_plate_number = $request->license_plate_number;
        $ticket->total_amount_owed = $request->total_amount_owed;
        if ($request->hasFile('ticket_pic')) {
            $ticket->ticket_pic = $request->file('ticket_pic')->store('uploads', 'public');
        }       
        $ticket->save();
        session()->flash('success', 'Ticket created successfully.');
        return redirect()->back();
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
    public function edit(Ticket $ticket)
    {
        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the ticket by ID
        $ticket = Ticket::findOrFail($id);
    
        // Validation rules
        $rules = [
            'firstname' => 'required|string|min:4|max:255',
            'lastname' => 'required|string|min:4|max:255',
            'citation_number' => 'required|string|min:4|max:255',
            'license_plate_number' => 'required|string|min:4|max:255',
            'total_amount_owed' => 'required|string|min:1|max:255',
            'ticket_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    
        $messages = [
            'firstname.required' => 'Please provide the first name.',
            'firstname.min' => 'The first name must be at least 4 characters long.',
        ];
    
        // Validate the request data
        $request->validate($rules, $messages);
    
        // Update the ticket fields
        $ticket->firstname = $request->firstname;
        $ticket->lastname = $request->lastname;
        $ticket->citation_number = $request->citation_number;
        $ticket->license_plate_number = $request->license_plate_number;
        $ticket->total_amount_owed = $request->total_amount_owed;
        $ticket->Price = $request->price;
    
     if ($request->hasFile('ticket_pic')) {
            $ticket->ticket_pic = $request->file('ticket_pic')->store('uploads', 'public');
        }      
   
        $ticket->save();
        return response()->json(['success' => 'Ticket updated successfully.']);
        // // Flash success message and redirect
        // session()->flash('success', 'Ticket updated successfully.');
        // return redirect()->back();
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully!');
    }
}
