<?php

namespace App\Http\Controllers;

use App\Models\Advocate;
use App\Models\Client;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SubAdminController extends Controller
{
    //
    public function dashboard()
    {
        return view('sub-admin.dashboard');
    }
    public function profile_information()
    {
        $advocate = Advocate::where('user_id', auth()->user()->id)->first();
        return view('sub-admin.profile_information', compact('advocate'));
    }
    public function clients()
    {
        $advocate = Advocate::where('user_id', auth()->user()->id)->first();

        if ($advocate) {
            $clients = Client::where('advocate_id', $advocate->id)->get();
            return view('sub-admin.clients', compact('clients'));
        }
    }
    public function documents()
    {
        $advocate = Advocate::where('user_id', auth()->user()->id)->first();
        $clients = $advocate ? $advocate->clients : collect();

        if ($advocate) {
            $clients = Client::where('advocate_id', $advocate->id)->get();

            $documents = Document::whereIn('client_id', $clients->pluck('id'))
                ->orderBy('upload_date', 'desc')
                ->get();
        }
        return view('sub-admin.documents', compact('documents', 'clients'));
    }
    public function cases()
    {
        return view('sub-admin.cases');
    }
    public function activities()
    {
        return view('sub-admin.activities');
    }
    public function settings()
    {
        return view('sub-admin.settings');
    }
    public function calender()
    {
        return view('sub-admin.calender');
    }
    public function notes()
    {
        return view('sub-admin.notes');
    }
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'case_details' => 'nullable|string',
            'case_status' => 'nullable|string|max:255',
            'relevant_dates' => 'nullable|string|max:255',
            'case_description' => 'nullable|string',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // Store the image in the 'public' disk under the 'images' directory
        } else {
            $imagePath = null;
        }



        $advocate = Advocate::where('user_id', auth()->user()->id)->first();

        if ($advocate) {
            // Create a new client record
            $client = new Client();
            $client->advocate_id = $advocate->id;
            $client->name = $validatedData['name'];
            $client->contact_info = $validatedData['contact_info'];
            $client->date_of_birth = $validatedData['date_of_birth'];
            $client->case_details = $request->input('case_details');
            $client->case_status = $request->input('case_status');
            $client->relevant_dates = $request->input('relevant_dates');
            $client->case_description = $request->input('case_description');
            $client->notes = $request->input('notes');
            $client->image = $imagePath; // Set the image file path
            $client->save();

            $clients = Client::where('advocate_id', $advocate->id)->get();

            return redirect()->route('sub-admin.clients', compact('clients'))->with('success', 'Client added successfully!');
        }
    }
    public function destroy(Client $client)
    {
        // Delete the client
        $client->delete();

        // Redirect back to the clients list page with a success message
        return redirect()->route('sub-admin.clients')->with('success', 'Client deleted successfully!');
    }
    public function update(Request $request, Client $client)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'case_details' => 'nullable|string',
            'case_status' => 'nullable|string|max:255',
            'relevant_dates' => 'nullable|string|max:255',
            'case_description' => 'nullable|string',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update client attributes
        $client->name = $validatedData['name'];
        $client->contact_info = $validatedData['contact_info'];
        $client->date_of_birth = $validatedData['date_of_birth'];
        $client->case_details = $request->input('case_details');
        $client->case_status = $request->input('case_status');
        $client->relevant_dates = $request->input('relevant_dates');
        $client->case_description = $request->input('case_description');
        $client->notes = $request->input('notes');

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // Store the image in the 'public' disk under the 'images' directory
            $client->image = $imagePath;
        }

        $client->save();

        // Redirect back to the clients list page with a success message
        return redirect()->route('sub-admin.clients')->with('success', 'Client details updated successfully!');
    }
}
