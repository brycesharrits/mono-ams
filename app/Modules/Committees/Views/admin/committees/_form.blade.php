@csrf
<div class="form-grid">
    <div class="full">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $committee->name) }}" required>
        @error('name')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="full">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" style="width:100%;padding:8px 11px;border:1px solid #d1d5db;border-radius:6px;font:inherit;">{{ old('description', $committee->description) }}</textarea>
        @error('description')<div class="error">{{ $message }}</div>@enderror
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn">{{ $submitLabel }}</button>
    <a href="{{ $cancelUrl }}" class="btn secondary">Cancel</a>
</div>
