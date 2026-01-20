<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use App\Http\Controllers\Controller;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        //load user's notes
        $id = session('user.id');
        $user = User::find($id)->toArray();
        $notes = User::find($id)
        ->notes()
        ->whereNull('deleted_at')
        ->get()
        ->toArray();


        //show home view
        return view('home',['notes'=>$notes]);
    }
    public function newNote(){
        return view('new_note');
    }

    public function newNoteSubmit(Request $request){
        $request->validate(
            [
            'text_title' => ['required', 'min:3', 'max:200'],
            'text_note' => ['required', 'min:3', 'max:3000']
            ],
            [
                'text_title.required' => 'O titulo é obrigatorio',
                'text_note.required' => 'O texto da nota é obrigatorio',
                'text_title.min' => 'O titulo deve ter pelo menos :min caracteres',
                'text_title.max' => 'O titulo deve ter no máximo :max caracteres',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres'
            ]
        );

        //get 
        $id = session('user.id');
        

        // create a new Note
        $note = new Note();
        $note-> user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');
    }
    
    public function editNote($id){
        $id = Operations::decryptId($id);
        
        //load note
        $note = Note::find($id);

        //show edit
        return view('edit_note', ['note' => $note]);

    }

    public function editNoteSubmit(Request $request){
         
    $request->validate(
            [
            'text_title' => ['required', 'min:3', 'max:200'],
            'text_note' => ['required', 'min:3', 'max:3000']
            ],
            [
                'text_title.required' => 'O titulo é obrigatorio',
                'text_note.required' => 'O texto da nota é obrigatorio',
                'text_title.min' => 'O titulo deve ter pelo menos :min caracteres',
                'text_title.max' => 'O titulo deve ter no máximo :max caracteres',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres'
            ]
        );
        //check if note exists
        if($request->note_id == null){
            return redirect()->route('home');
        }

        //decryptId
        $id = Operations::decryptId($request->note_id);
        $note = Note::find($id);

        //Update
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');

    }

    public function deleteNote($id){
        $id = Operations::decryptId($id);

        //load note
        $note = Note::find($id);

        return view('delete_note', ['note' => $note]);

    }

    public function deleteNoteConfirm($id){
        $id = Operations::decryptId($id);
        $note = Note::find($id);

        //soft delete
        $note->deleted_at = date('F j, Y, g:i a');
        $note->save();

        return redirect()->route('home');
    }

}