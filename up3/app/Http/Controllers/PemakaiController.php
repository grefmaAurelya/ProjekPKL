<?php

namespace App\Http\Controllers;


use App\Exports\ExportPemakai;
use App\Pemakai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;


class PemakaiController extends Controller
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
        $pemakais = Pemakai::all();
        return view('pemakais.index');
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
            'email'     => 'required|unique:pemakai',
            'telepon'   => 'required',
        ]);

        Pemakai::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'pemakai Created'
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
        $pemakai = Pemakai::find($id);
        return $pemakai;
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

        $pemakai = Pemakai::findOrFail($id);

        $pemakai->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Pemakai berhasil di Updated'
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
        Pemakai::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Pemakai berhasil di Delete'
        ]);
    }

    public function apiPemakais()
    {
        $pemakais = Pemakai::all();

        return Datatables::of($pemakais)
            ->addColumn('action', function($pemakais){
                return 
                    '<a onclick="editForm('. $pemakais->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $pemakais->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
            Excel::import(new PemakaiImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data pemakai !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }

    public function exportPemakaisAll()
    {
        $pemakais = Pemakai::all();
        $pdf = PDF::loadView('pemakais.PemakaisAllPDF',compact('pemakais'));
        return $pdf->download('pemakais.pdf');
    }

    public function exportExcel()
    {
        return (new ExportPemakai)->download('pemakais.xlsx');
    }
}
