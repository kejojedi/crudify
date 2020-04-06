<div class="list-group-item py-3">
    <div class="row">
        <label for="{{ $id }}" class="col-form-label col-md-2">{{ $label }}</label>
        <div class="col-md">
            <textarea name="{{ $name }}"
                      id="{{ $id }}"
                      class="form-control @error($name) is-invalid @enderror"
                      rows="{{ $rows }}"
                      {{ $disabled ? 'disabled' : '' }}
                      {{ $readonly ? 'readonly' : '' }}>{{ $value }}</textarea>
            @error($name) <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
            @if($hint) <small class="form-text text-secondary">{{ $hint }}</small> @endif
        </div>
    </div>
</div>
