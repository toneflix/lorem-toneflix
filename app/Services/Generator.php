<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\Typography\FontFactory;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;
use Symfony\Component\Finder\SplFileInfo;

class Generator
{
    /**
     * A single file to return
     *
     * @var SplFileInfo
     */
    protected SplFileInfo $file;

    /**
     * List of files to return
     *
     * @var array<int,SplFileInfo>
     */
    protected array $files;

    public function all()
    {
        $files = File::allFiles(public_path('files/images'));
        $this->files = $files;
        return $this;
    }

    public function build(string $dir = null)
    {
        $request = request();

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
            $file = (new self())->build($dir)->file;

            if ($get_link === true) {
                return asset($dir . '/' . $file->getFileName());
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

    public function render(?string $format = null)
    {
        $request = request();
        try {
            $file = $this->file;

            if (!$request->hasAny(['h', 'w', 'greyscale', 'pixelate', 'invert', 'blur', 'sharpen', 'filters', 'text'])) {
                return response()->file($file->getPathname(), [
                    'Cross-Origin-Resource-Policy' => 'cross-origin',
                    'Access-Control-Allow-Origin' => '*'
                ]);
            } else {
                // Prepare the image
                $image = (new Media())->buildResponse($file->getPathname());

                // Apply a gaussian blur effect on the current image
                if ($request->has('blur')) {
                    $image->blur(is_numeric($request->blur) ? $request->blur : 5);
                }

                // Turn image into a greyscale version
                if ($request->boolean('greyscale')) {
                    $image->greyscale();
                }

                // Invert all colors of the image
                if ($request->boolean('invert')) {
                    $image->invert();
                }

                // Sharpen the image
                if ($request->has('sharpen')) {
                    $image->sharpen(is_numeric($request->sharpen) ? $request->sharpen : 10);
                }

                // Resize the image
                if ($request->has('w') || $request->has('h')) {
                    $width = (int)$request->get('w');
                    $height = (int)$request->get('h');
                    $image->resize([$width ?: $height, $height ?: $width]);
                }

                // Pixelate the image
                if ($request->has('pixelate')) {
                    $image->pixelate(is_numeric($request->pixelate) ? $request->pixelate : 10);
                }

                // Load all filters from the filters query param
                if ($request->has('filters')) {
                    $filters = str($request->filters)->remove(' ')->explode(',')->filter(function ($f) {
                        return in_array(str($f)->before(':')->toString(), [
                            'blur',
                            'invert',
                            'sharpen',
                            'pixelate',
                            'greyscale',
                        ]);
                    });

                    foreach ($filters->lazy() as $filter) {
                        $param = str($filter)->afterLast(':')->toInteger();
                        $image = $image->{str($filter)->before(':')->toString()}($param);
                    }
                }

                if ($request->has('text')) {
                    $image->text(
                        $request->boolean('text') ? str($file->getFilename())->before('.') : $request->text,
                        30,
                        30,
                        function (FontFactory $font) {
                            $font->file(public_path('SecularOne.ttf'));
                            $font->size(70);
                            $font->color('#fff');
                            $font->valign('center');
                        }
                    );
                }

                return $image->respond();
            }
        } catch (DirectoryNotFoundException | \InvalidArgumentException $e) {
            abort(404);
        }
    }

    public function get(string $image)
    {
        $files = collect($this->files);
        $file = $files->first(function ($file) use ($image) {
            $fn = str($file->getFileName());

            if ($fn->contains($image) || $fn->before('.')->contains($image)) {
                return true;
            }
        });
        $this->file = $file;
        return $this->render();
    }
}
