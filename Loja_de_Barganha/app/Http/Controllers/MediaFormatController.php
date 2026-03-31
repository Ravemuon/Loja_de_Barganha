<?php

namespace App\Http\Controllers;

use App\Models\MediaFormat;
use Illuminate\Http\Request;

class MediaFormatController extends Controller
{
    // Listagem com Busca
    public function index(Request $request)
    {
        $search = $request->input('search');

        $formats = MediaFormat::when($search, function ($query, $search) {
            return $query->where('nome', 'like', "%{$search}%");
        })->get();

        return view('formats.index', compact('formats', 'search'));
    }

    public function create()
    {
        return view('formats.create');
    }

    // CREATE com Validação
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:media_formats|min:2',
        ], [
            'nome.required' => 'O nome do formato (ex: Vinil) é obrigatório.',
            'nome.unique' => 'Este formato já está cadastrado.'
        ]);

        MediaFormat::create($request->all());

        return redirect()->route('formats.index')->with('success', 'Formato de mídia adicionado!');
    }

    public function edit(MediaFormat $format)
    {
        return view('formats.edit', compact('format'));
    }

    // UPDATE
    public function update(Request $request, MediaFormat $format)
    {
        $request->validate([
            'nome' => 'required|min:2',
        ]);

        $format->update($request->all());

        return redirect()->route('formats.index')->with('success', 'Formato atualizado!');
    }

    // DELETE
    public function destroy(MediaFormat $format)
    {
        // Opcional: verificar se existem itens usando este formato antes de deletar
        $format->delete();
        return redirect()->route('formats.index')->with('success', 'Formato removido!');
    }
}