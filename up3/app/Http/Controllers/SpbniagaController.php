<?php

namespace App\Http\Controllers;


use App\Spbniaga;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Exports\ExportSpbniagas;
use App\Category;
use App\Barang;
use PDF;

class SpbniagaController extends Controller
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
        $spbniagas = Spbniaga::all();

        $barangs = Barang::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');

        $category = Category::orderBy('categories_name','ASC')
        ->get()
        ->pluck('categories_name','id');
        
        return view('spbniagas.index', compact('spbniagas','category','barangs'));
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
           'barang_id'   => 'required',
           'category_id'   => 'required'
        ]);

        Spbniaga::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'SPB Niaga Berhasil di Tambahkan'
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
        $spbniaga = Spbniaga::find($id);
        return $spbniaga;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spbniaga = Spbniaga::find($id);
        return $spbniaga;
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
            'barang_id'   => 'required',
            'category_id'   => 'required'
        ]);

        $spbniaga = Spbniaga::findOrFail($id);

        $spbniaga->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'SPB Niaga Berhasil di Update'
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
        Spbniaga::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'SPB Niga Berhasil di Delete'
        ]);
    }

    public function apiSpbniagas()
    {
        $spbniagas = Spbniaga::all();

        return Datatables::of($spbniagas)
            ->addColumn('spbniagas_name', function ($spbniagas){
                return $spbniagas->barang->name;
            })
            ->addColumn('action', function($spbniagas){
                return 
                    '<a onclick="editForm('. $spbniagas->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $spbniagas->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['spbniagas_name','action'])->make(true);
    }

    public function exportSpbniagasAll()
    {
        $spbniagas = Spbniaga::all();
        $pdf = PDF::loadView('spbniagas.SpbniagasAllPDF',compact('spbniagas'))->setPaper('a4','landscape');
        return $pdf->download('spbniagas.pdf');
    }


    public function exportExcel()
    {
        return (new ExportSpbniagas())->download('spb_niaga.xlsx');
    }
}