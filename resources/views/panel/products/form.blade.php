@push('style')
    <style>
        #previewContainer {
            width: 275px;
            height: 350px;
            border: 1px solid #ccc;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px auto;
            border-radius: 8px;
            background-color: #f2f2f2;
        }

        #previewImage {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
            border-radius: 8px;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            color: white;
            border: 1px solid #ccc;
            border-radius: 6px;
            cursor: pointer;
            background-color: #042c99;
            transition: background-color 0.3s ease;
        }

        .custom-file-upload:hover {
            background-color: #ffffff;
            color: #042c99;
        }
    </style>
@endpush

<div class="row">
    <!-- KIRI: Upload Gambar -->
    <div class="col-md-5 text-center">
        <div id="previewContainer">
            <img id="previewImage" src="{{ isset($product->image) ? asset('storage/' . $product->image) : '#' }}"
                alt="Preview" style="{{ isset($product->image) ? 'display:block;' : 'display:none;' }}">
        </div>

        <label for="uploadInput" class="custom-file-upload">
            <i class="fas fa-cloud-upload-alt"></i> Pilih Foto
        </label>
        <input type="file" name="image" id="uploadInput" class="d-none" accept="image/*">

        @error('image')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- KANAN: FORM INPUT -->
    <div class="col-md-7">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $product->name ?? '') }}" placeholder="Nama produk" required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Harga (Rp.)</label>
            <input type="text" name="price" id="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', isset($product) ? number_format($product->price, 0, ',', '.') : '') }}"
                placeholder="Rp.0" required>

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="weight">Berat (gram)</label>
            <input type="number" name="weight" id="weight"
                class="form-control @error('weight') is-invalid @enderror"
                value="{{ old('weight', $product->weight ?? '') }}" placeholder="Contoh: 1000" min="0" required>

            @error('weight')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">Tersedia</label>
            <input type="number" name="stock" id="stock"
                class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock', $product->stock ?? '') }}" placeholder="Contoh: 1000" min="0" required>

            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                required>

                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>

            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<!-- DESKRIPSI (FULL WIDTH) -->
<div class="row mt-3">
    <div class="col-12">
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="5"
                class="form-control @error('description') is-invalid @enderror" placeholder="Masukkan deskripsi...">{{ old('description', $product->description ?? '') }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

@push('script')
    <script>
        document.getElementById('uploadInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('previewImage');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewImage.style.display = 'none';
                alert("Hanya file gambar yang diperbolehkan!");
            }
        });

        const priceInput = document.getElementById('price');

        priceInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');

            if (value) {
                e.target.value = 'Rp.' + new Intl.NumberFormat('id-ID').format(value);
            } else {
                e.target.value = '';
            }
        });

        $('#category_id').select2({
            theme: 'bootstrap4',
            placeholder: "Pilih kategori",
            allowClear: true
        });
    </script>
@endpush
