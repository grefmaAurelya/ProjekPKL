<?php

namespace App\Http\Controllers;


use App\Exports\ExportPemasok;
use App\Pemasok;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;


class PemasokController extends Controller
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
        $pemasoks = Pemasok::all();
        return view('pemasoks.index');
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
            'nama'      => 'required',
            'alamat'    => 'required',
            'email'     => 'required|unique:pemasok',
            'telepon'   => 'required',
        ]);

        Pemasok::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'pemasok Created'
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
        $pemasok = Pemasok::find($id);
        return $pemasok;
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
            'nama'      => 'required|string|min:2',
            'alamat'    => 'required|string|min:2',
            'email'     => 'required|string|email|max:255',
            'telepon'   => 'required|string|min:2',
        ]);

        $pemasok = Pemasok::findOrFail($id);

        $pemasok->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Pemasok berhasil di Updated'
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
        Pemasok::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Pemasok berhasil di Delete'
        ]);
    }

    public function apiPemasoks()
    {
        $pemasoks = Pemasok::all();

        return Datatables::of($pemasoks)
            ->addColumn('action', function($pemasoks){
                return 
                    '<a onclick="editForm('. $pemasoks->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $pemasoks->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function ImportExcel(Request $request)
    {
        //Validasi
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file'); //GET FILE
            Excel::import(new PemasokImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data pemasoks !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }

    public function exportPemasoksAll()
    {
        $pemasoks = Pemasok::all();
        $pdf = PDF::loadView('pemasoks.PemasoksAllPDF',compact('pemasoks'));
        return $pdf->download('pemasoks.pdf');
    }

    public function exportExcel()
    {
        return (new ExportPemasok)->download('pemasoks.xlsx');
    }
}
