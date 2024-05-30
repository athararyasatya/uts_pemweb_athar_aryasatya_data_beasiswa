<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBeasiswaRequest;
use App\Http\Requests\StoreBeasiswaRequest;
use App\Http\Requests\UpdateBeasiswaRequest;
use App\Models\Beasiswa;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BeasiswaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('beasiswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $beasiswa = Beasiswa::with(['media'])->get();

        return view('admin.beasiswas.index', compact('beasiswa'));
    }

    public function create()
    {
        abort_if(Gate::denies('beasiswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.beasiswas.create');
    }

    public function store(StoreBeasiswaRequest $request)
    {
        $beasiswa = Beasiswa::create($request->all());

        if ($request->input('image', false)) {
            $beasiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $beasiswa->id]);
        }

        return redirect()->route('admin.beasiswas.index');
    }

    public function edit(Beasiswa $beasiswa)
    {
        abort_if(Gate::denies('beasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.beasiswas.edit', compact('beasiswa'));
    }

    public function update(UpdateBeasiswaRequest $request, Beasiswa $beasiswa)
    {
        $beasiswa->update($request->all());

        if ($request->input('image', false)) {
            if (! $beasiswa->image || $request->input('image') !== $beasiswa->image->file_name) {
                if ($beasiswa->image) {
                    $beasiswa->image->delete();
                }
                $beasiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($beasiswa->image) {
            $beasiswa->image->delete();
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Beasiswa $beasiswa)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.beasiswas.show', compact('beasiswa'));
    }

    public function destroy(Beasiswa $beasiswa)
    {
        abort_if(Gate::denies('beasiswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $beasiswa->delete();

        return back();
    }

    public function massDestroy(MassDestroyBeasiswaRequest $request)
    {
        $products = Beasiswa::find(request('ids'));

        foreach ($products as $beasiswa) {
            $beasiswa->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('beasiswa_create') && Gate::denies('beasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Beasiswa();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
