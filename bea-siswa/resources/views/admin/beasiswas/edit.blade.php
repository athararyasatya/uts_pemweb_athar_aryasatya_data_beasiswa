@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.beasiswa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.beasiswas.update", [$beasiswa->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="image">{{ trans('cruds.beasiswa.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama">{{ trans('cruds.beasiswa.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $beasiswa->nama) }}">
                @if($errors->has('nama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gmail">{{ trans('cruds.beasiswa.fields.gmail') }}</label>
                <input class="form-control {{ $errors->has('gmail') ? 'is-invalid' : '' }}" type="text" name="gmail" id="gmail" value="{{ old('gmail', $beasiswa->gmail) }}">
                @if($errors->has('gmail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gmail') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nomor_telpon">{{ trans('cruds.beasiswa.fields.nomor_telpon') }}</label>
                <input class="form-control {{ $errors->has('nomor_telpon') ? 'is-invalid' : '' }}" type="text" name="nomor_telpon" id="nomor_telpon" value="{{ old('nomor_telpon', $beasiswa->nomor_telpon) }}">
                @if($errors->has('nomor_telpon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nomor_telpon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="umur">{{ trans('cruds.beasiswa.fields.umur') }}</label>
                <input class="form-control {{ $errors->has('umur') ? 'is-invalid' : '' }}" type="text" name="umur" id="umur" value="{{ old('umur', $beasiswa->umur) }}">
                @if($errors->has('umur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('umur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_orangtua">{{ trans('cruds.beasiswa.fields.nama_orangtua') }}</label>
                <input class="form-control {{ $errors->has('nama_orangtua') ? 'is-invalid' : '' }}" type="text" name="nama_orangtua" id="nama_orangtua" value="{{ old('nama_orangtua', $beasiswa->nama_orangtua) }}">
                @if($errors->has('nama_orangtua'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_orangtua') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.name_helper') }}</span>
            </div>
         
           
            <div class="form-group">
                <label>{{ trans('cruds.beasiswa.fields.category') }}</label>
                <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category">
                    <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Beasiswa::CATEGORY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('category', $beasiswa->category) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.beasiswas.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($beasiswa) && $beasiswa->image)
      var file = {!! json_encode($beasiswa->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection