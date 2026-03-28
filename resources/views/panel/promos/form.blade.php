<div class="row">
    <div class="form-group col-md-6">
        <label for="code">Kode</label>
        <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $promo->code ?? '') }}" placeholder="Kode promo" required>

        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="min_purchase">Minimal pembelian (Rp.)</label>
        <input type="text" name="min_purchase" id="min_purchase"
            class="form-control @error('min_purchase') is-invalid @enderror"
            value="{{ old('min_purchase', isset($promo) ? number_format($promo->min_purchase, 0, ',', '.') : '') }}"
            placeholder="Rp.0" required>

        @error('min_purchase')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="type">Tipe</label>
        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
            <option value="">-- Pilih tipe --</option>
            <option value="percentage" {{ old('type', $promo->type ?? '') == 'percentage' ? 'selected' : '' }}>
                Persentase
            </option>
            <option value="fixed" {{ old('type', $promo->type ?? '') == 'fixed' ? 'selected' : '' }}>
                Nilai tetap
            </option>
        </select>

        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="value">Jumlah (Rp / %)</label>
        <input type="text" name="value" id="value" class="form-control @error('value') is-invalid @enderror"
            value="{{ old('value', isset($promo) ? number_format($promo->value, 0, ',', '.') : '') }}"
            placeholder="Rp.0 / 0%" required>

        @error('value')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Start Date -->
    <div class="form-group col-md-6">
        <label for="start_date">Tanggal Mulai</label>
        <input type="date" name="start_date" id="start_date"
            class="form-control @error('start_date') is-invalid @enderror"
            value="{{ old('start_date', isset($promo) ? $promo->start_date->format('Y-m-d') : '') }}" required>
        @error('start_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- End Date -->
    <div class="form-group col-md-6">
        <label for="end_date">Tanggal Berakhir</label>
        <input type="date" name="end_date" id="end_date"
            class="form-control @error('end_date') is-invalid @enderror"
            value="{{ old('end_date', isset($promo) ? $promo->end_date->format('Y-m-d') : '') }}" required>
        @error('end_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Is Active -->
    <div class="form-group col-md-6">
        <label for="is_active">Status Aktif</label>
        <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror" required>
            <option value="">-- Pilih status --</option>
            <option value="1" {{ old('is_active', $promo->is_active ?? '') == 1 ? 'selected' : '' }} selected>Aktif
            </option>
            <option value="0" {{ old('is_active', $promo->is_active ?? '') == 0 ? 'selected' : '' }}>Tidak Aktif
            </option>
        </select>
        @error('is_active')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('script')
    <script>
        const minPurchase = document.getElementById('min_purchase');

        minPurchase.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');

            if (value) {
                e.target.value = 'Rp.' + new Intl.NumberFormat('id-ID').format(value);
            } else {
                e.target.value = '';
            }
        });
    </script>
@endpush
