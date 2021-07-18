<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SourceStore;
use App\Http\Requests\SourceUpdate;
use Illuminate\Http\Request;
use App\Models\Source;
use \Illuminate\Http\RedirectResponse;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $sourceModel = new Source();
        $sources = $sourceModel->getSources();
        return view('admin.sources.index', [
            'sourcesList'=>$sources,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SourceStore $request
     * @return RedirectResponse
     */
    public function store(SourceStore $request): RedirectResponse
    {
        $statusSource = Source::create(
            $request->validated()
        );

        if ($statusSource) {
            return redirect()->route('admin.sources.index')->with('success', 'Запись успешно создана.');
        }
        return redirect()->route('admin.sources.index')->with('error', 'Не удалось создать запись.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Source $source
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        return view('admin.sources.edit', [
            'source' => $source
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SourceUpdate $request
     * @param Source $source
     * @return RedirectResponse
     */
    public function update(SourceUpdate $request, Source $source): RedirectResponse
    {
        $statusSource = $source->fill(
            $request->validated()
        )->save();

        if ($statusSource) {
            return redirect()->route('admin.sources.index')->with('success', 'Запись успешно изменена.');
        }
        return redirect()->route('admin.sources.index')->with('error', 'Не удалось изменить запись.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Source $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Source $source)
    {
        if ($request->ajax())
        {
            try {
                $source->delete();
            } catch (\Exception $e) {
                report($e);
            }
        }
    }
}
