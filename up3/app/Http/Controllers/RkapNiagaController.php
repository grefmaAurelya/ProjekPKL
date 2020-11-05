<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Exports\ExportRkapNiaga;
use App\Rkap_Niaga;
use App\Niaga;
use App\Prk;
use PDF;

class RkapNiagaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('role:admin,perencanaan');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rkapNiaga = Rkap_Niaga::all();

        $niaga = Niaga::orderBy('nama_material_niaga','ASC')
        ->get()
        ->pluck('nama_material_niaga','id');

        $prk = Prk::orderBy('noPrk','ASC')
        ->get()
        ->pluck('noPrk','id');

        return view('rkap_niaga.index', compact('rkapNiaga','niaga','prk'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal_rkap_niaga'     => 'required',
            'niaga_id'    => 'required',
            'prk_id'            => 'required',
            'total_rkap_niaga'        => 'required'
        ]);

        Rkap_Niaga::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'RKAP telah ditambahkan'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rkapNiaga = Rkap_Niaga::find($id);
        return $rkapNiaga;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rkapNiaga= Rkap_Niaga::find($id);
        return $rkapNiaga;
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tanggal_rkap_niaga'     => 'required',
            'niaga_id'    => 'required',
            'prk_id'            => 'required',
            'total_rkap_niaga'        => 'required'
        ]);

        $rkap_niaga = Rkap_Niaga::findOrFail($id);
        $rkap_niaga->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'RKAP Niaga Berhasil Diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rkap_Niaga::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'RKAP Niaga Berhasil di hapus'
        ]);
    }

    public function apiRkapNiaga(){

        $rkapNiaga = Rkap_Niaga::all();
        

        return Datatables::of($rkapNiaga)
            ->addColumn('no_prk', function ($rkapNiaga){
                return $rkapNiaga->prk->noPrk;
            })

            ->addColumn('material', function ($rkapNiaga){
                return $rkapNiaga->niaga->nama_material_niaga;
            })
           
          
            ->addColumn('action', function($rkapNiaga){
                return 
                    '<a onclick="editForm('. $rkapNiaga->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $rkapNiaga->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
            })
            ->rawColumns(['no_prk','material','action'])->make(true);

    }

    public function exportRkapNiagaAll()
    {
        $rkap_niaga = Rkap_Niaga::all();
        $pdf = PDF::loadView('rkap_niaga.rkapNiagaAllPDF',compact('rkap_niaga'))->setPaper('a4','landscape');
        return $pdf->download('rkap_niaga.pdf');
    }

   

    public function exportExcel()
    {
        return (new ExportRkapNiaga)->download('rkap_niaga.xlsx');
    }
}
