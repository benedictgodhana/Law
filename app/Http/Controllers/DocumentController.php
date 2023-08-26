<?php

namespace App\Http\Controllers;

use App\Models\Advocate;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function uploadDocument(Request $request)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'document_type' => 'nullable|string',
            'status' => 'nullable|string',
            'notes' => 'nullable|string',
            'upload_date' => 'required|date',
            'document_file' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
        ]);

        $file = $request->file('document_file');

        // Generate a unique filename for the uploaded file
        $filename = time() . '_' . $file->getClientOriginalName();

        // Upload and store the file
        $filePath = $file->storeAs('documents', $filename);

        $clientId = $request->input('client_id');

        $advocate = Advocate::where('user_id', auth()->user()->id)->first();

        if ($advocate) {
            // Create a new document record
            Document::create([
                'client_id' => $clientId,
                'advocate_id' => $advocate->id, // Use the advocate's ID from the authenticated user     
                'document_name' => $request->input('document_name'),               
                'document_type' => $request->input('document_type'),
                'status' => $request->input('status'),
                'notes' => $request->input('notes'),
                'file_path' => $filePath,
                'upload_date' => $request->input('upload_date'),
                'document_file' => $filename, // Store the generated filename, not the input
                // Fill in other document-related fields as needed
            ]);

            $clients = $advocate ? $advocate->clients : collect();

            return redirect()->back()->with('success', 'Document uploaded successfully.');
        }
    }
}
