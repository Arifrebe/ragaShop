<div class="form-group">
    <label for="name" class="form-label">Nama</label>
    <input type="text" name="name" id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $category->name ?? '') }}" required>

    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>