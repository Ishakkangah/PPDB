<?php

namespace App\Http\Controllers;

use App\Models\blacklist;
use App\Http\Requests\StoreblacklistRequest;
use App\Http\Requests\UpdateblacklistRequest;

class BlacklistController extends Controller
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
     * @param  \App\Http\Requests\StoreblacklistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreblacklistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function show(blacklist $blacklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function edit(blacklist $blacklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateblacklistRequest  $request
     * @param  \App\Models\blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateblacklistRequest $request, blacklist $blacklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(blacklist $blacklist)
    {
        //
    }
}
