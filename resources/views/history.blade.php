@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-center items-center align-center">

    @if($historial)

    <h1 class=" mt-5 mb-3 text-white">Historial de Compras</h1>
    <ul>
        @foreach($historial as $item)
        <li class="mb-5 text-white">

            <p>Hora: {{ $item['hora'] }}</p>
            <p>Carrito:</p>

            <ul>
                @foreach($item['carrito'] as $carrito)
                <li>{{ $carrito['name'] }} {{ $carrito['price'] }}€</li>
                <li></li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
    @else
    <p>No hay compras en el historial.</p>
    @endif

</div>
@endsection