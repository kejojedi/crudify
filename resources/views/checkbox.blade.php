<li class="list-group-item py-3">
    <div class="row">
        <div class="col-md-2">{{ $label }}</div>
        <div class="col-md">
            <div class="custom-control custom-checkbox">
                <input type="hidden" name="{{ $name }}" value="0">
                <input type="checkbox" name="{{ $name }}" id="{{ $id }}" class="custom-control-input @error($name) is-invalid @enderror" value="1" {{ $value ? 'checked' : '' }}>
                <label for="{{ $id }}" class="custom-control-label">{{ $checkbox_label }}</label>
            </div>

            @error($name) <span class="invalid-feedback font-weight-bold d-block">{{ $message }}</span> @enderror
        </div>
    </div>
</li>
