<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate(['nome' => 'required|max:255']);
        Category::create($request->all());
        return back()->with('success', 'Categoria criada com sucesso!');
    }

    public function update(Request $request, Category $category) {
        $request->validate(['nome' => 'required|max:255']);
        $category->update($request->all());
        return back()->with('success', 'Categoria atualizada!');
    }

    public function destroy(Category $category) {
        $category->delete();
        return back()->with('success', 'Categoria excluída!');
    }
}