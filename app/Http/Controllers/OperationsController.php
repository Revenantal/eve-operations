<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operation;
use App\OperationAttribute;

class OperationsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            'operation_at' => 'required|date|after:now'
        ]);
        

        // Create Operation
        $operation = new Operation;
        $operation->name = $request->input('name');
        $operation->type = $request->input('operation_type');
        $operation->assigned_to = $request->input('assigned_to');
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

        return redirect('/')->with('success', 'Operation added successfully!');
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
    }

    public function operation_form_part($part_name) {
        return view('operations.parts.' . $part_name)->render();
    }
}
