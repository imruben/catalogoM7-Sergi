@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Comprar</th>
            <th>Borrar</th>
        </tr>
    </thead>
    <tbody>
        {{-- @dd($burgers) --}}
        @foreach ($burgers as $burger)
        <tr>
            <td>{{ $burger['id'] }}</td>
            <td>{{ $burger['name'] }}</td>
            <td>{{ $burger['price']  }}</td>
            <td>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $burger['id'] }}">
                    <input type="hidden" name="item_name" value="{{ $burger['name'] }}">
                    <input type="hidden" name="item_price" value="{{ $burger['price'] }}">
                    <button type="submit">Agregar al carrito</button>
                </form>
            </td>
            <td>
                <form action="{{ route('burgers.destroy', $burger['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas borrar esta burgir?')">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('cart.show') }}">Ver carrito</a>

<br>
<br>
<h2>EDITAR PRODUCTOS</h2>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        {{-- @dd($burgers) --}}
        @foreach ($burgers as $burger)
        <tr>
            <td>{{ $burger['id'] }}</td>
            <form action="{{ route('burgers.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="item_id" value="{{ $burger['id'] }}">
                <td><input name="item_name" value="{{ $burger['name'] }}"></td>
                <td><input name="item_price" value="{{ $burger['price'] }}"></td>
                <td><button type="submit">Editar</button></td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
<h2>Crear PRODUCTOS</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Crear</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <form action="{{ route('burgers.create') }}" method="POST">
                @csrf
                <td><input name="item_name" value=""></td>
                <td><input name="item_price" value=""></td>
                <td><button type="submit">Crear</button></td>
            </form>
        </tr>
    </tbody>
</table>
