@csrf
<div class="form-grid">
    <div>
        <label for="member_number">Member number</label>
        <input id="member_number" type="text" name="member_number" value="{{ old('member_number', $member->member_number) }}">
        @error('member_number')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
        <label for="status">Status</label>
        <select id="status" name="status">
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected(old('status', $member->status) === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        @error('status')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
        <label for="first_name">First name</label>
        <input id="first_name" type="text" name="first_name" value="{{ old('first_name', $member->first_name) }}" required>
        @error('first_name')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
        <label for="last_name">Last name</label>
        <input id="last_name" type="text" name="last_name" value="{{ old('last_name', $member->last_name) }}" required>
        @error('last_name')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $member->email) }}" required>
        @error('email')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
        <label for="phone">Phone</label>
        <input id="phone" type="text" name="phone" value="{{ old('phone', $member->phone) }}">
        @error('phone')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
        <label for="joined_at">Joined</label>
        <input id="joined_at" type="date" name="joined_at" value="{{ old('joined_at', $member->joined_at?->format('Y-m-d')) }}">
        @error('joined_at')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
        <label for="expires_at">Expires</label>
        <input id="expires_at" type="date" name="expires_at" value="{{ old('expires_at', $member->expires_at?->format('Y-m-d')) }}">
        @error('expires_at')<div class="error">{{ $message }}</div>@enderror
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn">{{ $submitLabel }}</button>
    <a href="{{ $cancelUrl }}" class="btn secondary">Cancel</a>
</div>
