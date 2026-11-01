@extends('admin.layout', ['title' => 'Committees'])

@section('content')
    <div class="toolbar">
        <h1>Committees</h1>
        <form method="GET" action="{{ route('admin.committees.index') }}">
            <input type="search" name="q" value="{{ $filters['q'] }}" placeholder="Search by name…">
            <button type="submit" class="btn secondary sm">Filter</button>
            <a href="{{ route('admin.committees.create') }}" class="btn">+ New committee</a>
        </form>
    </div>

    @if (session('status'))
        <div class="flash">{{ session('status') }}</div>
    @endif

    @if ($committees->isEmpty())
        <div class="empty">
            No committees yet. <a href="{{ route('admin.committees.create') }}">Create one</a>.
        </div>
    @else
        <table class="list">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Members</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($committees as $committee)
                    <tr>
                        <td><a href="{{ route('admin.committees.show', $committee) }}">{{ $committee->name }}</a></td>
                        <td>{{ \Illuminate\Support\Str::limit($committee->description, 80) ?: '—' }}</td>
                        <td>{{ $committee->members_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">{{ $committees->links() }}</div>
    @endif
@endsection
