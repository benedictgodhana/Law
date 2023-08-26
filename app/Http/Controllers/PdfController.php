<?php

namespace App\Http\Controllers;

use App\Models\Advocate;
use App\Models\Client;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;

class PdfController extends Controller
{


    public function generateClientReport()
    {
        // Fetch the authenticated advocate's data
        $advocate = Advocate::where('user_id', auth()->user()->id)->first();

        if ($advocate) {
            // Fetch clients for the advocate
            $clients = Client::where('advocate_id', $advocate->id)->get();

            // Pass the data to the PDF view
            $data = [
                'advocate' => $advocate,
                'clients' => $clients,
            ];

            // Generate the PDF using the view and data
            $pdf = PDF::loadView('sub-admin.pdf.report', $data);

            // Return the PDF for download or display
            return $pdf->download('client_report.pdf');
        } else {
            // Handle the case when advocate data is not found
            return redirect()->back()->with('error', 'Advocate data not found.');
        }
    }
    }
