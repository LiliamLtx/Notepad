<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            'text_username.required'=> 'O username é obrigatorio',
            'text_username.email' => 'Digite um email valido',
            'text_password.required' => 'Digite a senha',
            'text_password.min' => 'Senha pelo menos 6',
            'text_password.max' => 'Senha maximo 16'
         ]
      );

      // get user input
      $username = $request->input('text_username');
      $password = $request->input('text_password');

      //check user com model
      $user = User::where('username', $username)
         ->where('deleted_at', NULL)
         ->first();
      //check username
      if (!$user) {
         return redirect()
            ->back()
            ->withInput()
            ->with('login_error', 'Usuario ou senha incorretos');
      }
      //check password
      if(!password_verify($password, $user->password)){
         return redirect()
            ->back()
            ->withInput()
            ->with('login_error', 'Usuario ou senha incorretos');
      } 
      $user->last_login = date('Y-m-d H:i:s');
      $user->save();

      //login user
      session([
         'user' =>[
            'id' => $user->id,
            'username' => $user->username
         ]
      ]);

      //redirect to home
      return redirect()->to('/');


   /* // testar conexão com o banco de dados
    try {
         DB::connection()->getPdo();
         echo "Connection is OK";
      } catch (\Throwable $e) {
          echo "Connection faild: " . $e->getMessage();
      }*/

}
   public function logout(){
    session()->forget('user');
    return redirect()->to('/login');
   }

   public function cadastro(){
      return view('cadastro');
   }

   public function cadastroSubmit(Request $request){
         $request->validate(
         [
            'text_username' => ['required','email', 'unique:users,username'],
            'text_password' => ['required', 'min:6', 'max:16']
         ],
         [
            'text_username.unique' => 'Este usuário já está cadastrado',
            'text_username.required'=> 'O username é obrigatorio',
            'text_username.email' => 'Digite um email valido',
            'text_password.required' => 'Digite a senha',
            'text_password.min' => 'Senha pelo menos 6',
            'text_password.max' => 'Senha maximo 16'
         ]
      );

      // Check user exists
      $username = $request->input('text_username');
      $userExists = User::where('username', $username)->exists();

      if ($userExists) {
         return redirect()
            ->back()
            ->withInput()
            ->with('cadastro_error', 'Este e-mail já está cadastrado no sistema.');
      }

      //creating new user
      $user = new User();
      $user->username = $request->input('text_username');

      $user->password = Hash::make($request->input('text_password'));

      $user->save();

      //redirect to home
      return redirect()->to('/login')->with('success', 'Conta criada com sucesso!');


   }
}

// criar função RULES para validar