<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    public function upload(UploadedFile $file, string $folder): string
    {
        $filename = time() . '_' . uniqid() . '.webp';

        $image = Image::read($file)
            ->toWebp(80);

        Storage::disk('public')->put(
            $folder . '/' . $filename,
            (string) $image
        );

        return $filename;
    }

    public function update(?UploadedFile $file,?string $oldFile,string $folder): ?string
    {
        if (!$file) {
            return $oldFile;
        }

        if ($oldFile && Storage::disk('public')->exists($folder.'/'.$oldFile)) {
            Storage::disk('public')->delete($folder.'/'.$oldFile);
        }

        return $this->upload($file, $folder);
    }

    public function delete(?string $file, string $folder): void
    {
        if ($file && Storage::disk('public')->exists($folder.'/'.$file)) {
            Storage::disk('public')->delete($folder.'/'.$file);
        }
    }
}
