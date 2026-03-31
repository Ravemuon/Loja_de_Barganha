<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Interest; // Você vai precisar do Model Interest também
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();

        $query = Interest::with(['item', 'user']);

        // LOGICA DE PRIVACIDADE:
        // Se não for admin, mostra apenas os interesses do próprio usuário
        if (!$user->is_admin) { // Assumindo que você tem um campo 'is_admin' no model User
            $query->where('user_id', $user->id);
        }

        $interests = $query->when($search, function ($q, $search) {
                return $q->whereHas('item', function($itemQuery) use ($search) {
                    $itemQuery->where('titulo', 'like', "%{$search}%")
                            ->orWhere('artista_diretor', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15);

        return view('interests.index', compact('interests', 'search'));
    }

    public function destroy(Interest $interest)
    {
        // Segurança: só deleta se for o dono ou admin
        if (auth()->id() !== $interest->user_id && !auth()->user()->is_admin) {
            return redirect()->back()->with('error', 'Ação não permitida.');
        }

        $interest->delete();
        return redirect()->back()->with('status', 'Pedido de interesse cancelado com sucesso.');
    }

    public function store(Request $request, Item $item)
    {
        // Verifica se já existe um interesse pendente para este item vindo deste IP/Usuário (evita duplicidade)
        $exists = $item->interests()
            ->where('status', 'pendente')
            ->where(function($q) use ($request) {
                $q->where('user_id', auth()->id())
                ->orWhere('ip_address', $request->ip());
            })->exists();

        if (!$exists) {
            $item->interests()->create([
                'user_id' => auth()->id(),
                'status' => 'pendente',
                'ip_address' => $request->ip(),
            ]);
        }

        return redirect()->back()->with('status', 'Seu interesse foi registrado na nossa central!');
    }
}