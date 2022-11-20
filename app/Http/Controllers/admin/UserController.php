<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Region;
use App\Models\Reponse;
use App\Models\AideAdmin;
use App\Models\Evenements;
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
        $users = User::orderby('created_at', 'desc')->paginate(5);

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
        $regions = Region::select('name', 'id')->orderby('id')->get();

        return view(
            'admin.user.userForm',
            [
                'regions' => $regions
            ]
        );
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            // 'role' => ['required', 'string'],
        ]);

        $register = $validate;
        $pass = Str::random(8);
        $register['pass'] = $pass;
        $register['name'] = $request->name;
        $register['email'] = $request->email;
        $register['region'] = $request->region;
        $register['city'] = $request->ville;
        $register['password'] = Hash::make($pass);
        $register['role'] = $request->role;
        // dd($request->role);

        // dd($register);
        $newUser = User::create($register);

        if ($newUser) {
            Mail::to($newUser->email)->send(new UserCreateNotification($register));
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
        $regions = Region::select('name', 'id')->orderby('id')->get();
        $user = User::find($id);
        return  view('admin.user.userEdited', [
            'user' => $user,
            'regions' => $regions,

        ]);
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => ['required', 'string'],


        ]);


        $register = $validate;
        $register['name'] = $request->name;
        $register['email'] = $request->email;
        $register['role'] = $request->role;


        $user->update($register);
        // dd($user);
        // dd($user);
        if ($user) {
            return redirect('admin/users')->with('compteUpdate', 'le compte a été bien mis à jour!');
        } else {
            return back()->with("errorRegister", "registration failed");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        // dd($user);
        $aideAdmins = AideAdmin::all()->where('author_id', $user->id);
        foreach ($aideAdmins as $aideAdmin) {
            // dd($aideAdmin);
            $reponses = Reponse::all()->where('aideAdmin_id', $aideAdmin->id);
            foreach ($reponses as $reponse) {

                $reponse->delete();
            }
            $aideAdmin->delete();
        }
        // $user = User::all();
        $evenements = Evenements::all()->where('author_id', $user->id);
        foreach ($evenements as $evenement) {

            $evenement->delete();
        }
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
