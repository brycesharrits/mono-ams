@extends('admin.layout', ['title' => 'New member'])

@section('content')
    <div class="toolbar">
        <h1>New member</h1>
        <a href="{{ route('admin.members.index') }}" class="btn secondary sm">← Back</a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.members.store') }}">
            @include('admin.members._form', [
                'submitLabel' => 'Create member',
                'cancelUrl' => route('admin.members.index'),
            ])
        </form>
    </div>
@endsection
