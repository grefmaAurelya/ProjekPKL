<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Prk;


class PrkController extends Controller
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
        $prks = Prk::all();
        
        return view('prks.index', compact('prks'));
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
           'noPrk'   => 'required|string|min:2|unique:prk'
        ]);

        Prk::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'PRK berhasil di tambahkan'
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
        $prks = Prk::find($id);
        return $prks;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prks = Prk::find($id);
        return $prks;
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
            'noPrk'   => 'required|string|min:2|unique:prk'
        ]);

        $prks = Prk::findOrFail($id);

        $prks->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'PRK telah diperbarui'
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
        Prk::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'PRK Berhasil di hapus'
        ]);
    }

    public function apiPrks()
    {
        $prk = Prk::all();

        return Datatables::of($prk)
            ->addColumn('action', function($prk){
                return 
                    '<a onclick="editForm('. $prk->id.')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $prk->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

}
