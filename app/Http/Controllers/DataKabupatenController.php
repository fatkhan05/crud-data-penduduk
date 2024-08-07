<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use DB;

class DataKabupatenController extends Controller
{
    private $menuActive = "kabupaten";
    public function index(Request $request) {
        $this->data['menuActive'] = $this->menuActive;
        if ($request->ajax()) {
            $data = Kabupaten::orderBy('id', 'desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" onclick="editForm('.$row->id.')" style="margin-right: 5px;" class="btn btn-sm btn-warning"><i class="fa fa-edit" style="font-size: 23px; margin-right: -0.5px;"></i></a>';
                $btn .= '<a href="javascript:void(0)" onclick="deleteRow('.$row->id.')" style="margin-right: 5px;" class="btn btn-sm btn-danger"><i class="fa fa-trash" style="font-size: 23px; margin-right: -0.5px;"></i></a>';
                $btn .='</div></div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('data-kabupaten.main')->with('data', $this->data);
    }

    public function form(Request $request) {
      $data['data'] = (!empty($request->id)) ? Kabupaten::find($request->id) : "";
      $data['provinsi'] = Provinsi::get();
      $content = view('data-kabupaten.form', $data)->render();
      return ['status' => 'success', 'content' => $content, 'data' => $data];
    }

    public function store(Request $request) {
      $validator = Validator::make(
            $request->all(),
            [
              'nama_provinsi' => 'required',
              'nama_kabupaten' => 'required',
            ],
            [
              'required' => ':attribute Tidak boleh kosong'
            ]
        );
        if($validator->fails()) {
            $pesan = $validator->errors()->first();
            return response()->json(['status' => 'warning', 'code' => 201, 'message' => $pesan]);
        }
        try {
            DB::beginTransaction();

            $newdata = (!empty($request->id)) ? Kabupaten::find($request->id) : new Kabupaten;
            $newdata->provinsi_id = $request->nama_provinsi;
            $newdata->nama = strtoupper($request->nama_kabupaten);
            $newdata->save();

            DB::commit();
            return response()->json(['status' => 'success', 'code' => 200, 'message' => 'Berhasil']);
        } catch (\Exception $e) {
            throw($e);
            DB::rollback();
            return response()->json(['status' => 'error', 'line' => $e->getLine(), 'code' => 500, 'message' => 'Internal Server Error']);
        }
    }

    public function destroy(Request $request) {
      try {
        $data = Kabupaten::find($request->id);

        if (!$data) {
          return response()->json([
            'error' => 'Data not found'
          ], 404);
        }

        $data->delete();

        return response()->json([
          'success' => 'Data Berhasil Dihapus'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'error' => 'Terjadi kesalahan, silahkan coba lagi'
        ], 500);
      }
    }
}
