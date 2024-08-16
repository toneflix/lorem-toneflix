<?php

namespace App\Http\Controllers;

use App\Services\Generator;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        try {
            return (new Generator)->all()->build()->render($request->input('format'));
        } catch (DirectoryNotFoundException | \InvalidArgumentException $e) {
            abort(404);
        }
    }

    public function category(Request $request, string $category)
    {
        try {
            return (new Generator)->build('files/images/' . $category)->render($request->input('format'));
        } catch (DirectoryNotFoundException | \InvalidArgumentException $e) {
            abort(404);
        }
    }

    public function show(string $image)
    {
        try {
            return (new Generator)->all()->get($image);
        } catch (DirectoryNotFoundException | \InvalidArgumentException $e) {
            abort(404);
        }
    }
}
