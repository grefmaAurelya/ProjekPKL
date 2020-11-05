<?php

namespace App\Http\Controllers;


use App\Spbdist;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Exports\ExportSpbdists;
use App\Category;
use App\Barang;
use PDF;
use DB;

class SpbdistController extends Controller
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
        $spbdists = Spbdist::all();
        $prod= Category::all();

        $category = Category::orderBy('categories_name','ASC')
        ->get()
        ->pluck('categories_name','id');

        $barangs = Barang::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');

        // $datas = $barangs -> where('id', 'category_id');
        
        return view('spbdists.index', compact('spbdists','category','barangs','prod'));
 

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

        Spbdist::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'SPB Distribusi Berhasil di Tambahkan'
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
        $spbdist = Spbdist::find($id);
        return $spbdist;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spbdist = Spbdist::find($id);
        return $spbdist;
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

        $spbdist = Spbdist::findOrFail($id);

        $spbdist->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'SPB Distribusi Berhasil di Update'
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
        Spbdist::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'SPB Distribusi Berhasil di Delete'
        ]);
    }

    public function apiSpbdists()
    {
        $spbdists = Spbdist::all();

            return Datatables::of($spbdists)
            ->addColumn('spbdists_name', function ($spbdists){
                return $spbdists->barang->name;
            })
            ->addColumn('action', function($spbdists){
                return 
                    '<a onclick="editForm('. $spbdists->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $spbdists->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['spbdists_name','action'])->make(true);
    }

    public function exportSpbdistsAll()
    {
        $spbdists = Spbdist::all();
        $pdf = PDF::loadView('spbdists.SpbdistsAllPDF',compact('spbdists'))->setPaper('a4','landscape');
        return $pdf->download('spbdists.pdf');
    }


    public function exportExcel()
    {
        return (new ExportSpbdists())->download('spb_distribusi.xlsx');
    }

	public function findProductName(Request $request){

		
	    //if our chosen id and products table prod_cat_id col match the get first 100 data 

        //$request->id here is the id of our chosen option id
        $data=Barang::select('name','id')->where('category_id',$request->id)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
	}

}