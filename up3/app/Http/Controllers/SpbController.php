<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Spb;


class SpbController extends Controller
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
        $spbs = Spb::all();
        
        return view('spbs.index', compact('spbs'));
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
           'no_spb_mstr'   => 'required|string|min:2|unique:spb'
        ]);

        Spb::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'No. SPB berhasil di tambahkan'
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
        $spbs = Spb::find($id);
        return $spbs;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spbs = Spb::find($id);
        return $spbs;
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
            'no_spb_mstr'   => 'required|string|min:2|unique:spb'
        ]);

        $spbs = Spb::findOrFail($id);

        $spbs->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'No. SPB telah diperbarui'
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
        Spb::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'No. SPB Berhasil di hapus'
        ]);
    }

    public function apiSpbs()
    {
        $spb= Spb::all();

        return Datatables::of($spb)
            ->addColumn('action', function($spb){
                return 
                    '<a onclick="editForm('. $spb->id.')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $spb->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

}
