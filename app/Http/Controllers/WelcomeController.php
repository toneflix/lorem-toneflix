<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $slides = [
            [
                'label' => 'Avatars',
                'url' => url('images/avatar?w=300&h=300'),
                'code' => '/images/avatar?w=300&h=300',
            ],
            [
                'label' => 'Album Covers',
                'url' => url('images/album?w=300&h=300'),
                'code' => '/images/album?w=300&h=300',
            ],
            [
                'label' => 'Events',
                'url' => url('images/event?w=300&h=300'),
                'code' => '/images/event?w=300&h=300',
            ],
            [
                'label' => 'Posters',
                'url' => url('images/poster?w=220&h=300'),
                'code' => '/images/poster?w=220&h=300',
            ],
            [
                'label' => 'Anything Random',
                'url' => url('images?w=300&h=300'),
                'code' => '/images?w=300&h=300',
            ],
            [
                'label' => 'Specific Image',
                'url' => url('images/image/00020?text=true'),
                'code' => '/images/image/00020 [You can easily get image id by passing text=true as a parameter]',
            ],
            [
                'label' => 'Greyscale',
                'url' => url('images?w=300&h=300&greyscale=true&random=4' . ['&pixelate=10', ''][rand(0, 1)]),
                'code' => '/images?w=300&h=300&greyscale=true',
            ],
            [
                'label' => 'Pixelate',
                'url' => url('images?w=300&h=300&pixelate=10'),
                'code' => '/images?w=300&h=300&pixelate=5',
            ],
        ];

        return view('welcome', compact('slides'));
    }
}