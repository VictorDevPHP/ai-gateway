<?php

namespace App\Services;

use App\Ai\Agents\ExtractorProductInformation;
use Illuminate\Http\UploadedFile;
use Laravel\Ai\Files\Image;

class ExtractorProductInformationService
{
    public function extract(string $prompt, UploadedFile $image): string
    {
        $agent = new ExtractorProductInformation();

        return $agent->prompt($prompt, [
            Image::fromUpload($image),
        ]);
    }
}
