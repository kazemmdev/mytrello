<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColumnRequest;
use App\Http\Requests\UpdateColumnRequest;
use App\Http\Resources\ColumnResource;
use App\Models\Column;
use Illuminate\Http\JsonResponse;

class ColumnController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(ColumnResource::collection(Column::oldest('created_at')->get()));
    }

    public function store(StoreColumnRequest $request): JsonResponse
    {
        return response()->json([Column::create($request->validated())]);
    }

    public function update(UpdateColumnRequest $request, Column $column): JsonResponse
    {
        return response()->json([$column->update($request->validated())]);
    }

    public function destroy(Column $column): JsonResponse
    {
        return response()->json([$column->delete()]);
    }
}
