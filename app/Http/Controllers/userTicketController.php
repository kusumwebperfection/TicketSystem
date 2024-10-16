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

    public function search(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'citation_number' => 'nullable|string',
        'first_name' => 'nullable|string',
        'last_name' => 'nullable|string',
        'license_plate' => 'nullable|string',
    ]);

    // Fetch inputs
    $citationNumber = $request->input('citation_number');
    $firstName = $request->input('first_name');
    $lastName = $request->input('last_name');
    $licensePlate = $request->input('license_plate');

    // Ensure at least one input is provided
    if (empty($citationNumber) && empty($firstName) && empty($lastName) && empty($licensePlate)) {
        return response()->json([
            'tickets' => [],
            'message' => 'Please provide at least one search parameter.'
        ], 400);
    }

    // Build the query using LIKE for partial matching
    $query = Ticket::query();

    if ($citationNumber) {
        $query->orWhere('citation_number', 'like', "%{$citationNumber}%");
    }
    if ($firstName) {
        $query->orWhere('firstname', 'like', "%{$firstName}%");
    }
    if ($lastName) {
        $query->orWhere('lastname', 'like', "%{$lastName}%");
    }
    if ($licensePlate) {
        $query->orWhere('license_plate_number', 'like', "%{$licensePlate}%");
    }

    // Execute the query
    $tickets = $query->get();

    // Return JSON response
    return response()->json([
        'tickets' => $tickets,
        'message' => $tickets->isEmpty() ? 'No tickets found.' : 'Tickets retrieved successfully.'
    ]);
}

    

    

}
