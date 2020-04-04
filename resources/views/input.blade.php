<li class="list-group-item py-3">
    <div class="row">
        <label for="{{ $id }}" class="col-form-label col-md-2">{{ $label }}</label>
        <div class="col-md">
            <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="form-control @error($name) is-invalid @enderror" value="{{ $value }}">
            @error($name) <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
        </div>
    </div>
</li>
