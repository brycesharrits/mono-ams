@extends('admin.layout', ['title' => 'Edit '.$committee->name])

@section('content')
    <div class="toolbar">
        <h1>Edit {{ $committee->name }}</h1>
        <a href="{{ route('admin.committees.show', $committee) }}" class="btn secondary sm">← Back</a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.committees.update', $committee) }}">
            @method('PUT')
            @include('committees::admin.committees._form', [
                'submitLabel' => 'Save changes',
                'cancelUrl' => route('admin.committees.show', $committee),
            ])
        </form>
    </div>
@endsection
