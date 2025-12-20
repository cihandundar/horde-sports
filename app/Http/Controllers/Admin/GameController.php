<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_team' => ['required', 'string', 'max:255'],
            'away_team' => ['required', 'string', 'max:255'],
            'match_date' => ['required', 'date'],
            'match_time' => ['nullable', 'date_format:H:i'],
            'home_score' => ['nullable', 'integer', 'min:0'],
            'away_score' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:upcoming,live,finished'],
        ]);

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
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'home_team' => ['required', 'string', 'max:255'],
            'away_team' => ['required', 'string', 'max:255'],
            'match_date' => ['required', 'date'],
            'match_time' => ['nullable', 'date_format:H:i'],
            'home_score' => ['nullable', 'integer', 'min:0'],
            'away_score' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:upcoming,live,finished'],
        ]);

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
