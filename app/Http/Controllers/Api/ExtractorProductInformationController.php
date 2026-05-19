<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExtractProductInformationRequest;
use App\Services\ExtractorProductInformationService;
use Illuminate\Http\JsonResponse;
use Throwable;

class ExtractorProductInformationController extends Controller
{
    public function extract(
        ExtractProductInformationRequest $request,
        ExtractorProductInformationService $extractorProductInformationService
    ): JsonResponse {
        try {
            $data = $request->validated();

            $requestData = $request->all();
            $prompt = $requestData['data'];
            
            return response()->json(
                $extractorProductInformationService->extract($prompt, $request->file('image'))
            );
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Não foi possível extrair as informações do produto.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 503);
        }
    }
}
