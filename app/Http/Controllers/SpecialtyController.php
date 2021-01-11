<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Http\Requests\Specialty\StoreRequest;
use App\Http\Requests\Specialty\UpdateRequest;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.backoffice.pages.specialty.index', [
            'specialties' => Specialty::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme.backoffice.pages.specialty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Specialty $specialty)
    {
        $specialty = $specialty->store($request);
        return redirect()->route('backoffice.specialty.show', $specialty);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function show(Specialty $specialty)
    {
        return view('theme.backoffice.pages.specialty.show', [
            'specialty' => $specialty,
            'users' => $specialty->users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $specialty)
    {
        return view('theme.backoffice.pages.specialty.edit', [
            'specialty' => $specialty
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Specialty $specialty)
    {
        $specialty->my_update($request);
        return redirect()->route('backoffice.specialty.show', $specialty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return redirect()->route('backoffice.specialty.index');
    }
}
