<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(): JsonResponse
    {
        $messages = Message::with('user:id,name')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($messages);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|min:10',
        ]);

        $userId = auth()->user()->id;

        $model = new Message();
        $model->forceFill([
            'user_id' => $userId,
            'message' => $request->get('message'),
        ])->save();

        $model = Message::with('user:id,name')->findOrFail($model->id);

        return response()->json($model);
    }
}
