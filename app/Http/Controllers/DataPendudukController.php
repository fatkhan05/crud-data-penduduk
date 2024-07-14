<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Penduduk;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use DB;

class DataPendudukController extends Controller
{
    private $menuActive = "penduduk";
    public function index(Request $request)
    {
        $this->data['menuActive'] = $this->menuActive;
        if($request->ajax()) {
            $data = Penduduk::orderBy('id_penduduk', 'desc')->get();
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
        return view('data-penduduk.main')->with('data', $this->data);
    }

    public function form(Request $request)
    {
        $data['data'] = (!empty($request->id)) ? Penduduk::find($request->id) : "";
        $data['provinsi'] = Provinsi::get();
        if(!empty($request->id)) {
            $dara['kabupaten'] = Kabupaten::where('provinsi_id', $data['data']->provinsi)->get();
        }
        $content = view('data-penduduk.form', $data)->render();
	    return ['status' => 'success', 'content' => $content, 'data'];
    }

    public function store(Request $request) {
        // return $request->all();
        $rules = [
            'nama_lengkap' => 'required',
        ];
        $messages = [
            'required' => 'Kolom :attribute harus diisi, '
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
          return response()->json(['status' => 'error', 'code' => 201, 'message' => $validator->errors()->all(), 'data' => '']);
        }

        DB::beginTransaction();
        try {
          $newdata = (!empty($request->id)) ? Penduduk::find($request->id) : new Penduduk;
          $newdata->nama_penduduk = $request->nama_lengkap;
          $newdata->nik = $request->nik;
          $newdata->jenis_kelamin = $request->jnskelamin;
          $newdata->tanggal_lahir = $request->tglLahir;
          $newdata->alamat = $request->alamat;
          $newdata->provinsi = $request->provinsi;
          $newdata->kabupaten = $request->kabupaten;
          $newdata->save();
          DB::commit();
          return ['status' => 'success', 'code' => 200, 'message' => 'Berhasil Menyimpan Data'];
        } catch (\Exception $e) {
          DB::rollBack();
          return ['status' => 'error', 'code' => 500, 'message' => 'Gagal Menyimpan Data', 'message' => $e->getMessage()];
        }
    }


    public function destroy(Request $request) {
        try {
            $data = Penduduk::find($request->id);

            if(!$data) {
                return response()->json([
                    'error' => 'Data not found'
                ]);
            }

            $data->delete();

            return response()->json([
                'status' => 'Success, Data berhasil dihapus'
            ]);
        } catch(\Exception $e) {
            throw($e);
            return response()->json([
                'error ' => 'Terjadi kesalahan, Silahkan coba lagi'
            ]);
        }
    }

    public function getKabupaten(Request $request)
  	{
  		// return $request->all();
  		$data = Kabupaten::where('provinsi_id', $request->id)->get();
  		return response()->json($data);
  	}
}
