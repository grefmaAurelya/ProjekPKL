<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemakai;
use App\Category;
use App\Exports\ExportBarangKeluar;
use App\Barang;
use App\Barang_Keluar;
use Yajra\DataTables\DataTables;
use PDF;


class BarangKeluarController extends Controller
{
     public function __construct()
    {
        $this->middleware('role:admin,jaringan');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $barangs = Barang::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $pemakais = Pemakai::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        
        $category = Category::orderBy('categories_name','ASC')
            ->get()
            ->pluck('categories_name','id');

        $invoice_data = Barang_Keluar::all();
        return view('barang_keluar.index', compact('barangs','category','pemakais', 'invoice_data'));
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
           'barang_id'     => 'required',
           'pemakai_id'    => 'required',
           'barang_keluar_total'            => 'required',
           'tanggal'           => 'required'
        ]);

        Barang_Keluar::create($request->all());

        $barang = Barang::findOrFail($request->barang_id);
        $barang->total -= $request->barang_keluar_total;
        $barang->save();

        return response()->json([
            'success'    => true,
            'message'    => 'barang Out Created'
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
        $barang_keluar = Barang_Keluar::find($id);
        return $barang_keluar;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang_keluar = Barang_Keluar::find($id);
        return $barang_keluar;
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
            'barang_id'     => 'required',
            'pemakai_id'    => 'required',
            'barang_keluar_total'   => 'required',
            'tanggal'           => 'required'
        ]);

        $barang_keluar = Barang_Keluar::findOrFail($id);
        $barang_keluar->update($request->all());

        $barang = Barang::findOrFail($request->barang_id);
        $barang->total -= $request->barang_keluar_total;
        $barang->update();

        return response()->json([
            'success'    => true,
            'message'    => 'barang Out Updated'
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
        Barang_Keluar::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'barang Delete Deleted'
        ]);
    }



    public function apiBarangsOut(){
        $barang = Barang_Keluar::all();

        return Datatables::of($barang)
            ->addColumn('barangs_name', function ($barang){
                return $barang->barang->name;
            })
            ->addColumn('pemakai_name', function ($barang){
                return $barang->pemakai->nama;
            })
            ->addColumn('action', function($barang){
                return 
                    '<a onclick="editForm('. $barang->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $barang->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['barangs_name','pemakai_name','action'])->make(true);

    }

    public function exportBarangKeluarAll()
    {
        $barang_keluar = Barang_Keluar::all();
        $pdf = PDF::loadView('barang_keluar.barangKeluarAllPDF',compact('barang_keluar'));
        return $pdf->download('barang_keluar.pdf');
    }

    public function exportBarangKeluar($id)
    {
        $barang_keluar = Barang_Keluar::findOrFail($id);
        $pdf = PDF::loadView('barang_keluar.barangKeluarPDF', compact('barang_keluar'));
        return $pdf->download($barang_keluar->id.'_barang_keluar.pdf');
    }

    public function exportExcel()
    {
        return (new ExportBarangKeluar)->download('barang_keluar.xlsx');
    }
}
