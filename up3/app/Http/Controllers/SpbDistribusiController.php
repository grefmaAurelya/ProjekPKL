<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Exports\ExportSpbDistribusi;
use App\Spb_Distribusi;
use App\Distribusi;
use App\Pabrikan;
use App\Spb;
use App\Prk;
use PDF;

class SpbDistribusiController extends Controller
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
        $spb_distribusi = Spb_Distribusi::all();

        $distribusi = Distribusi::orderBy('nama_material_distribusi','ASC')
        ->get()
        ->pluck('nama_material_distribusi','id');

        $prk = Prk::orderBy('noPrk','ASC')
        ->get()
        ->pluck('noPrk','id');

        $spb = Spb::orderBy('no_spb_mstr','ASC')
        ->get()
        ->pluck('no_spb_mstr','id');

        $pabrikan = Pabrikan::orderBy('pabrikan_mstr','ASC')
        ->get()
        ->pluck('pabrikan_mstr','id');

        return view('spb_distribusi.index', compact('spb_distribusi','distribusi','prk','spb','pabrikan'));
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
            'tanggal_spb_dist'     => 'required',
            'distribusi_id'    => 'required',
            'prk_id'            => 'required',
            'spb_id'            => 'required',
            'pabrikan_id'            => 'required',
            'total_spb_dist'        => 'required'
        ]);

        Spb_Distribusi::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'SPB telah ditambahkan'
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
        $spbDistribusi = Spb_Distribusi::find($id);
        return $spbDistribusi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spbDistribusi = Spb_Distribusi::find($id);
        return $spbDistribusi;
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
            'tanggal_spb_dist'     => 'required',
            'distribusi_id'    => 'required',
            'prk_id'            => 'required',
            'spb_id'            => 'required',
            'pabrikan_id'            => 'required',
            'total_spb_dist'        => 'required'
        ]);

        $spb_distribusi = Spb_Distribusi::findOrFail($id);
        $spb_distribusi->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'SPB Distribusi Berhasil Diperbarui'
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
        Spb_Distribusi::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'SPB Distribusi Berhasil di hapus'
        ]);
    }

    public function apiSpbDist(){

        $spbDistribusi = Spb_Distribusi::all();
        

        return Datatables::of($spbDistribusi)
            ->addColumn('no_prk', function ($spbDistribusi){
                return $spbDistribusi->prk->noPrk;
            })

            ->addColumn('material', function ($spbDistribusi){
                return $spbDistribusi->distribusi->nama_material_distribusi;
            })

            ->addColumn('pabrikan', function ($spbDistribusi){
                return $spbDistribusi->pabrikan->pabrikan_mstr;
            })
           
            ->addColumn('no_spb', function ($spbDistribusi){
                return $spbDistribusi->spb->no_spb_mstr;
            })
           
            ->addColumn('harga', function ($spbDistribusi){
                return $spbDistribusi->distribusi->harga_satuan_dist;
            })

            ->addColumn('transport', function ($spbDistribusi){
                return $spbDistribusi->distribusi->asuransi_dan_transportasi_dist;
            })

            ->addColumn('satuan', function ($spbDistribusi){
                return $spbDistribusi->distribusi->satuan_distribusi;
            })
          
            ->addColumn('jenis_material', function ($spbDistribusi){
                return $spbDistribusi->distribusi->jenis_material_distribusi;
            })
          
          
            ->addColumn('action', function($spbDistribusi){
                return 
                    '<a onclick="editForm('. $spbDistribusi->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $spbDistribusi->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
            })
            ->rawColumns(['no_prk','material','no_spb','pabrikan','harga','jenis_material','action'])->make(true);

    }

    public function exportSpbDistribusiAll()
    {
        $spb_distribusi = Spb_Distribusi::all();
        $pdf = PDF::loadView('spb_distribusi.spbDistribusiAllPDF',compact('spb_distribusi'))->setPaper('a4','landscape');
        return $pdf->download('spb_distribusi.pdf');
    }

   

    public function exportExcel()
    {
        return (new ExportSpbDistribusi)->download('spb_distribusi.xlsx');
    }
}
