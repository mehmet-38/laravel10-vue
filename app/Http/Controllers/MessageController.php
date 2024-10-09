<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::with('user:id,name')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mesaj doğrulaması
        $request->validate([
            'message' => 'required|string|min:10',
        ]);

        // Giriş yapmış kullanıcının kimliği
        $userId = $request->user()->id;

        // Yeni mesajı kaydediyoruz
        $message = new Message();
        $message->forceFill([
            'user_id' => $userId, // User ID
            'message' => $request->get('message'),
        ])->save();

        // Yeni kaydedilen mesajı kullanıcı adıyla birlikte döndürüyoruz
        $message = Message::with('user:id,name')->find($message->id);

        return response()->json($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
