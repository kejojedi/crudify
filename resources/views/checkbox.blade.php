<div class="list-group-item py-3">
    <div class="row">
        @if($label)
            <label class="col-form-label col-md-2 py-md-0">{{ $label }}</label>
        @endif
        <div class="col-md {{ !$label ? 'offset-md-2' : '' }}">
            <div class="custom-control custom-checkbox">
                <input type="hidden" name="{{ $name }}" value="0">
                <input type="checkbox"
                       name="{{ $name }}"
                       id="{{ $id }}"
                       class="custom-control-input @error($name) is-invalid @enderror"
                       value="1"
                       {{ $value ? 'checked' : '' }}
                       {{ $disabled ? 'disabled' : '' }}>
                <label for="{{ $id }}" class="custom-control-label">{{ $checkbox_label }}</label>
            </div>

            @error($name) <span class="invalid-feedback font-weight-bold d-block">{{ $message }}</span> @enderror
            @if($hint) <small class="form-text text-secondary">{{ $hint }}</small> @endif
        </div>
    </div>
</div>
