<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use DB;
use Validator;
use Auth;

class TicketController extends Controller
{
    public function index(){
        return view('ticket.create');
    }

    public function store(Request $request){
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category' => 'required',
            'priority' =>'required'
        ]);

        DB::beginTransaction();
        try {
            $validated['created_by'] = Auth::id();
            $validated['status']= 1;

            Ticket::create($validated);

            DB::commit();
            return redirect()->route('create-ticket')->with('success_message', 'Ticket created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error_message', 'Failed to create Ticket.');
        }
    }

    public function edit(Request $request){
        $ticket = Ticket::findOrFail($request->id);
        return view('ticket.update', compact('ticket'));
    }

    public function update(Request $request)
    {
        //dd($request->status);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category' => 'required',
            'priority' =>'required'
        ]);
        $ticket = Ticket::findOrFail($request->id);

        DB::beginTransaction();
        try {
            $validated['updated_by'] = Auth::id();
            $validated['status'] = Auth::user()->type == 2 ? 1: $request->status;

            $ticket->update($validated);

            DB::commit();
            return redirect()->route('edit-ticket', ['id'=> $request->id])->with('success_message', 'Ticket updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error_message', 'Failed to update plan type.');
        }
    }

}