<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\MediaFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // Listagem com Barra de Pesquisa e Filtros Expandidos
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        $tipoMidia = $request->input('tipo_midia');

        $items = Item::with(['categoria', 'formato_midia'])
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('titulo', 'like', "%{$search}%")
                      ->orWhere('artista_diretor', 'like', "%{$search}%")
                      ->orWhere('empresa_produtora', 'like', "%{$search}%")
                      ->orWhere('descricao', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($tipoMidia, function ($query, $tipoMidia) {
                return $query->where('tipo_midia', $tipoMidia);
            })
            ->latest()
            ->paginate(12); 

        $categories = Category::all();
        
        return view('items.index', compact('items', 'search', 'categories', 'categoryId', 'tipoMidia'));
    }

    public function create()
    {
        $categories = Category::all();
        $formats = MediaFormat::all();
        return view('items.create', compact('categories', 'formats'));
    }

    public function show(Item $item)
    {
        $item->load(['categoria', 'formato_midia']);
        return view('items.show', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:2',
            'preco' => 'required|numeric',
            'tipo_midia' => 'required',
            'category_id' => 'required|exists:categories,id',
            'media_format_id' => 'required|exists:media_formats,id',
            'capa' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            // Novos campos são opcionais no validate para flexibilidade
            'artista_diretor' => 'nullable',
            'empresa_produtora' => 'nullable',
            'elenco_detalhes' => 'nullable',
            'descricao' => 'nullable',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id() ?? 1; 

        if ($request->hasFile('capa')) {
            $data['capa'] = $request->file('capa')->store('capas', 'public');
        }

        Item::create($data);

        return redirect()->route('home')->with('success', 'Relíquia cadastrada com sucesso!');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        $formats = MediaFormat::all();
        return view('items.edit', compact('item', 'categories', 'formats'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'titulo' => 'required',
            'preco' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'media_format_id' => 'required|exists:media_formats,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('capa')) {
            // Deleta a capa antiga se existir uma nova
            if ($item->capa) {
                Storage::disk('public')->delete($item->capa);
            }
            $data['capa'] = $request->file('capa')->store('capas', 'public');
        }

        $item->update($data);

        return redirect()->route('items.show', $item->id)->with('success', 'Dados atualizados!');
    }

    public function destroy(Item $item)
    {
        if ($item->capa) {
            Storage::disk('public')->delete($item->capa);
        }
        $item->delete();

        return redirect()->route('home')->with('success', 'Item removido da vitrine!');
    }
}