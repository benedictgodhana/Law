<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class AdvocateController extends Controller
{
    public function showClients()
    {
        $advocateId = auth()->user()->advocate->id;
        $clients = Client::where('advocate_id', $advocateId)->get();

        return view('sub-admin.clients', compact('clients'));
    }

}
