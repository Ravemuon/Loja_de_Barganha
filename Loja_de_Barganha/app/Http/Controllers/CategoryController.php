<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Exibe a listagem de coleções catalogadas.
     */
    public function index()
    {
        // Eager loading de itens se necessário, ou apenas a contagem
        $categories = Category::withCount('items')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Tela para registrar uma nova coleção underground.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Salva a nova categoria com seus metadados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'       => 'required|unique:categories|max:255',
            'icone'      => 'required|max:50', // Ex: bi-vinyl-fill
            'tipo_midia' => 'required|in:Música,Jogo,Filme,Outro',
        ], [
            'nome.unique' => 'Essa coleção já existe no nosso estoque!',
            'tipo_midia.in' => 'Selecione um tipo de mídia válido.'
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Nova coleção adicionada ao arsenal!');
    }

    /**
     * Exibe os artefatos de uma categoria específica.
     */
    public function show(Category $category)
    {
        // Carrega os itens relacionados para a vitrine interna da categoria
        $category->load('items');
        return view('categories.show', compact('category'));
    }

    /**
     * Tela de edição das características da coleção.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Atualiza o nome, ícone ou mídia no banco.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nome'       => 'required|max:255|unique:categories,nome,' . $category->id,
            'icone'      => 'required|max:50',
            'tipo_midia' => 'required|in:Música,Jogo,Filme,Outro',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Registros da coleção atualizados com sucesso!');
    }

    /**
     * Remove a categoria (Cuidado: certifique-se de tratar os itens órfãos se necessário).
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Coleção removida permanentemente do sistema!');
    }
}