<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\Whitelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhitelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whitelist = Whitelist::all();

        return view('admin.whitelist.index', compact('whitelist'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.whitelist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $whitelist = new Whitelist();

        $whitelist->corporation_id = $request->corporation_id;
        $whitelist->corporation_name = $request->corporation_name;
        $whitelist->alliance_id = $request->alliance_id;
        $whitelist->alliance_name = $request->alliance_name;

        $whitelist->save();

        return redirect()->route('whitelist.index');
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
        $whitelist = Whitelist::find($id);

        $whitelist->corporation_id = $request->corporation_id;
        $whitelist->corporation_name = $request->corporation_name;
        $whitelist->alliance_id = $request->alliance_id;
        $whitelist->alliance_name = $request->alliance_name;

        $whitelist->save();

        return redirect()->route('whitelist.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Whitelist::find($id)->delete();

        return back();
    }
}
