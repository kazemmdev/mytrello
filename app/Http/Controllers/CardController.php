<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Http\Resources\CardResourse;
use App\Models\AccessToken;
use App\Models\Card;
use Illuminate\Http\JsonResponse;

class CardController extends Controller
{
    public function index(): JsonResponse
    {
        if (request('access_token') && AccessToken::where('token', request('access_token'))->first()) {

            $cards = (int)request('status') === 0 ? Card::onlyTrashed() : Card::query();

            if (request('date')) {
                $cards->where('created_at', '>', new \DateTime(request('date')));
            }

            return response()->json(CardResourse::collection($cards->get()));
        }

        return response()->json();
    }

    public function store(StoreCardRequest $request): JsonResponse
    {
        return response()->json([Card::create($request->validated())]);
    }

    public function update(UpdateCardRequest $request, Card $card): JsonResponse
    {
        if ($request->priority) {
            Card::where('column_id', $card->column_id)->where('priority', '>', $card->priority)->decrement('priority');
            Card::where('column_id', $request->column_id)->where('priority', '>=', $request->priority)->increment('priority');
        }

        return response()->json([$card->update($request->validated())]);
    }

    public function destroy(Card $card): JsonResponse
    {
        return response()->json([$card->delete()]);
    }
}
