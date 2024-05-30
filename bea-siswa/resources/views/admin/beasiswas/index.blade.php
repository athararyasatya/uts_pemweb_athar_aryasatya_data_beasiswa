@extends('layouts.admin')
@section('content')
@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.beasiswas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.beasiswa.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.beasiswa.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Product">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.gmail') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.nomor_telpon') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.umur') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.nama_orangtua') }}
                        </th>
                       
                        <th>
                            {{ trans('cruds.beasiswa.fields.category') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beasiswa as $key => $b)
                        <tr data-entry-id="{{ $b->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $b->id ?? '' }}
                            </td>
                            <td>
                                @if($b->image)
                                    <a href="{{ $b->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $b->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $b->nama ?? '' }}
                            </td>
                            <td>
                                {{ $b->gmail ?? '' }}
                            </td>
                            <td>
                                {{ $b->nomer_telpon ?? '' }}
                            </td>
                            <td>
                                {{ $b->umur ?? '' }}
                            </td>
                            <td>
                                {{ $b->nama_orangtua ?? '' }}
                            </td>
                          
                            <td>
                                {{ App\Models\Beasiswa::CATEGORY_SELECT[$b->category] ?? '' }}
                            </td>
                            <td>
                                @can('beasiswa_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.beasiswas.show', $b->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('beasiswa_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.beasiswas.edit', $b->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('beasiswa_delete')
                                    <form action="{{ route('admin.beasiswas.destroy', $b->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('beasiswa_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.beasiswas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Product:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection