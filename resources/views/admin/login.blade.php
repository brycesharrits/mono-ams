@extends('admin.layout', ['title' => 'Sign in'])

@section('content')
    <form class="auth" method="POST" action="{{ route('admin.login.store') }}">
        @csrf
        <h1>Admin sign in</h1>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')<div class="error">{{ $message }}</div>@enderror

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @error('password')<div class="error">{{ $message }}</div>@enderror

        <label class="remember">
            <input type="checkbox" name="remember" value="1"> Remember me
        </label>

        <button type="submit">Sign in</button>
    </form>
@endsection
