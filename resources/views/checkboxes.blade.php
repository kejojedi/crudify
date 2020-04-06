<div class="list-group-item py-3">
    <div class="row">
        <label class="col-form-label col-md-2 py-md-0">{{ $label }}</label>
        <div class="col-md">
            <input type="hidden" name="{{ $name }}" value="">

            @foreach($options as $option_label => $option_value)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox"
                           name="{{ $name }}[]"
                           id="{{ $id . '_' . $loop->index }}"
                           class="custom-control-input @error($name) is-invalid @enderror"
                           value="{{ $option_value }}"
                           {{ is_array($value) && in_array($option_value, $value) ? 'checked' : '' }}
                           {{ $disabled ? 'disabled' : '' }}>
                    <label for="{{ $id . '_' . $loop->index }}" class="custom-control-label">{{ $option_label }}</label>
                </div>
            @endforeach

            @error($name) <span class="invalid-feedback font-weight-bold d-block">{{ $message }}</span> @enderror
            @if($hint) <small class="form-text text-secondary">{{ $hint }}</small> @endif
        </div>
    </div>
</div>
