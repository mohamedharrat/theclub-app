<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\categories;
use App\Models\Evenements;
use App\Models\User;
use App\Models\ville;

use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvenementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $evenements =  Evenements::orderby('date', 'desc')->paginate(5);

        return view('admin.evenements.evenementsList', [
            'evenements' => $evenements,
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
        $users = User::select('name', 'id')->get();
        $categories = categories::select('name', 'id')->get();
        $regions = Region::select('name', 'id')->orderby('id')->get();

        return view('admin.evenements.evenementsForm', [
            'categories' => $categories,
            'regions' => $regions,
            'users' => $users,
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
        $evenement['city'] = $request->ville;
        $evenement['date'] = $request->date;
        $evenement['heure'] = $request->heure;
        $evenement['duree'] = $request->duree;
        $evenement['lieu'] = $request->lieu;
        $evenement['author_id'] = $request->user;
        $evenement['adresse'] = $request->adresse;
        $evenement['players_number'] = $request->player;

        $newEvenement = Evenements::create($evenement);
        if ($newEvenement) {
            return redirect('admin/evenements')->with('create', '??v??nement cr??e avec succ??s !');
        } else {
            return back()->with('errorRegister', "erreur ?? la cr??ation de l'??v??nement");
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
        $evenements = Evenements::find($id);
        $users = User::all();

        return view('admin.evenements.evenementShow', [
            'evenements' => $evenements,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Evenements $evenement)
    {
        //
        $categories = categories::select('name', 'id')->get();
        $regions = Region::select('name', 'id')->orderby('id')->get();

        return view('admin.evenements.evenementsEdited', [
            'evenement' => $evenement,
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
        $evenements = Evenements::find($id);
        $valid = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required',

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


        $evenements->update($evenementEdited);




        return redirect('admin/evenements')->with('update', "L'??venement n?? $evenements->id a ??t?? mis ?? jour avec succ??s!");
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
        $evenement = Evenements::find($id);
        $evenement->players()->detach();
        $evenement->delete();

        return back()->with('delete', "L'evenement n?? $evenement->id a ??t?? supprim?? avec succ??s!");
    }

    public function search()
    {

        $search = request()->input('search-evenements');
        $results = Evenements::where('lieu', 'like', "%$search%")->orwhere('city', 'like', "%$search%")->orwhere('region', 'like', "%$search%")->orwhere('date', 'like', "%$search%")->paginate(5);
        return view('admin.evenements.searchEvenements', ['results' => $results]);
    }

    public function ajoutPlayer($id, Request $request)
    {
        $user_id = $request->user;
        // dd($user_id);
        $evenements = Evenements::find($id);
        // $participant = EvenementsUser::select('user_id')->where('user_id', $user_id);
        // $evenements['players_number'];
        if ($evenements['players_number'] > 0) {
            $evenements['players_number'] -= 1;
            $evenements->players()->attach($user_id);
        }

        $evenements->save();

        return back()->with("ajouter", "utilisateur ajout?? avec succ??s !");
    }

    public function adminDeletePlayers($id, Request $request)
    {
        $player_id = $request->player;

        $evenement = Evenements::find($id);




        if ($evenement->players()->detach($player_id)) {
            $evenement['players_number'] += 1;
        }
        $evenement->save();

        return back()->with("annuler", "participant supprim?? !");
    }

    public function dashboard()
    {
        $users = User::all();
        $evenements = Evenements::all();

        return view(
            'admin.dashboard',
            [
                'users' => $users,
                'evenements' => $evenements,
            ]
        );
    }
}
