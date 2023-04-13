<?php

namespace App\Http\Controllers;

use App\Services\Generator;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        try {
            return (new Generator)->all()->build()->render();
        } catch (DirectoryNotFoundException | \InvalidArgumentException $e) {
            abort(404);
        }
    }

    public function category($category)
    {
        try {
            return (new Generator)->build('files/images/'.$category)->render();
        } catch (DirectoryNotFoundException | \InvalidArgumentException $e) {
            abort(404);
        }
    }

    public function show($image)
    {
        try {
            return (new Generator)->all()->get($image);
        } catch (DirectoryNotFoundException | \InvalidArgumentException $e) {
            abort(404);
        }
    }
}
