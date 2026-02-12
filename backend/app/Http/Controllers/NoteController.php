<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Services\NoteService;

class NoteController extends Controller
{
    /**
     * Index traz as notas do usuario.
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
     * Store cria uma nova nota do usuario.
     */
    public function store(Request $request, NoteService $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ], 
        [
            'title.required' => 'Titulo é obrigatorio',
            'text.required' => 'Texto da nota é obrigatorio'
        ]
        );

        //service para criar notas com titulo unico
        $note = $service->criarNota(
            $request->user(),
            $request->title,
            $request->text
        );


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
     * Atualiza uma nota especifica
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
     * SoftDelete em uma nota especifica
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
