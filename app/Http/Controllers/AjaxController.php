<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Invoice;

class AjaxController extends Controller
{
    public function user_specialty(Request $request)
    {
        if ($request->ajax()) {
            $specialty = Specialty::findOrFail($request->specialty);
            $users = $specialty->users;
            return response()->json($users);
        }
    }

    public function invoice_info(Request $request)
    {
        if ($request->ajax()) {
            $invoice = Invoice::findOrFail($request->invoice_id);
            return response()->json([
                'invoice' => $invoice, 
                'doctor' => $invoice->doctor('No aplica'), 
                'concept' => $invoice->concept()
            ]);
        }
    }
}
