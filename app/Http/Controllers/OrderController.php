<?php

namespace App\Http\Controllers;

use App\Order;
use App\Products;
use App\User;
use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if (Auth::user()->roles === 'admin') {
                $product = Products::all();
            } else {
                $product = Products::where('id_user', '=', Auth::user()->id)->get();
            }




            if (!empty($product)) {
                $data = [];
                foreach ($product as $d) {
                    $order = Order::where('id_product', '=', $d->id)->get();
                    $order_count = Order::where('id_product', '=', $d->id)->count();
                    if ($order_count != 0) {
                        array_push($data, $order);
                    }
                }
            }
            $data = $data[0];

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('order.status', [$data->id, 'Done']) . '" type="button" name="edit" id="' . $data->id . '" class="edit btn btn-success btn-sm">Done</a>';
                    $button .= '&nbsp;&nbsp;<a href="' . route('order.status', [$data->id, 'Cancelled']) . '" type="button" name="edit" id="' . $data->id . '" class="edit btn btn-danger btn-sm">Cancelled</a>';
                    return $button;
                })
                ->addColumn('product', function ($data) {
                    $product = Products::find($data->id_product);
                    return $product->title;
                })
                ->addColumn('customer', function ($data) {
                    $user = User::find($data->id_user);
                    return $user->name . ' ' . $user->last_name;
                })
                ->rawColumns(['action', 'product', 'customer'])
                ->make(true);
        }

        return view('cms.order.order');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update_status($id_order, $status)
    {
        $order = Order::find($id_order);
        $order->status = $status;
        $order->save();

        return redirect()->route('order');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
