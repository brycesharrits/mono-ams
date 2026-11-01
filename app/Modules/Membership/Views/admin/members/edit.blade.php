@extends('admin.layout', ['title' => 'Edit '.$member->first_name.' '.$member->last_name])

@section('content')
    <div class="toolbar">
        <h1>Edit {{ $member->first_name }} {{ $member->last_name }}</h1>
        <a href="{{ route('admin.members.show', $member) }}" class="btn secondary sm">← Back</a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.members.update', $member) }}">
            @method('PUT')
            @include('membership::admin.members._form', [
                'submitLabel' => 'Save changes',
                'cancelUrl' => route('admin.members.show', $member),
            ])
        </form>
    </div>
@endsection
