<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\FontInterface;
use Intervention\Image\Interfaces\ImageInterface;

class Media
{
    protected string $imageMime = 'image/png';
    protected ImageInterface $imageInterface;

    public function __construct(
        public \Intervention\Image\ImageManager $imageDriver = new ImageManager(new Driver()),
        public ?\Illuminate\Contracts\Filesystem\Filesystem $disk = null,
    ) {}

    /**
     * Render the private file
     *
     * @return void
     */
    public function dynamicFile(string $file)
    {
        $src = Initiator::base64urlDecode($file);
        if ($this->disk->exists($src)) {
            // create response and add encoded file data
            return response()->file($this->disk->path($src), [
                'Cross-Origin-Resource-Policy' => 'cross-origin',
                'Access-Control-Allow-Origin' => '*',
            ]);
        }

        return abort(404, 'Asset Not Found');
    }

    /**
     * Save or retrieve an image from cache
     *
     * @return array{content:string,mime:string}|null
     */
    public function cached(string $search): ?array
    {
        $file = null;
        $content = null;

        $suffix = str(collect(request(null)->all())->join('_'))->slug('_', 'en', [
            '@' => '_',
            ':' => '_',
            ',' => '_'
        ])->toString();
        $cacheKey = "image:$search:$suffix";

        // Check if the file exists in cache
        if (Cache::has($cacheKey)) {
            $content = Cache::get($cacheKey);
        } else {
            // Loop through all the filesystems.links to find the file
            foreach (collect(config('filesystems.links'))->values() as $path) {
                $file = collect(File::allFiles($path))
                    ->firstWhere(function (string $path) use ($search) {
                        if (!str(File::mimeType($path))->contains('image')) {
                            return false;
                        }

                        $filePath = str($path)->afterLast('/files/');
                        $searchPath = str($search)->afterLast('/files/');

                        return $searchPath->is($filePath);
                    });

                if (!$file) {
                    continue;
                }
            }

            // Save the file to cache
            if ($file) {
                $content = ['content' => $file->getContents(), 'mime' => File::mimeType($file)];

                Cache::put(
                    ttl: config('settings.cache_expiry', 600),
                    key: $cacheKey,
                    value: $content,
                );
            }
        }

        return $content;
    }

    /**
     * Fetch the given image from the cache and resize it.
     */
    public function buildResponse(string $fileName, string|array $size = null): self
    {
        $cached = $this->cached($fileName);

        if (isset($cached['content'])) {
            // Save the image
            $this->imageInterface = $this->imageDriver->read($cached['content']);

            // Save the mimetype
            $this->imageMime = $cached['mime'];

            if ($size) {
                $this->resize($size);
            }

            return $this;
        }

        return abort(404);
    }

    /**
     * Resize the image
     *
     * @param string|array|null $size
     * @return Media
     */
    public function resize(string|array $size = null): self
    {
        if ($size) {
            // Get the image resolution
            if (is_array($size)) {
                $res = $size;
            } else {
                $res = explode(
                    'x',
                    config(
                        "settings.image_sizes.$size",
                        config('settings.image_sizes.xl', '694')
                    )
                );
            }

            $this->imageInterface = $this->imageInterface->cover(Arr::first($res), Arr::last($res));
        }

        return $this;
    }

    /**
     * Apply a gaussian blur effect on the current image
     *
     * @param integer $amount
     * @return Media
     */
    public function blur(int $amount = 0): self
    {
        $this->imageInterface = $this->imageInterface->blur($amount);

        return $this;
    }

    /**
     * Turn image into a greyscale version
     *
     * @param integer $size
     * @return Media
     */
    public function greyscale(): self
    {
        $this->imageInterface = $this->imageInterface->greyscale();

        return $this;
    }

    /**
     * Invert all colors of the image
     *
     * @return Media
     */
    public function invert(): self
    {
        $this->imageInterface = $this->imageInterface->invert();

        return $this;
    }

    /**
     * Pixelate the image
     *
     * @param integer $size
     * @return Media
     */
    public function pixelate(int $size = 0): self
    {
        $this->imageInterface = $this->imageInterface->pixelate($size);

        return $this;
    }

    /**
     * Sharpen the image
     *
     * @param integer $amount
     * @return Media
     */
    public function sharpen(int $amount = 0): self
    {
        $this->imageInterface = $this->imageInterface->sharpen($amount);

        return $this;
    }

    /**
     * Write text on the image
     *
     * @param string $text
     * @return Media
     */
    public function text(
        string $text,
        int $x,
        int $y,
        callable|Closure|FontInterface $font
    ): self {
        $this->imageInterface = $this->imageInterface->text($text, $x, $y, $font);

        return $this;
    }

    public function respond(): \Illuminate\Http\Response
    {
        $encoded =  $this->imageInterface->encode();

        // Make the Http Response
        $response = Response::make($encoded);

        // set the headers
        return $response->header('Content-Type', $this->imageMime)
            ->header('Cross-Origin-Resource-Policy', 'cross-origin')
            ->header('Access-Control-Allow-Origin', '*');
    }
}
