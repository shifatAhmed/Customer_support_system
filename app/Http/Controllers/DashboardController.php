<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index(){
        $service_ticket= Ticket::All();
        //dd( $service_ticket);
        return view('dashboard', compact('service_ticket'));
    }

}
