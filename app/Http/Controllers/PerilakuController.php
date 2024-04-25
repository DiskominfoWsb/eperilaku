<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerilakuRequest;
use App\Http\Requests\UpdatePerilakuRequest;
use App\Models\Perilaku;

class PerilakuController extends Controller
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
     * @param  \App\Http\Requests\StorePerilakuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePerilakuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perilaku  $perilaku
     * @return \Illuminate\Http\Response
     */
    public function show(Perilaku $perilaku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perilaku  $perilaku
     * @return \Illuminate\Http\Response
     */
    public function edit(Perilaku $perilaku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePerilakuRequest  $request
     * @param  \App\Models\Perilaku  $perilaku
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerilakuRequest $request, Perilaku $perilaku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perilaku  $perilaku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perilaku $perilaku)
    {
        //
    }
}
