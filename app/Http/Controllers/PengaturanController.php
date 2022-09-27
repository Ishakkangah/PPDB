<?php

namespace App\Http\Controllers;

use App\Models\pengaturan;
use App\Http\Requests\StorepengaturanRequest;
use App\Http\Requests\UpdatepengaturanRequest;

class PengaturanController extends Controller
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
     * @param  \App\Http\Requests\StorepengaturanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepengaturanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengaturan  $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function show(pengaturan $pengaturan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengaturan  $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function edit(pengaturan $pengaturan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepengaturanRequest  $request
     * @param  \App\Models\pengaturan  $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepengaturanRequest $request, pengaturan $pengaturan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengaturan  $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pengaturan $pengaturan)
    {
        //
    }
}
