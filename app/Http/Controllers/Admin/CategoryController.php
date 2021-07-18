<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStore;
use App\Http\Requests\CategoryUpdate;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getCategories();
        return view('admin.categories.index', [
            'categoriesList'=>$categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStore $request
     * @return RedirectResponse
     */
    public function store(CategoryStore $request): RedirectResponse
    {
        $statusCategory = Category::create(
            $request->validated()
        );

        if ($statusCategory) {
            return redirect()->route('admin.categories.index')->with('success', 'Запись успешно создана.');
        }
        return redirect()->route('admin.categories.index')->with('error', 'Не удалось создать запись.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdate $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryUpdate $request, Category $category): RedirectResponse
    {
        $statusCategory = $category->fill(
            $request->validated()
        )->save();

        if ($statusCategory) {
            return redirect()->route('admin.categories.index')->with('success', 'Запись успешно изменена.');
        }
        return redirect()->route('admin.categories.index')->with('error', 'Не удалось изменить запись.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        if ($request->ajax())
        {
            try {
                $category->delete();
            } catch (\Exception $e) {
                report($e);
            }
        }
    }
}
