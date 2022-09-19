<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\categories;
use App\Models\Evenements;
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
        $evenements = Evenements::all();

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
        $categories = categories::select('name', 'id')->get();
        $regions = Region::select('name', 'id')->oldest('name')->get();
        $villes = Ville::select('name', 'id')->oldest('name')->get();

        return view('admin.evenements.evenementsForm', [
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
        $evenement['date_heure'] = $request->date_heure;
        $evenement['duree'] = $request->duree;
        $evenement['author_id'] = Auth::user()->id;
        $evenement['adresse'] = $request->adresse;

        $newEvenement = Evenements::create($evenement);
        if ($newEvenement) {
            return view('admin.evenements.evenementsList');
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
        $evenement->delete();

        return back()->with('delete', "L'evenement n° $evenement->id a été supprimé avec succès!");
    }
}
