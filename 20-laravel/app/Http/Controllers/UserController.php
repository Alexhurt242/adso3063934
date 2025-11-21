<?php

namespace App\Http\Controllers;

use App\Models\User; // Importamos el modelo
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios de la base de datos
        $users = User::orderBy('id', 'desc')->paginate(20);
        // dd($users->toArray());
        return view('users.index')->with('users', $users);

        // Enviar los usuarios a la vista 'users.index'
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {

        return view('users.edit')->with('user', $user);
    }

    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'document' => ['required', 'numeric', 'unique:users,document'],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'photo' => ['required', 'image'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
        ]);

        // Procesar foto
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $photo);
        }

        // Crear y guardar usuario
        $user = new User();
        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('users')->with('message', 'The user: ' . $user->fullname . ' was successfully added!');
    }

    public function update(Request $request, User $user)
    {
        $validation = $request->validate([
            'document' => ['required', 'numeric', 'unique:' . User::class . ',document,' . $user->id],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone' => ['required'],
            'email' => ['required', 'lowercase', 'email', 'unique:' . User::class . ',email,' . $user->id],
        ]);
        if ($request->hasFile('photo')) {
            // dd($request->all());
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
                if ($request->originphoto != 'no-photo.png') {
                    unlink(public_path('images/') . $request->originphoto);
                }
            }
            else{
                $photo = $request->originphoto;
            }
        }

        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;


        if ($user->save()) {
            return redirect('users')->with('message', 'The user:  ' . $user->fullname . '  was successfully edited!');
        }
    }

    // Remove the specified rosource from storage.

    public function destroy(User $user)
    {
        if(
            $user->photo != 'no-photo.png') {
                unlink(public_path('images/' . $user->photo));
            }
        
        if($user->delete()) {
            return redirect('users')->with('message',
            'The user:  ' . $user->fullname . '  was successfully deleted!');
        }
    }
}