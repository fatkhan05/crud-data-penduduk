<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPendudukController extends Controller
{
    public function index()
    {
        return view('data-penduduk.main');
    }

    public function form()
    {
        $content = view('data-penduduk.form')->render();
	    return ['status' => 'success', 'content' => $content, 'data'];
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
