<?php

namespace App\Http\Controllers;

use App\Category;
use App\Products;
use App\Recipe;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Products::latest()->paginate(6);
        return view('cms.product.product', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_view()
    {
        $category = Category::all();
        $crafter = Auth::user();
        return view('cms.product.create', compact('category', 'crafter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_process(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'foto' => 'required', 'mimes:jpg,jpeg,png',
            'titlerecipe' => 'required',
            'linkvideo' => 'required',
            'descriptionrecipe' => 'required',
        ]);

        $product = new Products();
        $product->id_category = $request->category;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->photo = Storage::disk('public')->put('product', $request->file('foto'));
        $product->save();

        $recipe = new Recipe();
        $recipe->id_product = $product->id;
        $recipe->title = $request->titlerecipe;
        $recipe->link_video = $request->linkvideo;
        $recipe->description = $request->descriptionrecipe;
        $recipe->save();
        
        return redirect()->route('product')->withSuccess('Product created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_view($id)
    {
        $data = Products::find($id);
        $data_recipe = Recipe::where('id_product','=',$data->id)->first();
        $category = Category::all();
        return view('cms.product.update', compact('data', 'category','data_recipe'));
    }

    public function update_process(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'foto' => 'mimes:jpg,jpeg,png',
            'titlerecipe' => 'required',
            'linkvideo' => 'required',
            'descriptionrecipe' => 'required',
        ]);

        $product = Products::find($id);
        $product->id_category = $request->category;
        $product->title = $request->title;
        $product->description = $request->description;

        if (isset($request->foto)) {
            $image_path = 'storage/' . $product->photo;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $product->photo = Storage::disk('public')->put('product', $request->file('foto'));
        }

        $product->save();

        $recipe = Recipe::where('id_product','=',$id)->first();
        $recipe->title = $request->titlerecipe;
        $recipe->link_video = $request->linkvideo;
        $recipe->description = $request->descriptionrecipe;
        $recipe->save();

        return redirect()->route('product')->withSuccess('Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $product = Products::find($id);
        $image_path = 'storage/' . $product->photo;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $product->delete();

        return redirect()->route('product')->withSuccess('Product deleted successfully.');
    }
}
