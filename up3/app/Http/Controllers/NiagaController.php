<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Exports\ExportNiaga;
use App\Niaga;
use PDF;

class NiagaController extends Controller
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
        $niagas = Niaga::all();
        
        return view('niagas.index', compact('niagas'));
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
           'nama_material_niaga'   => 'required|string|min:2|unique:niagas'
        ]);

        Niaga::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'Categories Created'
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
        $niaga = Niaga::find($id);
        return $niaga;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $niaga = Niaga::find($id);
        return $niaga;
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
            'nama_material_niaga'   => 'required|string|min:2'
        ]);

        $niaga = Niaga::findOrFail($id);

        $niaga->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Material Niaga telah diperbarui'
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
        Niaga::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Material Niaga Berhasil di hapus'
        ]);
    }

    public function apiNiaga()
    {
        $niaga = Niaga::all();

        return Datatables::of($niaga)
            ->addColumn('action', function($niaga){
                return 
                    '<a onclick="editForm('. $niaga->id.')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $niaga->id.')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function exportNiagasAll()
    {
        $niagas = Niaga::all();
        $pdf = PDF::loadView('niagas.NiagaAllPDF',compact('niagas'))->setPaper('a4','landscape');
        return $pdf->download('Daftar_Material_Niaga.pdf');
    }


    public function exportExcel()
    {
        return (new ExportNiaga())->download('Daftar_Material_Niaga.xlsx');
    }
}
