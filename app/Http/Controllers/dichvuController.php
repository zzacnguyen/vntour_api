<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dichvuModel;
use Illuminate\Support\Facades\DB;
class dichvuController extends Controller
{

    public function index()
    {
        $dich_vu = DB::table('dlct_dichvu')
        ->select('id','dv_gioithieu', 'dv_giomocua','dv_giodongcua','dv_giathapnhat','dv_giacaonhat', 'dv_trangthai', 'dd_iddiadiem')
        ->paginate(10);
        $encode=json_encode($dich_vu);
        return $encode;
    }

  

    public function create()
    {
       //this is function get file create in android
    }

    public function store(Request $request)
    {

        $dichvu                 = new dichvuModel;
        $dichvu->dv_gioithieu   = $request->input('dv_gioithieu');
        $dichvu->dv_giomocua    = $request->input('dv_giomocua');
        $dichvu->dv_giodongcua  = $request->input('dv_giodongcua');
        $dichvu->dv_giacaonhat  = $request->input('dv_giacaonhat');
        $dichvu->dv_giathapnhat = $request->input('dv_giathapnhat');
        $dichvu->dd_iddiadiem   = $request->input('dd_iddiadiem');
        $dichvu->dv_trangthai   = 1;
        $dichvu->save();
        
        
       return response($dichvu,201); // hiển thị ra dạng json
    }

    public function show($id)
    {
        $dich_vu = DB::table('dlct_dichvu')
        ->select('id','dv_gioithieu', 'dv_giomocua','dv_giodongcua','dv_giathapnhat','dv_giacaonhat', 'dv_trangthai', 'dd_iddiadiem')
        ->where('id', $id)
        ->get();
        $encode=json_encode($dich_vu);
        return $encode;
    }

    public function edit($id)
    {
        $dich_vu = DB::table('dlct_dichvu')
        ->select('id','dv_gioithieu', 'dv_giomocua','dv_giodongcua','dv_giathapnhat','dv_giacaonhat', 'dv_trangthai', 'dd_iddiadiem')
        ->where('id', $id)
        ->get();
        $encode=json_encode($dich_vu);
        return $encode;
    }

    public function update(Request $request, $id)
    {
        $dichvu                 = dichvuModel::findOrFail($id);
        $dichvu->dv_gioithieu   = $request->input('dv_gioithieu');
        $dichvu->dv_giomocua    = $request->input('dv_giomocua');
        $dichvu->dv_giodongcua  = $request->input('dv_giodongcua');
        $dichvu->dv_giacaonhat  = $request->input('dv_giacaonhat');
        $dichvu->dv_giathapnhat = $request->input('dv_giathapnhat');
        $dichvu->dd_iddiadiem   = $request->input('dd_iddiadiem');
        $dichvu->dv_trangthai   = $request->input('dv_trangthai');
        $dichvu->save();
    
    }

    public function destroy($id)
    {
        $dichvu = dichvuModel::findOrFail($id);
        $dichvu->delete();

    }
}
