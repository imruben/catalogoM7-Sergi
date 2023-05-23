<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $itemId = $request->input('item_id');
        $itemName = $request->input('item_name');
        $itemPrice = $request->input('item_price');

        $cart = Session::get('cart', []);

        $cart[$itemId] = [
            'name' => $itemName,
            'price' => $itemPrice,
        ];

        Session::put('cart', $cart);
        //dd($cart);
        // return redirect()->route('cart');
        return back()->with('success', 'Burgir comprada');
    }
    public function showCart()
    {
        $cart = Session::get('cart', []);

        return view('carrito')->with('cart', $cart);
    }

    public function delete($id)
    {
        $burgir = CartItem::find($id);
        if (!$burgir) {
            return "burgir no encontrada";
        }
        $burgir->delete();

        // return response()->json(['message' => 'Burgir borrada'], 204);
        return back()->with('success', 'Burgir borrada');
    }
    public function buy(Request $request)
    {
        // $cartItems = CartItem::all();
        // foreach ($cartItems as $cartItem) {
        //     History::create([
        //         'user_id' => $cartItem->user_id,
        //         'product_id' => $cartItem->product_id,
        //         'quantity' => $cartItem->quantity,
        //         'price' => $cartItem->price,
        //     ]);
        // }
        // CartItem::truncate();
        // $burgir->delete();
        $carrito = Session::get('cart', []);
        // dd($carrito);
        $hora = now()->format('Y-m-d H:i:s');

        $historial = $request->session()->get('historial', []);
        // dd($historia l);
        $historial[] = [
            'carrito' => $carrito,
            'hora' => $hora,
        ];
        $request->session()->put('historial', $historial);


        $request->session()->forget('cart');

        // return redirect()->route('historial')->with('success', 'Compra realizada con éxito');
        return back()->with('success', 'Burgir compradas');
    }
    public function indexHistory(Request $request)
    {
        $historial = $request->session()->get('historial', []);
        // dd($historial);
        // die();
        return view('history')->with('historial', $historial);
        // $historys = History::where('user_id', auth()->id())->get();
        // return view('history')->with('historys', $historys);
    }
}
