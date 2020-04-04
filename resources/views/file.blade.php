<li class="list-group-item py-3">
    <div class="row">
        <label class="col-form-label col-md-2">{{ $label }}</label>
        <div class="col-md">
            <div class="custom-file">
                <input type="file" name="{{ $name }}" id="{{ $id }}" class="custom-file-input @error($name) is-invalid @enderror" {{ $multiple ? 'multiple' : '' }}>
                <label for="{{ $id }}" class="custom-file-label">{{ $file_label }}</label>
                @error($name) <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
</li>
