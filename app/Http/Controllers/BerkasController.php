<?php

namespace App\Http\Controllers;

use App\Models\berkas;
use App\Http\Requests\StoreberkasRequest;
use App\Http\Requests\UpdateberkasRequest;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreberkasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreberkasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function show(berkas $berkas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function edit(berkas $berkas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateberkasRequest  $request
     * @param  \App\Models\berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateberkasRequest $request, berkas $berkas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function destroy(berkas $berkas)
    {
        //
    }
}
