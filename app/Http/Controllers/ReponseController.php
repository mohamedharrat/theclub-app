<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use App\Models\AideAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = Auth::user()->id;
        $aideAdmins = AideAdmin::select()->where('author_id', $user_id)->get();
        if ($aideAdmins->count() != 0) {

            foreach ($aideAdmins as $aideAdmin) {
                // dd($aideAdmin->id);
                $reponses = Reponse::select()->where('aideAdmin_id', $aideAdmin->id)->orderby('created_at', 'asc')->get();
            }
        }
        // else {
        //     $reponses = Reponse::all();
        // }
        // dd($reponses);
        return view(
            'usersView.reponseAdmin',
            [
                'reponses' => $reponses,
                // 'aideAdmin' => $aideAdmin,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'content' => 'required|string',

        ]);

        $reponse = $valid;

        $reponse['title'] = $request->title;
        $reponse['content'] = $request->content;
        $reponse['author_id'] = Auth::user()->id;
        $reponse['aideAdmin_id'] = $request->aideAdmin_id;




        $newReponse = Reponse::create($reponse);
        // dd($newAideAdmin);

        if ($newReponse) {
            return redirect(route('aideAdmin.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function show(Reponse $reponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function edit(Reponse $reponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reponse $reponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reponse $reponse)
    {
        //
    }
}
