@extends('admin.layout', ['title' => $member->first_name.' '.$member->last_name])

@section('content')
    <div class="toolbar">
        <h1>{{ $member->first_name }} {{ $member->last_name }}</h1>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.members.index') }}" class="btn secondary sm">← Back</a>
            <a href="{{ route('admin.members.edit', $member) }}" class="btn sm">Edit</a>
            <form method="POST" action="{{ route('admin.members.destroy', $member) }}" onsubmit="return confirm('Delete this member?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn danger sm">Delete</button>
            </form>
        </div>
    </div>

    <div class="card">
        <dl class="detail">
            <dt>Member number</dt><dd>{{ $member->member_number ?? '—' }}</dd>
            <dt>Email</dt><dd>{{ $member->email }}</dd>
            <dt>Phone</dt><dd>{{ $member->phone ?? '—' }}</dd>
            <dt>Status</dt><dd><span class="pill {{ $member->status }}">{{ ucfirst($member->status) }}</span></dd>
            <dt>Joined</dt><dd>{{ $member->joined_at?->format('F j, Y') ?? '—' }}</dd>
            <dt>Expires</dt><dd>{{ $member->expires_at?->format('F j, Y') ?? '—' }}</dd>
            <dt>Created</dt><dd>{{ $member->created_at->format('Y-m-d H:i') }}</dd>
            <dt>Updated</dt><dd>{{ $member->updated_at->format('Y-m-d H:i') }}</dd>
        </dl>
    </div>
@endsection
