<?php

namespace App\Http\Controllers;

use App\Category;
use App\Products;
use App\Recipe;
use App\View;
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
        if (Auth::user()->roles === 'admin') {
            $data = Products::latest()->paginate(6);
        } else {
            $data = Products::where('id_user', '=', Auth::user()->id)->paginate(6);
        }

        foreach ($data as $d) {
            $view_count = View::where('id_product', '=', $d->id)->count();
            $d->{'view_count'} = $view_count;
        }

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
        $product->id_user = Auth::user()->id;
        $product->id_category = $request->category;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->photo = Storage::disk('public')->put('product', $request->file('foto'));

        if (isset($request->energy)) {
            $product->energy = $request->energy;
        }
        if (isset($request->protein)) {
            $product->protein = $request->protein;
        }
        if (isset($request->fat)) {
            $product->fat = $request->fat;
        }
        if (isset($request->carbohydrate)) {
            $product->carbohydrate = $request->carbohydrate;
        }
        if (isset($request->calorie)) {
            $product->calorie = $request->calorie;
        }
        if (isset($request->fiber)) {
            $product->fiber = $request->fiber;
        }
        if (isset($request->sodium)) {
            $product->sodium = $request->sodium;
        }
        if (isset($request->sugar)) {
            $product->sugar = $request->sugar;
        }
        if (isset($request->vitamin_a)) {
            $product->vitamin_a = $request->vitamin_a;
        }
        if (isset($request->vitamin_c)) {
            $product->vitamin_c = $request->vitamin_c;
        }
        if (isset($request->vitamin_d)) {
            $product->vitamin_d = $request->vitamin_d;
        }
        if (isset($request->vitamin_e)) {
            $product->vitamin_e = $request->vitamin_e;
        }
        if (isset($request->vitamin_k)) {
            $product->vitamin_k = $request->vitamin_k;
        }
        if (isset($request->calcium)) {
            $product->calcium = $request->calcium;
        }
        if (isset($request->magnesium)) {
            $product->magnesium = $request->magnesium;
        }
        if (isset($request->zinc)) {
            $product->zinc = $request->zinc;
        }
        if (isset($request->water)) {
            $product->zinc = $request->zinc;
        }
        if (isset($request->mineral)) {
            $product->zinc = $request->zinc;
        }


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
        $data_recipe = Recipe::where('id_product', '=', $data->id)->first();
        $category = Category::all();
        return view('cms.product.update', compact('data', 'category', 'data_recipe'));
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

        if (isset($request->energy)) {
            $product->energy = $request->energy;
        }
        if (isset($request->protein)) {
            $product->protein = $request->protein;
        }
        if (isset($request->fat)) {
            $product->fat = $request->fat;
        }
        if (isset($request->carbohydrate)) {
            $product->carbohydrate = $request->carbohydrate;
        }
        if (isset($request->calorie)) {
            $product->calorie = $request->calorie;
        }
        if (isset($request->fiber)) {
            $product->fiber = $request->fiber;
        }
        if (isset($request->sodium)) {
            $product->sodium = $request->sodium;
        }
        if (isset($request->sugar)) {
            $product->sugar = $request->sugar;
        }
        if (isset($request->vitamin_a)) {
            $product->vitamin_a = $request->vitamin_a;
        }
        if (isset($request->vitamin_c)) {
            $product->vitamin_c = $request->vitamin_c;
        }
        if (isset($request->vitamin_d)) {
            $product->vitamin_d = $request->vitamin_d;
        }
        if (isset($request->vitamin_e)) {
            $product->vitamin_e = $request->vitamin_e;
        }
        if (isset($request->vitamin_k)) {
            $product->vitamin_k = $request->vitamin_k;
        }
        if (isset($request->calcium)) {
            $product->calcium = $request->calcium;
        }
        if (isset($request->magnesium)) {
            $product->magnesium = $request->magnesium;
        }
        if (isset($request->zinc)) {
            $product->zinc = $request->zinc;
        }
        if (isset($request->water)) {
            $product->zinc = $request->zinc;
        }
        if (isset($request->mineral)) {
            $product->zinc = $request->zinc;
        }

        $product->save();

        $recipe = Recipe::where('id_product', '=', $id)->first();
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
