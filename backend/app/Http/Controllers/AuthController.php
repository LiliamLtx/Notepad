<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
   public function login(Request $request)
   {
      $credentials = $request->validate(
         [
            'text_username' => ['required', 'email'],
            'text_password' => ['required', 'min:6', 'max:16']
         ],
         [
            'text_username.required' => 'O username é obrigatorio',
            'text_username.email' => 'Digite um email valido',
            'text_password.required' => 'Digite a senha',
            'text_password.min' => 'A senha deve ter pelo menos 6 caracteres',
            'text_password.max' => 'A senha deve ter maximo 16 caracteres'
         ]
      );

      if (!Auth::attempt([
         'username' => $credentials['text_username'],
         'password' => $credentials['text_password'],
      ])) {
         return response()->json([
            'message' => 'Credenciais inválidas'
         ], 401);
      }
      $user = Auth::user();

      $user->last_login = date('Y-m-d H:i:s');
      $user->save();


      $token = $user->createToken('auth_token')->plainTextToken;

      return response()->json([
        'message' => 'Login realizado com sucesso',
        'token' => $token,
        'user' => $user
    ]);
   }


public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logout realizado com sucesso'
    ],200);
}


   public function cadastro(Request $request)
   {
      $credentials = $request->validate(
         [
            'text_name' => ['required', 'min:3', 'max:150'],
            'text_username' => ['required', 'email', 'unique:users,username'],
            'text_password' => ['required', 'min:6', 'max:16']
         ],
         [
            'text_username.required' => 'O username é obrigatorio',
            'text_username.unique' => 'Este email já está cadastrado',
            'text_username.email' => 'Digite um email valido',
            'text_password.required' => 'Digite a senha',
            'text_password.min' => 'Senha pelo menos 6',
            'text_password.max' => 'Senha maximo 16'
         ]
      );

      $user = User::create([
         'name' => $credentials['text_name'],
         'username' => $credentials['text_username'],
         'password' => Hash::make($credentials['text_password']),
      ]);


      return response()->json([
         'message' => 'Cadastro realizado com sucesso',
         'user' => $user
      ], 201);
   }
}

// criar função RULES para validar