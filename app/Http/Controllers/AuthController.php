<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

use function Laravel\Prompts\error;

class AuthController extends Controller
{
   public function login(){
    return view('login');
   }
   public function loginSubmit(Request $request){
      // form validation
      $request->validate(
         [
            'text_username' => ['required','email'],
            'text_password' => ['required', 'min:6', 'max:16']
         ],
         [
            'text_username.required'=> 'O username é obrigatoriooo bb',
            'text_username.email' => 'Digite um email valido',
            'text_password.required' => 'digite a senha bb',
            'text_password.min' => 'Senha pelo menos 6',
            'text_password.max' => 'Senha maximo 16'
         ]
      );

      // get user input
      $username = $request->input('text_username');
      $password = $request->input('text_password');

      try {
         DB::connection()->getPdo();
         echo "Connection is OK";
      } catch (\Throwable $e) {
          echo "Connection faild: " . $e->getMessage();
      }
}
   public function logout(){
    echo 'logout';
   }
}

// criar função RULES para validar