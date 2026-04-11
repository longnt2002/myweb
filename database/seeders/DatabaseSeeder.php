<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Game::create([
            'name' => 'Flappy Bird',
            'description' => 'Trò chơi Flappy Bird kinh điển - Nhấn phím để cố gắng vượt qua các đường ống',
            'image' => 'game1.jpg',
            'link' => '/games/flappybird'
        ]);

        Game::create([
            'name' => 'Pac-Man',
            'description' => 'Trò chơi Pac-Man - Ăn tất cả các dấu chấm để chiến thắng',
            'image' => 'game2.jpg',
            'link' => '#'
        ]);

        Game::create([
            'name' => 'Space Invaders',
            'description' => 'Bắn những người ngoài hành tinh xâm lược',
            'image' => 'game3.jpg',
            'link' => '#'
        ]);

        Game::create([
            'name' => 'Tetris',
            'description' => 'Xếp các khối hình để làm đầy hàng',
            'image' => 'game4.jpg',
            'link' => '#'
        ]);

        Game::create([
            'name' => 'Snake',
            'description' => 'Điều khiển rắn ăn thức ăn nhưng tránh va vào thân rắn',
            'image' => 'game5.jpg',
            'link' => '#'
        ]);

        Game::create([
            'name' => '2048',
            'description' => 'Kết hợp các ô vuông để tạo thành số 2048',
            'image' => 'game6.jpg',
            'link' => '#'
        ]);
    }
}
