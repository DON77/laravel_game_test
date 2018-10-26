<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class HomeController extends Controller
{
    public function index() {
        $games = Game::get();
        return view('welcome', ['games' => $games]);
    }

    public function save(Request $request) {
        $input = $request->all();
        $game = Game::where('id', $input['id'])->first();
        if(is_null($game)) {
            return redirect()->back()->withErrors(['error', 'Error']);
        }
        $game->game = $input['game'];
        $game->save();
        return redirect()->back()->with('game', $game);
    }
}
