<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specialty;
use App\Models\Appointment;
use App\Models\Invoice;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function schedule()
    {
        return view('theme.frontoffice.pages.user.patient.schedule', [
            'specialties' => Specialty::all()
        ]);
    }

    public function store_schedule(Request $request, Appointment $appointment, Invoice $invoice)
    {
        $invoice = $invoice->store($request);
        $appointment = $appointment->store($request, $invoice);
        alert('Exito', 'Cita creada', 'success')->showConfirmButton();
        return redirect()->route('frontoffice.patient.appointments');
    }
    
    public function back_schedule(User $user)
    {
        return view('theme.backoffice.pages.user.patient.schedule', [
            'user' => $user
        ]);
    }

    public function appointments()
    {
        return view('theme.frontoffice.pages.user.patient.appointments', [
            'appointments' => user()->appointments->sortBy('date')
        ]);
    }

    public function back_appointments(User $user)
    {
        return view('theme.backoffice.pages.user.patient.appointments', [
            'user' => $user
        ]);
    }

    public function prescriptions()
    {
        return view('theme.frontoffice.pages.user.patient.prescriptions');
    }

    public function invoices()
    {
        return view('theme.frontoffice.pages.user.patient.invoices', [
            'invoices' => user()->invoices
        ]);
    }

    public function back_invoices(User $user)
    {
        return view('theme.backoffice.pages.user.patient.invoices', [
            'user' => $user
        ]);
    }
    
}
