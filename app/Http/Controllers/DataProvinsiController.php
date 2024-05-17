<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataProvinsiController extends Controller
{
    private $menuActive = "provinsi";
    public function index()
    {
        $this->data['menuActive'] = $this->menuActive;
        return view('data-provinsi.main')->with('data', $this->data);
    }

    public function form()
    {
        return view('data-provinsi.form');
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
