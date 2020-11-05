<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Exports\ExportRkapDistribusi;
use App\Rkap_Distribusi;
use App\Distribusi;
use App\Prk;
use PDF;

class RkapDistribusiController extends Controller
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
        $rkapDistribusi = Rkap_Distribusi::all();

        $distribusi = Distribusi::orderBy('nama_material_distribusi','ASC')
        ->get()
        ->pluck('nama_material_distribusi','id');

        $prk = Prk::orderBy('noPrk','ASC')
        ->get()
        ->pluck('noPrk','id');

        return view('rkap_distribusi.index', compact('rkapDistribusi','distribusi','prk'));
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
            'tanggal_rkap_dist'     => 'required',
            'distribusi_id'    => 'required',
            'prk_id'            => 'required',
            'total_rkap_dist'        => 'required'
        ]);

        Rkap_Distribusi::create($request->all());

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
        $rkapDistribusi = Rkap_Distribusi::find($id);
        return $rkapDistribusi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rkapDistribusi = Rkap_Distribusi::find($id);
        return $rkapDistribusi;
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
            'tanggal_rkap_dist'     => 'required',
            'distribusi_id'    => 'required',
            'prk_id'            => 'required',
            'total_rkap_dist'        => 'required'
        ]);

        $rkap_distribusi = Rkap_Distribusi::findOrFail($id);
        $rkap_distribusi->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'RKAP Distribusi Berhasil Diperbarui'
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
        Rkap_Distribusi::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'RKAP Distribusi Berhasil di hapus'
        ]);
    }

    public function apiRkapDist(){

        $rkapDistribusi = Rkap_Distribusi::all();
        

        return Datatables::of($rkapDistribusi)
            ->addColumn('no_prk', function ($rkapDistribusi){
                return $rkapDistribusi->prk->noPrk;
            })

            ->addColumn('material', function ($rkapDistribusi){
                return $rkapDistribusi->distribusi->nama_material_distribusi;
            })
           
          
            ->addColumn('action', function($rkapDistribusi){
                return 
                    '<a onclick="editForm('. $rkapDistribusi->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $rkapDistribusi->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
            })
            ->rawColumns(['no_prk','material','action'])->make(true);

    }

    public function exportRkapDistribusiAll()
    {
        $rkap_distribusi = Rkap_Distribusi::all();
        $pdf = PDF::loadView('rkap_distribusi.rkapDistribusiAllPDF',compact('rkap_distribusi'))->setPaper('a4','landscape');
        return $pdf->download('rkap_distribusi.pdf');
    }

   

    public function exportExcel()
    {
        return (new ExportRkapDistribusi)->download('rkap_distribusi.xlsx');
    }
}
