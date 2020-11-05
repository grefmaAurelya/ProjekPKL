<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Pabrikan;


class PabrikanController extends Controller
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
        $pabrikans = Pabrikan::all();
        
        return view('pabrikans.index', compact('pabrikans'));
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
           'pabrikan_mstr'   => 'required|string|min:2|unique:pabrikan'
        ]);

        Pabrikan::create($request->all());

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
        $pabrikan = Pabrikan::find($id);
        return $pabrikan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pabrikan = Pabrikan::find($id);
        return $pabrikan;
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
            'pabrikan_mstr'   => 'required|string|min:2|unique:pabrikan'
        ]);

        $pabrikan = Pabrikan::findOrFail($id);

        $pabrikan->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Pabrikan telah diperbarui'
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
        Pabrikan::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Pabrikan Berhasil di hapus'
        ]);
    }

    public function apiPabrikan()
    {
        $pabrikan = Pabrikan::all();

        return Datatables::of($pabrikan)
            ->addColumn('action', function($pabrikan){
                return 
                    '<a onclick="editForm('. $pabrikan->id.')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $pabrikan->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

}
