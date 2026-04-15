<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassifyNameRequest;
use App\Services\NameClassificationService;
use Illuminate\Http\JsonResponse;
use Throwable;

class NameClassificationController extends Controller
{
    public function classifyName(ClassifyNameRequest $request, NameClassificationService $nameClassificationService): JsonResponse
    {
        try {
            $data = $request->validated();
            return response()->json($nameClassificationService->classify($data['name'], $data['email'] ?? null));
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Não foi possível classificar o nome.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 503);
        }
    }

    public function identifyName(ClassifyNameRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Nome identificado.',
        ]);
    }
}
