<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Exibe uma listagem das categorias.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Mostra o formulário para criar uma nova categoria.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Armazena uma nova categoria no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:categories|max:255'
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Exibe uma categoria específica (detalhes).
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Mostra o formulário para editar uma categoria existente.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Atualiza uma categoria específica no banco de dados.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nome' => 'required|max:255|unique:categories,nome,' . $category->id
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove uma categoria específica do banco de dados.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}