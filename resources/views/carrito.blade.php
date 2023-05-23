@extends('layouts.app')

@section('content')
<div class="mt-5 flex flex-col items-center justify-center align-center text-white">
    <h1>Carrito de Compras</h1>
    @if(count($cart)==0)
    <p>No hay productos en el carrito.</p>

    <form action="{{ route('history.show') }}" method="POST">
        @csrf
        <button type="submit">Historial</button>
    </form>
    {{-- <a href="/historial">Historial</a> --}}
    @else
    <table class="border 1px white">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                {{-- <th>Borrar</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $itemId => $itemDetails)
            <tr>
                <td>{{ $itemDetails['name'] }}</td>
                <td>{{ $itemDetails['price'] }}</td>
                {{-- <td><a href="/delete/{{ $cartItem->id }}">Delete</a></td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('buy.carrito') }}" method="POST">
        @csrf
        <button type="submit">Comprar</button>
    </form>

    {{-- <a href="/carrito/buy">Comprar</a> --}}
    <br>
    <form action="{{ route('history.show') }}" method="POST">
        @csrf
        <button type="submit">Historial</button>
    </form>
    {{-- <a href="/historial">Historial</a> --}}
    @endif

    {{-- <a href="{{ route('checkout') }}">Proceder al pago</a> --}}
</div>
@endsection