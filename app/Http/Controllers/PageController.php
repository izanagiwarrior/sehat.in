<?php

namespace App\Http\Controllers;

use App\Category;
use App\Material;
use Illuminate\Http\Request;
use App\Products;
use App\Store;
use App\User;
use App\View;
use App\Recipe;

class PageController extends Controller
{
    public function welcome(Request $request)
    {
        $product = Products::latest()->take(6)->get();
        return view('welcome', compact('product'));
    }

    public function katalog(Request $request, $search = "")
    {
        $product = Products::paginate(8);
        $category = Category::all();
        if (isset($request->category)) {
            $product = Products::where('id_category', '=', $request->category)->paginate(8)->get();
        } else {
            if (isset($request->search)) {
                $search = $request->search;
            }
            $product = Products::where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->paginate(8);
        }
        return view('katalog', compact('product', 'category', 'search'));
    }

    public function detailProduk(Request $request, $id_product)
    {
        // adding view
        $view = new View();
        $view->reference_id = $id_product;
        $view->save();

        $product = Products::find($id_product);
        $recipe = Recipe::where('id_product','=',$product->id)->first();
        $material = Material::where('id_product','=',$product->id)->get();
        $price = $material->sum('price');
        $data = Products::latest()->take(4)->get();
        return view('detailProduk', compact('product', 'data', 'recipe', 'material', 'price'));
    }

    public function payment(Request $request, $id_product)
    {
        $product = Products::find($id_product);
        $recipe = Recipe::where('id_product','=',$product->id)->first();
        $material = Material::where('id_product','=',$product->id)->get();
        $price = $material->sum('price');
        $data = Products::latest()->take(4)->get();

        return view('payment', compact('product', 'data', 'recipe', 'material', 'price','id_product'));
    }

    public function topUp_process(Request $request, $id_product)
    {
        $product = Products::find($id_product);
        $recipe = Recipe::where('id_product','=',$product->id)->first();
        $material = Material::where('id_product','=',$product->id)->get();
        $price = $material->sum('price');
        $data = Products::latest()->take(4)->get();

        return view('paymentSuccess', compact('product', 'data', 'recipe', 'material', 'price','id_product'));
    }
}
