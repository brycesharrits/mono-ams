@extends('admin.layout', ['title' => 'Dashboard'])

@section('content')
    <div class="card">
        <h1>Welcome, {{ auth('admin')->user()->name }}</h1>
        <p>You are signed in to the Mono AMS admin console.</p>
        <a href="{{ route('admin.members.index') }}" class="stat" style="text-decoration:none;">{{ $memberCount }} {{ Str::plural('member', $memberCount) }}</a>
    </div>
@endsection
