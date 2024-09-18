<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFathanRequest;
use App\Http\Requests\StoreFathanRequest;
use App\Http\Requests\UpdateFathanRequest;
use App\Models\Fathan;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FathanController extends Controller
{
    // use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('fathan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fathan = Fathan::all();

        return view('admin.fathans.index', compact('fathan'));
    }

    public function create()
    {
        abort_if(Gate::denies('fathan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fathans.create');
    }

    public function store(StoreFathanRequest $request)
    {
        $fathan = Fathan::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $fathan->id]);
        }

        return redirect()->route('admin.fathans.index');
    }

    public function edit(Fathan $fathan)
    {
        abort_if(Gate::denies('fathan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fathans.edit', compact('fathan'));
    }

    public function update(UpdateFathanRequest $request, Fathan $fathan)
    {
        $fathan->update($request->all());

        return redirect()->route('admin.fathans.index');
    }

    public function show(Fathan $fathan)
    {
        abort_if(Gate::denies('fathan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fathans.show', compact('fathan'));
    }

    public function destroy(Fathan $fathan)
    {
        abort_if(Gate::denies('fathan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fathan->delete();

        return back();
    }

    public function massDestroy(MassDestroyFathanRequest $request)
    {
        $abouts = Fathan::find(request('ids'));

        foreach ($abouts as $fathan) {
            $fathan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('fathan_create') && Gate::denies('fathan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Fathan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}