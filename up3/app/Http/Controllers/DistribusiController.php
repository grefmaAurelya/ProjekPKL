<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportDistribusi;
use Yajra\DataTables\Datatables;
use App\Distribusi;
use DB;
use PDF;

class DistribusiController extends Controller
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
        $distribusies = Distribusi::all();
        
        return view('distribusies.index', compact('distribusies'));
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
           'nama_material_distribusi'   => 'required|string|min:2|unique:distribusi'
        ]);

        Distribusi::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'Material Distribusi Berhasil Ditambahkan'
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
        $distribusi = Distribusi::find($id);
        return $distribusi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distribusi = Distribusi::find($id);
        return $distribusi;
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
            'nama_material_distribusi'   => 'required|string|min:2'
        ]);

        $distribusi = Distribusi::findOrFail($id);

        $distribusi->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Material Distribusi telah diperbarui'
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
        Distribusi::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Material Distribusi Berhasil di hapus'
        ]);
    }

    public function apiDistribusi()
    {
        $distribusi = Distribusi::all();

        return Datatables::of($distribusi)
            ->addColumn('action', function($distribusi){
                return 
                    '<a onclick="editForm('. $distribusi->id.')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $distribusi->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function exportDistribusiesAll()
    {
        $distribusies = Distribusi::all();
        $pdf = PDF::loadView('distribusies.DistribusiAllPDF',compact('distribusies'))->setPaper('a4','landscape');
        return $pdf->download('Daftar_Material_Distribusi.pdf');
    }


    public function exportExcel()
    {
        return (new ExportDistribusi())->download('Daftar_Material_Distribusi.xlsx');
    }
}
