<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGameRequest;
use App\Http\Requests\Admin\UpdateGameRequest;
use App\Models\Game;

class GameController extends Controller
{
    /**
     * Maç listesi
     */
    public function index()
    {
        $games = Game::orderBy('match_date', 'desc')
            ->orderBy('match_time', 'desc')
            ->paginate(10);
        
        return view('admin.games.index', compact('games'));
    }

    /**
     * Yeni maç ekleme formu
     */
    public function create()
    {
        return view('admin.games.create');
    }

    /**
     * Yeni maç kaydet
     */
    public function store(StoreGameRequest $request)
    {
        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();

        Game::create($validated);

        return redirect()->route('admin.games.index')
            ->with('success', 'Maç başarıyla eklendi.');
    }

    /**
     * Maç düzenleme formu
     */
    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Maç güncelle
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();

        $game->update($validated);

        return redirect()->route('admin.games.index')
            ->with('success', 'Maç başarıyla güncellendi.');
    }

    /**
     * Maç sil
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('admin.games.index')
            ->with('success', 'Maç başarıyla silindi.');
    }
}
