<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OpenAIImageService;
use Illuminate\Support\Facades\Log;


class OpenAIImageController extends Controller
{
    protected $imageService;

    public function __construct(OpenAIImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function generateImage(Request $request)
    {
        try {
            // Get the input prompt
            $prompt = $request->input('prompt');

            // Call the service to generate the image
            $imageUrl = app(OpenAIImageService::class)->generateImage($prompt);
            // dd($imageUrl);

            return response()->json(['image_url' => $imageUrl], 200);
        } catch (\Exception $e) {
            // Log the error message and return a response
            \Log::error('Image generation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to generate images'], 500);
        }
    }
}
