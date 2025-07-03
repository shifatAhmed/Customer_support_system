<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Auth;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()->type == 2){
            $service_tickets = Ticket::where('created_by', Auth::user()->id)->get();
        }
        else{
            $service_tickets= Ticket::All();
        }
        //dd( $service_ticket);
        return view('dashboard', compact('service_tickets'));
    }

}
