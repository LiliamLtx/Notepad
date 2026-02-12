<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Services\NoteService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testando_throw_exception_com_title_Null()
    {
        // Arrange
        $user = User::factory()->create();
        $service = new NoteService();

        // Assert
        $this->expectException(\InvalidArgumentException::class);

        // Act
        $service->criarNota($user, null, 'Texto válido');
    }

    public function  testando_throw_exception_com_text_Null()
    {
        // Arrange
        $user = User::factory()->create();
        $service = new NoteService();

        // Assert
        $this->expectException(\InvalidArgumentException::class);

        // Act
        $service->criarNota($user, 'Título válido', null);
    }
}
