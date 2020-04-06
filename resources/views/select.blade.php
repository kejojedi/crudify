<div class="list-group-item py-3">
    <div class="row">
        <label for="{{ $id }}" class="col-form-label col-md-2">{{ $label }}</label>
        <div class="col-md">
            <select name="{{ $name }}"
                    id="{{ $id }}"
                    class="custom-select @error($name) is-invalid @enderror"
                    {{ $disabled ? 'disabled' : '' }}>
                @if($empty)
                    <option value=""></option>
                @endif
                @foreach($options as $option_label => $option_value)
                    <option value="{{ $option_value }}" {{ $option_value == $value ? 'selected' : '' }}>{{ $option_label }}</option>
                @endforeach
            </select>
            @error($name) <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
            @if($hint) <small class="form-text text-secondary">{{ $hint }}</small> @endif
        </div>
    </div>
</div>
