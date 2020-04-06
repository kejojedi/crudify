<div class="list-group-item py-3">
    <div class="row">
        <label for="{{ $id }}" class="col-form-label col-md-2">{{ $label }}</label>
        <div class="col-md">
            <input type="{{ $type }}"
                   name="{{ $name }}"
                   id="{{ $id }}"
                   class="form-control @error($name) is-invalid @enderror"
                   value="{{ $value }}"
                   {{ $disabled ? 'disabled' : '' }}
                   {{ $readonly ? 'readonly' : '' }}>
            @error($name) <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
            @if($hint) <small class="form-text text-secondary">{{ $hint }}</small> @endif
        </div>
    </div>
</div>
