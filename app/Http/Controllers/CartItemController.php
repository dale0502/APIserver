<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCartItemRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreCartItemRequest $request)
    {
        $validated = $request->validated();

        $product = Product::find( $validated ['product_id']);
        if(!$product->checkQuantity($validated ['product_id'])){
            return response($product->title.'數量不足' , 400);
        }

        $cart = Cart::find($validated['cart_id']);
        $result = $cart->cartItems()->create([
            'product_id' => $product->id,
            'quantity' => $validated ['quantity']
        ]);
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $form = $request->all();
        $item = CartItem::find($id);
        $item->fill(['quantity' => $form['quantity']]);
        $item->save();
        return response('更新數量為'.$form['quantity']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CartItem::find($id)->delete();
        return response('第'.$id.'筆資料已刪除');
    }
}
