@extends('admin.layout', ['title' => $committee->name])

@section('content')
    <div class="toolbar">
        <h1>{{ $committee->name }}</h1>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.committees.index') }}" class="btn secondary sm">← Back</a>
            <a href="{{ route('admin.committees.edit', $committee) }}" class="btn sm">Edit</a>
            <form method="POST" action="{{ route('admin.committees.destroy', $committee) }}" onsubmit="return confirm('Delete this committee?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn danger sm">Delete</button>
            </form>
        </div>
    </div>

    @if (session('status'))
        <div class="flash">{{ session('status') }}</div>
    @endif

    <div class="card">
        <dl class="detail">
            <dt>Name</dt><dd>{{ $committee->name }}</dd>
            <dt>Description</dt><dd>{{ $committee->description ?? '—' }}</dd>
            <dt>Members</dt><dd>{{ $committee->members->count() }}</dd>
            <dt>Created</dt><dd>{{ $committee->created_at->format('Y-m-d H:i') }}</dd>
            <dt>Updated</dt><dd>{{ $committee->updated_at->format('Y-m-d H:i') }}</dd>
        </dl>
    </div>

    <h2 style="margin-top:28px;font-size:17px;">Roster</h2>

    @if ($committee->members->isEmpty())
        <div class="empty">No members assigned yet.</div>
    @else
        <table class="list">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th style="width:1%;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($committee->members as $member)
                    <tr>
                        <td><a href="{{ route('admin.members.show', $member) }}">{{ $member->last_name }}, {{ $member->first_name }}</a></td>
                        <td>{{ $member->email }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.committees.members.update', [$committee, $member]) }}" style="display:flex;gap:6px;align-items:center;">
                                @csrf
                                @method('PATCH')
                                <select name="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" @selected($member->pivot->role === $role)>{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn secondary sm">Update</button>
                            </form>
                        </td>
                        <td>{{ $member->pivot->joined_at ? \Illuminate\Support\Carbon::parse($member->pivot->joined_at)->format('Y-m-d') : '—' }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.committees.members.destroy', [$committee, $member]) }}" onsubmit="return confirm('Remove this member from the committee?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn danger sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2 style="margin-top:28px;font-size:17px;">Add member</h2>

    @if ($available->isEmpty())
        <div class="empty">All members are already on this committee.</div>
    @else
        <div class="card">
            <form method="POST" action="{{ route('admin.committees.members.store', $committee) }}">
                @csrf
                <div class="form-grid">
                    <div>
                        <label for="member_id">Member</label>
                        <select id="member_id" name="member_id" required>
                            <option value="">— Choose a member —</option>
                            @foreach ($available as $member)
                                <option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>
                                    {{ $member->last_name }}, {{ $member->first_name }} ({{ $member->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" @selected(old('role', 'member') === $role)>{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                        @error('role')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="joined_at">Joined</label>
                        <input id="joined_at" type="date" name="joined_at" value="{{ old('joined_at') }}">
                        @error('joined_at')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn">Add to committee</button>
                </div>
            </form>
        </div>
    @endif
@endsection
