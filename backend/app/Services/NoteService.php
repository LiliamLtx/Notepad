<?php

namespace App\Services;

use App\Models\Note;
use App\Models\User;

class NoteService
{
    public function criarNota(User $user, string $title, string $text): Note
    {
        $tituloFinal = $this->gerarTituloUnico($user, $title);

        return $user->notes()->create([
            'title' => $tituloFinal,
            'text' => $text,
        ]);
    }

    private function gerarTituloUnico(User $user, string $title): string
    {
        $titulos = $user->notes()
            ->where('title', 'like', $title . '%')
            ->pluck('title');

        if ($titulos->isEmpty()) {
            return $title;
        }

        $maior = 0;

        foreach ($titulos as $t) {
            if ($t === $title) {
                $maior = max($maior, 0);
            }

            if (preg_match('/\((\d+)\)$/', $t, $matches)) {
                $maior = max($maior, (int) $matches[1]);
            }
        }

        return $title . ' (' . ($maior + 1) . ')';
    }
}
