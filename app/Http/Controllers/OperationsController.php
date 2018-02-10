<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operation;
use App\OperationAttribute;
use App\Models\Auth\User;
use Conduit\Conduit;
use Toastr;

class OperationsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:Admin|FC')->only('create', 'edit','destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Do we need this? 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //https://laracasts.com/discuss/channels/laravel/laravel-validation-rules-if-field-empty-another-field-required
        $this->validate($request, [
            'name' => 'required',
            'operation_type' => 'required',
            'operation_at' => 'required|date|after:now',
            'attr_priority' => 'required',
            'attr_srp' => 'required'
        ]);

        $assignedID = null;
        // Create a new user or assign an existing user
        if ($request->input('assigned_to')) {
            $character_id = $request->input('assigned_to');
            $assignedUser = User::firstOrNew(['character_id' => $character_id]);

            if (!$assignedUser->exists) {
                $api = new Conduit();
                $character =  $api->characters($character_id)->get();
                $corporation = $api->corporations($character->corporation_id)->get();

                // Collect Alliance id
                $caid = data_get($character, 'data.alliance_id');

                // And then update the data in case something changed
                $assignedUser->character_id = $character_id;
                $assignedUser->character_name = $character->name;
                $assignedUser->corporation_id = $character->corporation_id;
                $assignedUser->corporation_name = $corporation->name;
                if ($caid) {
                    $alliance = $api->alliances($caid)->get();
                    $assignedUser->alliance_id = $character->alliance_id;
                    $assignedUser->alliance_name = $alliance->name;
                } else  {
                    $assignedUser->alliance_id = 0;
                    $assignedUser->alliance_name = 'No Alliance';
                }
                $assignedUser->save();
            }
            $assignedID = $assignedUser->id;
        }


        // Create Operation
        $operation = new Operation;
        $operation->name = $request->input('name');
        $operation->type = $request->input('operation_type');
        $operation->assigned_to = $assignedID;
        $operation->operation_at = $request->input('operation_at');
        $operation->created_by = auth()->user()->id;
        $operation->save();

        foreach ($request->input() as $key => $value) {
            if (strpos($key, 'attr_') === 0 && $value != null) {
                $operationAttribute = new OperationAttribute;
                $operationAttribute->operation_id = $operation->id;
                $operationAttribute->name = $key;
                $operationAttribute->value = $value;
                $operationAttribute->save();
            }
        }

        Toastr::success("A new operation has been added!", "New Operation");
        return redirect('/');
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
        $operation = Operation::find($id);
        $operation->delete();
        Toastr::success("Operation deleted successfully!", "Success");
        return redirect('/');
    }
}
