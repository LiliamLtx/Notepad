<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Services\NoteService;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user(); // vem do Sanctum

        $notes = $user
            ->notes()
            ->whereNull('deleted_at')
            ->get()
            ->toArray();

        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, NoteService $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        //service para criar notas com titulo unico
        $note = $service->criarNota(
            $request->user(),
            $request->title,
            $request->text
        );

        if (empty($title) || empty($text)) {
            throw new \InvalidArgumentException(
                'Título e texto são obrigatórios'
            );
        }

        return response()->json($note, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return response()->json($note, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $note = Note::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $note->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);


        return response()->json($note, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $note = Note::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $note->delete();

        return response()->json(['message' => 'Nota excluída'], 200);
    }
}
