<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operation;
use App\OperationAttribute;
use App\Models\Auth\User;
use Carbon\Carbon;
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
        $this->validate($request, [
            'name' => 'required',
            'operation_type' => 'required',
            'operation_at' => 'required|date|after:now',
            'attr_priority' => 'required',
            'attr_srp' => 'required'
        ]);
        
        // Get User it is assigned to
        $assignedID = null;
        if ($request->input('assigned_to')) {
            $character_id = $request->input('assigned_to');
            $assignedUser = Self::getOrCreateUser($character_id);
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

        // Assign Attributes
        foreach ($request->input() as $key => $value) {
            if (substr($key,0,5) == 'attr_' && $value != null) {
                $attribute = new OperationAttribute;
                $attribute->operation_id = $operation->id;
                $attribute->name = $key;
                $attribute->value = $value;
                $attribute->save();
            }
        }

        Toastr::success("Operation '{$operation->name}' successfully added!", "New Operation");
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
        $operation = Operation::find($id);

        if($operation) {
            return view('operations.create')->with('operation', $operation);
        } else {
            return redirect('operations/create');
        }
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
        $this->validate($request, [
            'name' => 'required',
            'operation_type' => 'required',
            'operation_at' => 'required|date|after:now',
            'attr_priority' => 'required',
            'attr_srp' => 'required'
        ]);

        // Get User it is assigned to
        $assignedID = null;
        if ($request->input('assigned_to')) {
            $character_id = $request->input('assigned_to');
            $assignedUser = Self::getOrCreateUser($character_id);
            $assignedID = $assignedUser->id;
        }

        // Update Operation
        $operation = Operation::find($id);
        $operation->name = $request->input('name');
        $operation->type = $request->input('operation_type');
        $operation->assigned_to = $assignedID;
        $operation->operation_at = $request->input('operation_at');
        $operation->modified_by = auth()->user()->id;
        $operation->modified_at = Carbon::now();
        $operation->save();

        // Assign Attributes
        foreach ($request->input() as $key => $value) {
            if (substr($key,0,5) == 'attr_') {
                $attribute = OperationAttribute::firstOrNew(['name' => $key]);
                if ($value == null && $attribute->exists) {
                    $attribute->delete();
                } elseif ($value != null) {
                    $attribute->operation_id = $operation->id;
                    $attribute->name = $key;
                    $attribute->value = $value;
                    $attribute->save();
                }
            }
        }

        Toastr::success("Operation '{$operation->name}' successfully updated!", "Updated Operation");
        return redirect('/');
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


    /**
     * @param $character_id the EVE character ID of the new user we wish to create
     * @return User - The newly created or retrieved user
     */
    public function getOrCreateUser($character_id) {

        $user = User::firstOrNew(['character_id' => $character_id]);
        if (!$user->exists) {
            $api = new Conduit();
            $character =  $api->characters($character_id)->get();
            $corporation = $api->corporations($character->corporation_id)->get();

            // Collect Alliance id
            $caid = data_get($character, 'data.alliance_id');

            // And then update the data in case something changed
            $user->character_id = $character_id;
            $user->character_name = $character->name;
            $user->corporation_id = $character->corporation_id;
            $user->corporation_name = $corporation->name;
            if ($caid) {
                $alliance = $api->alliances($caid)->get();
                $user->alliance_id = $character->alliance_id;
                $user->alliance_name = $alliance->name;
            } else  {
                $user->alliance_id = 0;
                $user->alliance_name = 'No Alliance';
            }
            $user->save();
        }

        return $user;
    }
}
