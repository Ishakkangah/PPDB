<?php

namespace App\Http\Controllers;

use App\Models\categori;
use App\Http\Requests\StorecategoriRequest;
use App\Http\Requests\UpdatecategoriRequest;

class CategoriController extends Controller
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
     * @param  \App\Http\Requests\StorecategoriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecategoriRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categori  $categori
     * @return \Illuminate\Http\Response
     */
    public function show(categori $categori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categori  $categori
     * @return \Illuminate\Http\Response
     */
    public function edit(categori $categori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoriRequest  $request
     * @param  \App\Models\categori  $categori
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoriRequest $request, categori $categori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categori  $categori
     * @return \Illuminate\Http\Response
     */
    public function destroy(categori $categori)
    {
        //
    }
}
