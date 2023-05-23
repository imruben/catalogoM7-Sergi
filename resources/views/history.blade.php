@extends('layouts.app')

@section('content')
{{-- @dd(session('historial')) --}}
    @if(session('historial'))
        <h1>Historial de Compras</h1>
        <ul>
            <li>
                <p>Hora: {{ session('historial')['hora'] }}</p>
                <p>Carrito:</p>
                <ul>
                    @foreach(session('historial')['carrito'] as $item)
                        <li>{{ $item['name'] }}</li>
                    @endforeach
                </ul>
            </li>
        </ul>
    @else
        <p>No hay compras en el historial.</p>
    @endif


    {{-- <a href="{{ route('checkout') }}">Proceder al pago</a> --}}
@endsection
