<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Category;
use Illuminate\Http\Request;
use App\Exports\ExportBarangs;
use Yajra\DataTables\Datatables;
use PDF;
use DB;

class BarangController extends Controller
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
        $barangs = Barang::all();
        $category = Category::orderBy('categories_name','ASC')
            ->get()
            ->pluck('categories_name','id');
        
        return view('barangs.index', compact('barangs','category'));
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
           'name'   => 'required|string|min:2'
        ]);

        Barang::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'Barang Berhasil di Created'
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
        $barang = Barang::find($id);
        return $barang;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        return $barang;
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
            'name'   => 'required|string|min:2'
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Barang Berhasil di Update'
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
        Barang::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Barang Berhasil di Delete'
        ]);
    }

    public function apiBarangs()
    {
        $barangs = Barang::all();

        return Datatables::of($barangs)
            ->addColumn('action', function($barangs){
                return 
                    '<a onclick="editForm('. $barangs->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $barangs->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function exportBarangsAll()
    {
        $barangs = Barang::all();
        $pdf = PDF::loadView('barangs.BarangsAllPDF',compact('barangs'));
        return $pdf->download('barangs.pdf');
    }


    public function exportExcel()
    {
        return (new ExportBarangs())->download('barangs.xlsx');
    }
}
