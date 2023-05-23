<?php

namespace App\Http\Controllers;

use App\Models\Burgir;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class BurgirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // http::withHeaders()
        $client = new Client();
        // $burgers = Burgir::all();
        $response = $client->get('https://unruffled-antonelli.82-223-123-69.plesk.page/api/burgir',[
            'headers' => [
                'Authorization' => 'Bearer 2|rQ2rHOoODx7H50oOTTni5PFXSynmQvJLm1I8eYkd',
                'Accept' => 'application/json',
            ],
        ]);
        $burgers = json_decode($response->getBody(), true);
        // dd($burgers);
        return view('dashboard')->with('burgers', $burgers);
        // return $burgers;
    }
    // public function indexBueno(){
    //     $response = Http::get('http://example.com');
    //     return view('dashboard')->with('burgers', $burgers);
    // }
    public function indexCarrito()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();
        return view('carrito')->with('cartItems', $cartItems);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string',
    //         'price' => 'required|int',
    //     ]);
    //     Burgir::create($validated);
    //     return "burgir creada";
    //     // $burgir = Burgir::find($validated['id']);
    //     // if(!$burgir){
    //     //     return "burgir no encontrada";
    //     // }
    //     // $burgir->update($validated);

    //     // return response()->json($burgir, 200);
    // }
    public function store(Request $request)
    {
        $client = new Client();
        $data = [
            'name' => $request->input('item_name'),
            'price' => $request->input('item_price')
        ];

        $json = json_encode($data);
        // $response = $client->put('https://unruffled-antonelli.82-223-123-69.plesk.page/api/burgir/', [
        //     'headers' => [
        //         'Authorization' => 'Bearer 2|rQ2rHOoODx7H50oOTTni5PFXSynmQvJLm1I8eYkd',
        //     ],
        //     'form_params' => $data,
        // ]);
        $response = Http::withToken('2|rQ2rHOoODx7H50oOTTni5PFXSynmQvJLm1I8eYkd')->withBody($json, 'application/json')->post('https://unruffled-antonelli.82-223-123-69.plesk.page/api/burgir');

        return back()->with('success', 'Burger creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $burgir = Burgir::find($id);
        if(!$burgir){
            return "burgir no encontrada";
        }
        return response()->json($burgir, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request)
    // {
    //     //return $request;
    //     $validated = $request->validate([
    //         'id' => 'required|int',
    //         'name' => 'string',
    //         'price' => 'int',
    //     ]);
    //     $burgir = Burgir::find($validated['id']);
    //     if(!$burgir){
    //         return "burgir no encontrada";
    //     }
    //     $burgir->update($validated);

    //     return response()->json($burgir, 200);
    // }
    public function update(Request $request)
    {
        // dd($request->all());
        $client = new Client();
        $data = [
            'id' => $request->input('item_id'),
            'name' => $request->input('item_name'),
            'price' => $request->input('item_price')
        ];

        $json = json_encode($data);
        // $response = $client->put('https://unruffled-antonelli.82-223-123-69.plesk.page/api/burgir/', [
        //     'headers' => [
        //         'Authorization' => 'Bearer 2|rQ2rHOoODx7H50oOTTni5PFXSynmQvJLm1I8eYkd',
        //     ],
        //     'form_params' => $data,
        // ]);
        $response = Http::withToken('2|rQ2rHOoODx7H50oOTTni5PFXSynmQvJLm1I8eYkd')->withBody($json, 'application/json')->put('https://unruffled-antonelli.82-223-123-69.plesk.page/api/burgir');
        //dd($response->body());
        return back()->with('success', 'Burger actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new Client();
        $response = $client->delete('https://unruffled-antonelli.82-223-123-69.plesk.page/api/burgir/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer 2|rQ2rHOoODx7H50oOTTni5PFXSynmQvJLm1I8eYkd',
                'Accept' => 'application/json',
            ],
        ]);

        return back()->with('success', 'Burger borrada');
    }
    public function buy($id)
    {
        $burger = Burgir::findOrFail($id);

        $user = Auth::user();
        $order = new CartItem();
        $order->user_id = $user->id;
        $order->product_id = $burger->id;
        $order->quantity = 1;
        $order->price = $burger->price;
        $order->save();

        return back()->with('success', 'Producto comprado exitosamente');
    }

}
