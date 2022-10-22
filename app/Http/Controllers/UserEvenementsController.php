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
        $foot = $request->foot;
        $tennis = $request->tennis;
        $basket = $request->basket;
        // dd($foot, $tennis, $basket);
        $userEvenements = Evenements::select()->where('date', date('Y/m/d'))->orderby('heure', 'asc')->get();


        if ($date = $request->date_filtre) {

            $userEvenements = Evenements::select()->where('date', $date)->where('category_id', $foot)->orwhere('category_id', $tennis)->orwhere('category_id', $basket)->orderby('heure', 'asc')->get();

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
        // else {
        //     $userEvenements = Evenements::select()->where('date', date('Y/m/d'));
        // }


        // dd($userEvenements);
        return view('usersView.evenementsList', [
            'userEvenements' => $userEvenements,
            'date' => $date,
            'foot' => $foot,
            'tennis' => $tennis,
            'basket' => $basket,
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
        $regions = Region::select('name', 'id')->oldest('name')->get();
        $villes = Ville::select('name', 'id')->oldest('name')->get();

        return view('usersView.evenementsForm', [
            'categories' => $categories,
            'regions' => $regions,
            'villes' => $villes,
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


        ]);

        $evenement = $valid;
        $evenement['category_id'] = $request->categories;
        $evenement['region'] = $request->region;
        $evenement['city'] = $request->ville;
        $evenement['date'] = $request->date;
        $evenement['heure'] = $request->heure;
        $evenement['lieu'] = $request->lieu;
        $evenement['duree'] = $request->duree;
        $evenement['author_id'] = Auth::user()->id;
        $evenement['adresse'] = $request->adresse;
        $evenement['players_number'] = $request->player;

        $newEvenement = Evenements::create($evenement);
        if ($newEvenement) {
            return redirect('/userEvenements');
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
        $regions = Region::select('name', 'id')->oldest('name')->get();
        $villes = Ville::select('name', 'id')->oldest('name')->get();

        return view('usersView.evenementsEdited', [
            'userEvenement' => $userEvenement,
            'categories' => $categories,
            'regions' => $regions,
            'villes' => $villes,
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
            'ville' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'duree' => 'required',
            'lieu' => 'required',
            'adresse' => 'required',

        ]);

        $evenementEdited = $valid;
        $evenementEdited['category_id'] = $request->categories;
        $evenementEdited['region'] = $request->region;
        $evenementEdited['city'] = $request->ville;
        $evenementEdited['date'] = $request->date;
        $evenementEdited['heure'] = $request->heure;
        $evenementEdited['duree'] = $request->duree;
        $evenementEdited['lieu'] = $request->lieu;
        $evenementEdited['author_id'] = Auth::user()->id;
        $evenementEdited['adresse'] = $request->adresse;

        if ($evenement['author_id'] == Auth::user()->id) {
            $evenement->update($evenementEdited);
        }


        if ($evenement) {

            return view('admin.evenements.evenementsList')->with('update', "L'évenement n° $evenement->id a été mis à jour avec succès!");
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
            $evenement->delete();
        }

        return back()->with('delete', "L'evenement n° $evenement->id a été supprimé avec succès!");
    }

    public function participe($id)
    {
        $user_id = Auth::user()->id;
        $evenements = Evenements::find($id);
        // $participant = EvenementsUser::select('user_id')->where('user_id', $user_id);
        $evenements['players_number'];
        if ($evenements['players_number'] > 0 && $user_id != $evenements['author_id']) {
            $evenements['players_number'] -= 1;
            $evenements->players()->attach($user_id);
        }

        $evenements->save();

        return back()->with("Participe", "vous participez a cet evenement !")->withInput();
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

        return back()->with("annuler", "vous participez a cet evenement !")->withInput();
    }

    public function mesEvenements()
    {
        $userEvenements = Evenements::select()->where('author_id', Auth::user()->id)->orderby('date', 'asc')->get();
        return view('usersView.mesEvenements', [
            'userEvenements' => $userEvenements,
        ]);
    }
}
