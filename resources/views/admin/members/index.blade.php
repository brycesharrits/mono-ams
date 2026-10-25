@extends('admin.layout', ['title' => 'Members'])

@section('content')
    <div class="toolbar">
        <h1>Members</h1>
        <form method="GET" action="{{ route('admin.members.index') }}">
            <input type="search" name="q" value="{{ $filters['q'] }}" placeholder="Search name, email, number…">
            <select name="status">
                <option value="">All statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected($filters['status'] === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn secondary sm">Filter</button>
            <a href="{{ route('admin.members.create') }}" class="btn">+ New member</a>
        </form>
    </div>

    @if ($members->isEmpty())
        <div class="empty">
            No members match. <a href="{{ route('admin.members.create') }}">Add one</a>.
        </div>
    @else
        <table class="list">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th>Expires</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td>{{ $member->member_number ?? '—' }}</td>
                        <td><a href="{{ route('admin.members.show', $member) }}">{{ $member->last_name }}, {{ $member->first_name }}</a></td>
                        <td>{{ $member->email }}</td>
                        <td><span class="pill {{ $member->status }}">{{ ucfirst($member->status) }}</span></td>
                        <td>{{ $member->joined_at?->format('Y-m-d') ?? '—' }}</td>
                        <td>{{ $member->expires_at?->format('Y-m-d') ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">{{ $members->links() }}</div>
    @endif
@endsection
