<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\exportBarangMasuk;
use App\Barang;
use App\Barang_Masuk;
use App\Pemasok;
use App\Category;
use PDF;
use Yajra\DataTables\DataTables;


class BarangMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,gudang');
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

        $pemasoks = Pemasok::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');

        $category = Category::orderBy('categories_name','ASC')
            ->get()
            ->pluck('categories_name','id');

        $invoice_data = Barang_Masuk::all();
        return view('barang_masuk.index', compact('barangs','category','pemasoks','invoice_data'));
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
            'pemasok_id'    => 'required',
            'barang_masuk_total'            => 'required',
            'tanggal'        => 'required'
        ]);

        Barang_Masuk::create($request->all());

        $barang = Barang::findOrFail($request->barang_id);
        $barang->total += $request->barang_masuk_total;
        $barang->save();

        return response()->json([
            'success'    => true,
            'message'    => 'barangs In Created'
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang_masuk = Barang_Masuk::find($id);
        return $barang_masuk;
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
            'pemasok_id'    => 'required',
            'barang_masuk_total'=> 'required',
            'tanggal'        => 'required'
        ]);

        $barang_masuk = Barang_Masuk::findOrFail($id);
        $barang_masuk->update($request->all());

        $barang = Barang::findOrFail($request->barang_id);
        $barang->total += $request->barang_masuk_total;
        $barang->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Barang In Updated'
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
        Barang_Masuk::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Barangs In Deleted'
        ]);
    }



    public function apiBarangsIn(){
        $barang = Barang_Masuk::all();

        return Datatables::of($barang)
            ->addColumn('barangs_name', function ($barang){
                return $barang->barang->name;
            })
            ->addColumn('pemasok_name', function ($barang){
                return $barang->pemasok->nama;
            })
           
          
            ->addColumn('action', function($barang){
                return 
                    '<a onclick="editForm('. $barang->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $barang->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';


            })
            ->rawColumns(['barangs_name','pemasok_name','action'])->make(true);

    }

    public function exportBarangMasukAll()
    {
        $barang_masuk = Barang_Masuk::all();
        $pdf = PDF::loadView('barang_masuk.barangMasukAllPDF',compact('barang_masuk'));
        return $pdf->download('barang_masuk.pdf');
    }

    public function exportBarangMasuk($id)
    {
        $barang_masuk = Barang_Masuk::findOrFail($id);
        $pdf = PDF::loadView('barang_masuk.barangMasukPDF', compact('barang_masuk'));
        return $pdf->download($barang_masuk->id.'_barang_masuk.pdf');
    }

    public function exportExcel()
    {
        return (new ExportBarangMasuk)->download('barang_masuk.xlsx');
    }
}
