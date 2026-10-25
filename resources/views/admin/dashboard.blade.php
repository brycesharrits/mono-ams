@extends('admin.layout', ['title' => 'Dashboard'])

@section('content')
    <div class="card">
        <h1>Welcome, {{ auth('admin')->user()->name }}</h1>
        <p>You are signed in to the Mono AMS admin console.</p>
        <div class="stat">{{ $memberCount }} {{ Str::plural('member', $memberCount) }}</div>
    </div>
@endsection
