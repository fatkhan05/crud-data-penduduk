<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataKabupatenController extends Controller
{
    private $menuActive = "kabupaten";
    public function index()
    {
        $this->data['menuActive'] = $this->menuActive;
        return view('data-kabupaten.main')->with('data', $this->data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
