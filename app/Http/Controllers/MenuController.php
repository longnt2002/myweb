<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = [
            [
                'id' => 1,
                'name' => 'Trang Chủ',
                'url' => '/',
                'icon' => 'fa-home'
            ],
            [
                'id' => 2,
                'name' => 'Trò Chơi',
                'url' => '/games',
                'icon' => 'fa-gamepad'
            ],
            [
                'id' => 3,
                'name' => 'Dự Án',
                'url' => '/projects',
                'icon' => 'fa-project-diagram'
            ],
            [
                'id' => 4,
                'name' => 'Về Tôi',
                'url' => '/about',
                'icon' => 'fa-user'
            ],
        ];

        return view('menu', ['menuItems' => $menuItems]);
    }

    public function games()
    {
        $menuItems = [
            [
                'id' => 1,
                'name' => 'Trang Chủ',
                'url' => '/',
                'icon' => 'fa-home'
            ],
            [
                'id' => 2,
                'name' => 'Trò Chơi',
                'url' => '/games',
                'icon' => 'fa-gamepad'
            ],
            [
                'id' => 3,
                'name' => 'Dự Án',
                'url' => '/projects',
                'icon' => 'fa-project-diagram'
            ],
            [
                'id' => 4,
                'name' => 'Về Tôi',
                'url' => '/about',
                'icon' => 'fa-user'
            ],
        ];

        return view('games', ['menuItems' => $menuItems]);
    }

    public function projects()
    {
        $menuItems = [
            [
                'id' => 1,
                'name' => 'Trang Chủ',
                'url' => '/',
                'icon' => 'fa-home'
            ],
            [
                'id' => 2,
                'name' => 'Trò Chơi',
                'url' => '/games',
                'icon' => 'fa-gamepad'
            ],
            [
                'id' => 3,
                'name' => 'Dự Án',
                'url' => '/projects',
                'icon' => 'fa-project-diagram'
            ],
            [
                'id' => 4,
                'name' => 'Về Tôi',
                'url' => '/about',
                'icon' => 'fa-user'
            ],
        ];

        return view('projects', ['menuItems' => $menuItems]);
    }

    public function about()
    {
        $menuItems = [
            [
                'id' => 1,
                'name' => 'Trang Chủ',
                'url' => '/',
                'icon' => 'fa-home'
            ],
            [
                'id' => 2,
                'name' => 'Trò Chơi',
                'url' => '/games',
                'icon' => 'fa-gamepad'
            ],
            [
                'id' => 3,
                'name' => 'Dự Án',
                'url' => '/projects',
                'icon' => 'fa-project-diagram'
            ],
            [
                'id' => 4,
                'name' => 'Về Tôi',
                'url' => '/about',
                'icon' => 'fa-user'
            ],
        ];

        return view('about', ['menuItems' => $menuItems]);
    }

    public function flappybird()
    {
        $menuItems = [
            [
                'id' => 1,
                'name' => 'Trang Chủ',
                'url' => '/',
                'icon' => 'fa-home'
            ],
            [
                'id' => 2,
                'name' => 'Trò Chơi',
                'url' => '/games',
                'icon' => 'fa-gamepad'
            ],
            [
                'id' => 3,
                'name' => 'Dự Án',
                'url' => '/projects',
                'icon' => 'fa-project-diagram'
            ],
            [
                'id' => 4,
                'name' => 'Về Tôi',
                'url' => '/about',
                'icon' => 'fa-user'
            ],
        ];

        return view('flappybird', ['menuItems' => $menuItems]);
    }

    public function minesweeper()
    {
        $menuItems = [
            [
                'id' => 1,
                'name' => 'Trang Chủ',
                'url' => '/',
                'icon' => 'fa-home'
            ],
            [
                'id' => 2,
                'name' => 'Trò Chơi',
                'url' => '/games',
                'icon' => 'fa-gamepad'
            ],
            [
                'id' => 3,
                'name' => 'Dự Án',
                'url' => '/projects',
                'icon' => 'fa-project-diagram'
            ],
            [
                'id' => 4,
                'name' => 'Về Tôi',
                'url' => '/about',
                'icon' => 'fa-user'
            ],
        ];

        return view('minesweeper', ['menuItems' => $menuItems]);
    }

    public function paint()
    {
        $menuItems = [
            [
                'id' => 1,
                'name' => 'Trang Chủ',
                'url' => '/',
                'icon' => 'fa-home'
            ],
            [
                'id' => 2,
                'name' => 'Trò Chơi',
                'url' => '/games',
                'icon' => 'fa-gamepad'
            ],
            [
                'id' => 3,
                'name' => 'Dự Án',
                'url' => '/projects',
                'icon' => 'fa-project-diagram'
            ],
            [
                'id' => 4,
                'name' => 'Về Tôi',
                'url' => '/about',
                'icon' => 'fa-user'
            ],
        ];

        return view('paint', ['menuItems' => $menuItems]);
    }
}
