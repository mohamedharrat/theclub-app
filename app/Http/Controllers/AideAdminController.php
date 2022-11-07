<?php

namespace App\Http\Controllers;

use App\Models\AideAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AideAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aideAdmins = AideAdmin::orderby('created_at', 'asc')->get();

        return view(
            'admin.aideAdmin.listAideAdmin',
            [
                'aideAdmins' => $aideAdmins,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('usersView.aideAdminForm');
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

        $aideAdmin = $valid;

        $aideAdmin['title'] = $request->title;
        $aideAdmin['email'] = Auth::user()->email;
        $aideAdmin['content'] = $request->content;
        $aideAdmin['author_id'] = Auth::user()->id;
        $aideAdmin['status'] = 'non-lu';




        $newAideAdmin = AideAdmin::create($aideAdmin);
        // dd($newAideAdmin);

        if ($newAideAdmin) {
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
        $aideAdmins = AideAdmin::find($id);
        return view('admin.aideAdmin.aideAdminShow', [
            'aideAdmins' => $aideAdmins
        ]);
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
    }
}
