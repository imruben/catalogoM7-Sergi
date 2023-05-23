<x-app-layout>
    <h2>login</h2>
    <form action="/api/login" method="GET">
        <p>email:</p>
        <input type="text" name="email">
        <p>password:</p>
        <input type="password" name="password">
        <button type="submit">Login</button>
    </form>
    <h2>register</h2>
    <form action="/api/register" method="post">
        <p>name:</p>
        <input type="text" name="name">
        <p>email:</p>
        <input type="text" name="email">
        <p>password:</p>
        <input type="password" name="password">
        <button type="submit">Register</button>
        {{-- <a href="{{route('dashboard')}}">Register</a> --}}
    </form>
    <div id="register-message"></div>
</x-app-layout>
