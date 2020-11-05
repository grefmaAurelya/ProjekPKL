<?php

namespace App\Http\Controllers;

use App\Category;
use App\Barang;
use App\Barang_Masuk;
use App\Barang_Keluar;
use App\Spbdist;
use App\Spbniaga;
use App\Exports\ExportCategories;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use PDF;

use DB;

class CategoryController extends Controller
{
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
        $categories = Category::all();
        
        $barangs = Barang::all();
        return view('categories.index', compact('categories','barangs'));
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
           'categories_name'   => 'required|string|min:2'
        ]);

        Category::create($request->all());

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
        $category = Category::find($id);
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return $category;
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
            'categories_name'   => 'required|string|min:2'
        ]);

        $category = Category::findOrFail($id);

        $category->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Categories Update'
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
        Category::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Categories Delete'
        ]);
    }

    public function apiCategories()
    {
        $categories = Category::all();

        return Datatables::of($categories)
            ->addColumn('action', function($categories){
                return 
                    '<a onclick="editForm('. $categories->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $categories->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function exportCategoriesAll()
    {
        $categories = Category::all();
        $pdf = PDF::loadView('categories.CategoriesAllPDF',compact('categories'));
        return $pdf->download('categories.pdf');
    }

    public function exportCategory($id)
    {
    
        $category = Category::findOrFail($id);
        $barang = Barang:: all();
        $spbdist = Spbdist:: all();
        $spbniaga = Spbniaga:: all();
        $data = DB::table('barang')
            ->leftjoin('spbdist', 'spbdist.barang_id', '=', 'barang.id')
            ->leftjoin('spbniaga', 'spbniaga.barang_id', '=', 'barang.id')
            ->leftjoin('barang_masuk', 'barang_masuk.barang_id', '=', 'barang.id')
            ->leftjoin('barang_keluar', 'barang_keluar.barang_id', '=', 'barang.id')
            
            ->select('spbdist.spbdist_total','barang.name','barang.category_id','spbniaga.spbniaga_total','barang.total','barang_masuk.barang_masuk_total','barang_keluar.barang_keluar_total')
            ->get();
        $datas = $data -> where('category_id',$id);
        $pdf = PDF::loadView('categories.categoriesPDF', compact('category','data','datas','barang','spbniaga'))->setPaper('a4','landscape');
        return $pdf->download($category->id.'_category.pdf');
    }

    public function exportExcel()
    {
        return (new ExportCategories())->download('categories.xlsx');
    }
}