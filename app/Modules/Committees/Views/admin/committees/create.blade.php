@extends('admin.layout', ['title' => 'New committee'])

@section('content')
    <div class="toolbar">
        <h1>New committee</h1>
        <a href="{{ route('admin.committees.index') }}" class="btn secondary sm">← Back</a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.committees.store') }}">
            @include('committees::admin.committees._form', [
                'submitLabel' => 'Create committee',
                'cancelUrl' => route('admin.committees.index'),
            ])
        </form>
    </div>
@endsection
