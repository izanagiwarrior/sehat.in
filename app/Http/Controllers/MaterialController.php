<?php

namespace App\Http\Controllers;

use App\Material;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Category;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $title = Products::find($id)->title;
        $data = Material::where('id_product','=',$id)->get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . action('MaterialController@update_view', [$data->id_product,$data->id]) . '" type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a data-toggle="confirmation" data-singleton="true" data-popout="true" href="' . action('MaterialController@delete', [$data->id_product,$data->id]) . '" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"' . "onclick='return'" . '>Delete</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('cms.material.material',compact('title','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_view($id)
    {
        $category = Category::all();
        $crafter = Auth::user();
        return view('cms.material.create', compact('category', 'crafter','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_process(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $material = new Material();
        $material->id_product = $id;
        $material->name = $request->name;
        $material->price = $request->price;
        $material->save();

        return redirect()->route('material',$id)->withSuccess('Material created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_view($id,$id_material)
    {
        $data = Material::find($id_material);
        $category = Category::all();
        return view('cms.material.update', compact('data', 'category','id'));
    }

    public function update_process(Request $request, $id, $id_material)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        

        $material = Material::find($id_material);
        $material->id_product = $id;
        $material->name = $request->name;
        $material->price = $request->price;
        $material->save();

        return redirect()->route('material',$id)->withSuccess('Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete($id,$id_material)
    {
        $material = Material::find($id_material);
        $material->delete();

        return redirect()->route('material',$id)->withSuccess('Material deleted successfully.');
    }
}
