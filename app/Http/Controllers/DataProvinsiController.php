<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Facades\DataTables;

class DataProvinsiController extends Controller
{
    private $menuActive = "provinsi";
    public function index(Request $request)
    {
        // return 'dksnnfsdf';
        $this->data['menuActive'] = $this->menuActive;
        if ($request->ajax()) {
        $data = Provinsi::get();
            // return $data;
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                // $btn = '<a href="javascript:void(0)" onclick="addPorsi('.$row->id.')" style="margin-right: 5px;" class="btn btn-sm btn-secondary"><i class="fa fa-bars" style="font-size: 23px; margin-right: -0.5px; margin-top: 3px;"></i></a>';
            $btn = '<a href="javascript:void(0)" onclick="editForm('.$row->id.')" style="margin-right: 5px;" class="btn btn-sm btn-warning"><i class="fa fa-pencil" style="font-size: 23px; margin-right: -0.5px;"></i></a>';
            $btn .= '<a href="javascript:void(0)" onclick="deleteRow('.$row->id.')" style="margin-right: 5px;" class="btn btn-sm btn-danger"><i class="fa fa-trash" style="font-size: 23px; margin-right: -0.5px;"></i></a>';
            $btn .='</div></div>';
            return $btn;
            })
            ->addColumn('formatDate', function($row) {
                return date('d-m-Y', strtotime($row->tanggal_daftar));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('data-provinsi.main')->with('data', $this->data);
    }

    public function form(Request $request)
    {
        $data['data'] = (!empty($request->id)) ? Provinsi::find($request->id) : "";
        $content = view('data-provinsi.form')->render();
	    return ['status' => 'success', 'content' => $content, 'data' => $data];
    }

    public function store(Request $request)
    {
        // return $request->all();
        try {
            DB::beginTransaction();

            $newdata = (!empty($request->id)) ? Provinsi::find($request->id) : new Provinsi;
            $newdata->nama = strtoupper($request->nama_provinsi);
            $newdata->save();

            DB::commit();
            return response()->json(['status' => 'succes', 'code' => 200, 'message' => 'Berhasil']);
        } catch (\Exception $e) {
            throw($e);
            DB::rollback();
            return response()->json(['status' => 'error', 'line' => $e->getLine(), 'code' => 500, 'message' => 'Internal Server Error']);
        }
    }

    public function destroy($id)
    {
        //
    }
}
