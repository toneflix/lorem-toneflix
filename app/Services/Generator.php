<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class Generator
{
    protected $file;

    protected $files;

    public function all()
    {
        $files = File::allFiles(public_path('files/images'));
        $this->files = $files;
        return $this;
    }

    public function build(string $dir = null)
    {
        if (empty($this->files)) {
            $dir = trim($dir ?? 'files/images', '/');
            $files = File::files(public_path($dir));
        } else {
            $files = $this->files;
        }

        $collection = collect($files)->filter(function ($file) {
            if ($file->getExtension() === 'png' || $file->getExtension() === 'jpg' || $file->getExtension() === 'jpeg') {
                return true;
            }
        });

        $this->file = $collection->random();
        return $this;
    }

    public static function generate($dir = null, $get_link = true)
    {
        try {
            $file = (new self)->build($dir)->file;

            if ($get_link === true) {
                return asset($dir.'/'.$file->getFileName());
            }

            return $file;
        } catch (DirectoryNotFoundException | \InvalidArgumentException $e) {
            if ($get_link === true) {
                return 'Not Found';
            }
            abort(404, $e->getMessage());
        }
    }

    public static function generateLink($dir = null)
    {
        return self::generate($dir);
    }

    public static function generateFile($dir = null)
    {
        return self::generate($dir, false);
    }

    public function render()
    {
        $request = request();
        try {
            $file = $this->file;

            if (!$request->hasAny(['h', 'w', 'greyscale', 'pixelate', 'cache', 'text'])) {
                return response()->file($file->getPathname());
            } else {
                if ($request->has('cache')) {
                    $image = \Image::cache(function($image) use ($file) {
                        $image->make($file->getPathname());
                    }, 10, true);
                } else {
                    $image = \Image::make($file->getPathname());
                }


                if ($request->has('w') || $request->has('h')) {
                    $width = $request->get('w');
                    $height = $request->get('h');
                    $image->resize($width, $height);
                }

                if ($request->has('greyscale')) {
                    $image->greyscale();
                }

                if ($request->has('pixelate')) {
                    $image->pixelate(is_numeric($request->pixelate) ? $request->pixelate : 10);
                }

                if ($request->has('text')) {
                    $image->text(
                        str($request->text)->contains(['1',1,true,'true'])?str($file->getFilename())->before('.'):$request->text,
                        30,
                        30,
                        function($font) {
                        $font->file(public_path('SecularOne.ttf'));
                        $font->size(50);
                        $font->color('#fff');
                        $font->align('middle');
                        $font->valign('center');
                    });
                }

                return $image->response();
            }

        } catch (DirectoryNotFoundException | \InvalidArgumentException $e) {
            abort(404);
        }
    }

    public function get($image)
    {
        $files = collect($this->files);
        $file = $files->first(function ($file) use ($image) {
            $fn = str($file->getFileName());

            if ($fn->contains($image) || $fn->before('.')->contains($image)) {
                return true;
            }
        });
        $this->file = $file;// dd($this->file->getPathname());
        return $this->render();
    }
}