<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ville;
use App\Models\Region;
use App\Models\Categories;
use App\Models\Evenements;
use Illuminate\Http\Request;
use App\Models\EvenementsUser;
use App\Models\UserEvenement;
use Illuminate\Support\Facades\Auth;

class UserEvenementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // dd(date('Y/m/d'));
        $region_filtre = Auth::user()->region;
        // dd($region_filtre);
        $category = $request->category;
        $date = date('Y-m-d');
        // dd($foot, $tennis, $basket);
        $regions = Region::select('name', 'id')->orderby('id')->get();
        $userEvenements = Evenements::select()->where('region', Auth::user()->region)->where('date', $date)->orderby('heure', 'asc')->paginate(5);


        if ($request->date_filtre && $request->region_filtre) {
            $date = $request->date_filtre;
            // $regions = $request->region_filtre;

            if (isset($category)) {
                $userEvenements = Evenements::select()->where('date', $date)->where('category_id', $category)->where('region', $request->region_filtre)->orderby('heure', 'asc')->paginate(5);
            } else {
                $userEvenements = Evenements::select()->where('region', $request->region_filtre)->where('date', $date)->orderby('heure', 'asc')->paginate(5);
            }
            // if ($foot) {
            //     $userEvenements = Evenements::select()->where('date', $date)->where('category_id', $foot)->orderby('heure', 'asc')->get();
            // } elseif ($tennis) {
            //     $userEvenements = Evenements::select()->where('date', $date)->where('category_id', $tennis)->orderby('heure', 'asc')->get();
            // } elseif ($basket) {
            //     $userEvenements = Evenements::select()->where('date', $date)->where('category_id', $basket)->orderby('heure', 'asc')->get();
            // } else {
            //     $userEvenements = Evenements::select()->where('date', $date)->orderby('heure', 'asc')->get();
            // }
        }

        // dd($userEvenements);
        else {
            $userEvenements = Evenements::select()->where('region', Auth::user()->region)->where('date', date('Y-m-d'))->orderby('heure', 'asc')->paginate(5);
        }


        // dd($userEvenements);
        return view('usersView.evenementsList', [
            'userEvenements' => $userEvenements,
            'date' => $date,
            'category' => $category,
            'regions' => $regions,
            'region_filtre' => $region_filtre,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Categories::select('name', 'id')->get();
        $regions = Region::select('name', 'id')->orderby('id')->get();

        return view('usersView.evenementsForm', [
            'categories' => $categories,
            'regions' => $regions,
        ]);
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
        $valid = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required',
            'city' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'duree' => 'required',
            'lieu' => 'required',
            'adresse' => 'required',
            // 'players_number' => 'required',

        ]);

        $evenement = $valid;
        $evenement['category_id'] = $request->categories;
        $evenement['region'] = $request->region;
        $evenement['city'] = $request->city;
        $evenement['date'] = $request->date;
        $evenement['heure'] = $request->heure;
        $evenement['lieu'] = $request->lieu;
        $evenement['duree'] = $request->duree;
        $evenement['author_id'] = Auth::user()->id;
        $evenement['adresse'] = $request->adresse;
        $evenement['players_number'] = $request->player;
        if ($request->play) {
            $evenement['players_number'] -= 1;
        }

        $newEvenement = Evenements::create($evenement);

        if ($request->play) {
            $newEvenement->players()->attach(Auth::user()->id);
            $newEvenement['players_number'] -= 1;
        }
        if ($newEvenement) {
            return redirect('/userEvenements')->with('create', 'évènement crée avec succès !');
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
        $userEvenements = Evenements::find($id);
        return view('usersView.evenementShow', [
            'userEvenements' => $userEvenements
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Evenements $userEvenement)
    {
        //
        $categories = categories::select('name', 'id')->get();
        $regions = Region::select('name', 'id')->orderby('id')->get();

        return view('usersView.evenementsEdited', [
            'userEvenement' => $userEvenement,
            'categories' => $categories,
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
        $evenement = Evenements::find($id);
        $valid = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required',
            'categories' => 'required',
            'region' => 'required',
            'city' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'duree' => 'required',
            'lieu' => 'required',
            'adresse' => 'required',

        ]);

        $evenementEdited = $valid;
        $evenementEdited['category_id'] = $request->categories;
        $evenementEdited['region'] = $request->region;
        $evenementEdited['city'] = $request->city;
        $evenementEdited['date'] = $request->date;
        $evenementEdited['heure'] = $request->heure;
        $evenementEdited['duree'] = $request->duree;
        $evenementEdited['lieu'] = $request->lieu;
        $evenementEdited['author_id'] = Auth::user()->id;
        $evenementEdited['adresse'] = $request->adresse;
        $evenementEdited['players_number'] = $request->players_number;

        if ($evenement['author_id'] == Auth::user()->id) {
            $evenement->update($evenementEdited);
        }


        if ($evenement) {

            return redirect('userEvenements')->with('update', "L'évenement $evenement->title a été mis à jour avec succès!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        $evenement = Evenements::find($id);
        if ($evenement['author_id'] == Auth::user()->id) {
            $evenement->players()->detach();
            $evenement->likes()->detach();
            $evenement->delete();
        }

        return back()->with('delete', "L'evenement  $evenement->title a été supprimé avec succès!");
    }

    public function participe($id)
    {
        $user_id = Auth::user()->id;
        $evenements = Evenements::find($id);
        // $participant = EvenementsUser::select('user_id')->where('user_id', $user_id);
        $evenements['players_number'];
        if ($evenements['players_number'] > 0) {
            $evenements['players_number'] -= 1;
            $evenements->players()->attach($user_id);
        }

        $evenements->save();

        return back()->with("participe", "vous participez a cet evenement !")->withInput();
    }

    public function annuler($id)
    {
        $user_id = Auth::user()->id;
        $evenement = Evenements::find($id);
        // $evenement->players()->detach($user_id);
        if ($evenement->players()->detach($user_id)) {
            $evenement['players_number'] += 1;
        }

        $evenement->save();

        return back()->with("annuler", "vous ne participez plus a cet evenement !")->withInput();
    }

    public function deletePlayers($id, Request $request)
    {
        $player_id = $request->player;

        $evenement = Evenements::find($id);




        if ($evenement->players()->detach($player_id)) {
            $evenement['players_number'] += 1;
        }
        $evenement->save();

        return back()->with("deletePlayer", "participant supprimé !")->withInput();
    }

    public function mesEvenements()
    {
        $userEvenements = Evenements::all()->where('author_id', Auth::user()->id)->where('date', '>=', date('Y-m-d'));
        // $participe = Evenements::select()->players()->where('user_id', Auth::user()->id);
        // dd($participe);

        return view('usersView.mesEvenements', [
            'userEvenements' => $userEvenements,
        ]);
    }

    public function editProfil($id)
    {
        $user = User::find($id);
        return view('usersView.editProfil', ['user' => $user]);
    }

    public function updateProfil(Request $request, $id)
    {

        $user = User::find($id);
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'role' => ['required', 'string'],


        ]);


        $register = $validate;
        $register['name'] = $request->name;
        $register['email'] = $request->email;

        $user->update($register);
        // dd($user);
        // dd($user);
        if ($user) {
            return redirect('profil')->with('compteUpdate', 'Votre compte a été bien mis à jour!');
        } else {
            return back()->with("errorRegister", "registration failed")->withInput();
        }
    }

    public function like($id)
    {
        $user = Auth::user();
        $evenement = Evenements::find($id);
        // dd($evenement);
        $user->Likes()->toggle($evenement);

        return back();
    }

    public function favoris()
    {

        return view('usersView.favoris');
    }
}
