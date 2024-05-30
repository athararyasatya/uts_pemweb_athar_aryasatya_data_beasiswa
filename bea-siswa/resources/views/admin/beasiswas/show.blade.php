@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.beasiswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.id') }}
                        </th>
                        <td>
                            {{ $beasiswa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.image') }}
                        </th>
                        <td>
                            @if($beasiswa->image)
                                <a href="{{ $beasiswa->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $beasiswa->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.nama') }}
                        </th>
                        <td>
                            {{ $beasiswa->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.gmail') }}
                        </th>
                        <td>
                            {{ $beasiswa->gmail }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.nomor_telpon') }}
                        </th>
                        <td>
                            {{ $beasiswa->nomer_telpon }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.umur') }}
                        </th>
                        <td>
                            {{ $beasiswa->umur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.nama_orangtua') }}
                        </th>
                        <td>
                            {{ $beasiswa->nama_orangtua }}
                        </td>
                    </tr>
                 
                    
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\Beasiswa::CATEGORY_SELECT[$beasiswa->category] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.beasiswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection