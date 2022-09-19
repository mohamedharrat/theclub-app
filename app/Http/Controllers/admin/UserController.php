<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UserCreateNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return view('admin.user.userList', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.userForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'role' => ['required', 'string'],
        ]);

        $register = $validate;
        $pass = Str::random(8);
        $register['pass'] = $pass;
        $register['name'] = $request->name;
        $register['email'] = $request->email;
        $register['password'] = Hash::make($pass);
        if ($request['admin']) {
            $user['role'] = 'admin';
        }

        // dd($register);
        $newUser = User::create($register);

        if ($newUser) {
            return redirect('admin/users')->with('inscription', 'Votre compte a été bien crée');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return  view('admin.user.userEdited', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 

        $user = User::find($id);
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'role' => ['required', 'string'],


        ]);


        $register = $validate;
        $register['name'] = $request->name;
        $register['email'] = $request->email;
        if ($request['admin']) {
            $register['role'] = 'admin';
        }
        $user->update($register);
        // dd($user);
        // dd($user);
        if ($user) {
            return redirect('admin/users')->with('compteUpdate', 'Votre compte a été bien mis à jour!');
        } else {
            return back()->with("errorRegister", "registration failed")->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //

        // $user = User::all();
        $user->delete();
        return back()->with('delete', "L'utilisateur n° $user->id a été supprimé avec succès!");
    }

    public function search()
    {
        $search = request()->input('search-user');
        $results = User::where('name', 'like', "%$search%")->orwhere('email', 'like', "%$search%")->orwhere('role', 'like', "%$search%")->paginate(5);
        return view('admin.user.searchUser', ['results' => $results]);
    }
}
