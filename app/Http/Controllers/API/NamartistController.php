<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Namartist;
use App\Contact;
use App\Music;
use App\Album;
use App\Testmonies;
use Illuminate\Http\Request;
use Validator;

class NamartistController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Namartist = Namartist::all(); 
        return $this->sendResponse($Namartist->toArray(), '200 Congratution! Namartist  successfully retrived.');
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
    public function store(Request $request, Namartist $Namartist)
    {
         $input = $request->all(); 
        $validator = Validator::make($input, [ 
            'name' => 'required', 
            'email' => 'required',
            'phone_number' => 'required',
            'description' => 'required'
        ]); 


        if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 

        $Namartist = Namartist::create($input); 
        return $this->sendResponse($Namartist->toArray(), '200 Congratulation! Namartist created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Namartist  $namartist
     * @return \Illuminate\Http\Response
     */
    public function show(Namartist $namartist, $id)
    {
         $Namartist = Namartist::find($id); 

        if (is_null($Namartist)) { 

        return $this->sendError('404! Namartist not found.'); 

        } 

        return $this->sendResponse($Namartist->toArray(), '200 Congratulation! Namartist retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Namartist  $namartist
     * @return \Illuminate\Http\Response
     */
    public function edit(Namartist $namartist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Namartist  $namartist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Namartist $Namartist, $id)
    {
    $input = $request->all(); 
    $validator = Validator::make($input, [ 
            'name' => 'required', 
            'email' => 'required',
            'phone_number' => 'required',
            'description' => 'required'
        ]); 

    if($validator->fails()){ 
        return $this->sendError('Validation Error.', $validator->errors()); 
    } 
    $Namartist = Namartist::find($id);
    $Namartist->name = $input['name']; 
    $Namartist->email = $input['email']; 
    $Namartist->phone_number = $input['phone_number']; 
    $Namartist->description = $input['description']; 
    $Namartist->save(); 

    return $this->sendResponse($Namartist->toArray(), '200 Congratulation! Namartist updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Namartist  $namartist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Namartist $Namartist, $id)
    {
    $Namartist= Namartist::find($id);
    $Namartist->delete(); 
    return $this->sendResponse($Namartist->toArray(), '204! Namartist deleted successfully.');
    }
}
