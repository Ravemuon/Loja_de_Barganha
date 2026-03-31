<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Exibe a página inicial da loja (Vitrine)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        $tipoMidia = $request->input('tipo_midia'); 

        $itemsQuery = Item::with(['categoria', 'formato_midia'])
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('titulo', 'like', "%{$search}%")
                    ->orWhere('artista_diretor', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($tipoMidia, function ($query, $tipoMidia) {
                return $query->where('tipo_midia', $tipoMidia);
            })
            ->latest();

       
        if ($search || $categoryId || $tipoMidia) {
            $items = $itemsQuery->paginate(12);
            $grouped = false;
        } else {
            $items = $itemsQuery->get()->groupBy('categoria.nome');
            $grouped = true;
        }

        $categories = Category::all();

        return view('welcome', compact('items', 'categories', 'search', 'grouped', 'categoryId', 'tipoMidia'));
    }
    public function show(Item $item)
    {
        // Carrega as relações para a página de detalhes também
        $item->load(['categoria', 'formato_midia']);
        return view('items.show', compact('item'));
    }
}