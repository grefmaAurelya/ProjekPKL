<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Exports\ExportPenetapanDistribusi;
use App\Penetapan_Distribusi;
use App\Distribusi;
use App\Prk;
use PDF;

class PenetapanDistribusiController extends Controller
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
        $penetapan_distribusi = Penetapan_Distribusi::all();

        $distribusi = Distribusi::orderBy('nama_material_distribusi','ASC')
        ->get()
        ->pluck('nama_material_distribusi','id');

        $prk = Prk::orderBy('noPrk','ASC')
        ->get()
        ->pluck('noPrk','id');

        return view('penetapan_distribusi.index', compact('penetapan_distribusi','distribusi','prk'));
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
            'tanggal_penetapan_dist'     => 'required',
            'distribusi_id'    => 'required',
            'prk_id'            => 'required',
            'total_penetapan_dist'        => 'required'
        ]);

        Penetapan_Distribusi::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Penetapan telah ditambahkan'
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
        $penetapanDistribusi = Penetapan_Distribusi::find($id);
        return $penetapanDistribusi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penetapanDistribusi = Penetapan_Distribusi::find($id);
        return $penetapanDistribusi;
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
            'tanggal_penetapan_dist'     => 'required',
            'distribusi_id'    => 'required',
            'prk_id'            => 'required',
            'total_penetapan_dist'        => 'required'
        ]);

        $penetapan_distribusi = Penetapan_Distribusi::findOrFail($id);
        $penetapan_distribusi->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Penetapan Distribusi Berhasil Diperbarui'
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
        Penetapan_Distribusi::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Penetapan Distribusi Berhasil di hapus'
        ]);
    }

    public function apiPenetapanDist(){

        $penetapanDistribusi = Penetapan_Distribusi::all();
        

        return Datatables::of($penetapanDistribusi)
            ->addColumn('no_prk', function ($penetapanDistribusi){
                return $penetapanDistribusi->prk->noPrk;
            })

            ->addColumn('material', function ($penetapanDistribusi){
                return $penetapanDistribusi->distribusi->nama_material_distribusi;
            })
           
          
            ->addColumn('action', function($penetapanDistribusi){
                return 
                    '<a onclick="editForm('. $penetapanDistribusi->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $penetapanDistribusi->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
            })
            ->rawColumns(['no_prk','material','action'])->make(true);

    }

    public function exportPenetapanDistribusiAll()
    {
        $penetapan_distribusi = Penetapan_Distribusi::all();
        $pdf = PDF::loadView('penetapan_distribusi.penetapanDistribusiAllPDF',compact('penetapan_distribusi'))->setPaper('a4','landscape');
        return $pdf->download('penetapan_distribusi.pdf');
    }

   

    public function exportExcel()
    {
        return (new ExportPenetapanDistribusi)->download('penetapan_distribusi.xlsx');
    }
}
