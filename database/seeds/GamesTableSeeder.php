<?php

use Illuminate\Database\Seeder;
use App\Game;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            (object)[
                "game_name" => "Warface",
                "win_rate" => 100,
                "credits" => 500
            ],
            (object)[
                "game_name" => "Crossfire",
                "win_rate" => 50,
                "credits" => 10
            ],
            (object)[
                "game_name" => "Dota",
                "win_rate" => 10,
                "credits" => 700
            ],
            (object)[
                "game_name" => "World of Tanks",
                "win_rate" => 200,
                "credits" => 550
            ],
            (object)[
                "game_name" => "Counter-Strike",
                "win_rate" => 50,
                "credits" => 1000
            ]
        ];
        foreach($data as $item) {
            $game = json_encode($item);
            if(!Game::where('game', $game)->exists()) {
                Game::create(['game' => $game]);
            }
        }
    }
}
