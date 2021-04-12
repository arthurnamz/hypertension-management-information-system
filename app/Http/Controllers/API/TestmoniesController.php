<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Testmonies;
use App\Contact;
use App\Namartist;
use App\Music;
use App\Album;
use Illuminate\Http\Request;
use Validator;

class TestmoniesController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Testmonies = Testmonies::all(); 
        return $this->sendResponse($Testmonies->toArray(), '200 Congratution! Testmony  successfully retrived.');
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
       $input = $request->all(); 
        $validator = Validator::make($input, [ 
            'fname' => 'required', 
            'lname' => 'required', 
            'picture' => 'required',
            'occupation' => 'required',
            'message' => 'required'
        ]); 


        if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 

        $Testmonies = Testmonies::create($input); 
        return $this->sendResponse($Testmonies->toArray(), '200 Congratulation! Testmonies created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testmonies  $testmonies
     * @return \Illuminate\Http\Response
     */
    public function show(Testmonies $Testmonies, $id)
    {
        $Testmonies = Testmonies::find($id); 

        if (is_null($Testmonies)) { 

        return $this->sendError('404! Testmonies not found.'); 

        } 

        return $this->sendResponse($Testmonies->toArray(), '200 Congratulation! Testmonies retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testmonies  $testmonies
     * @return \Illuminate\Http\Response
     */
    public function edit(Testmonies $testmonies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testmonies  $testmonies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testmonies $testmonies, $id)
    {
    $input = $request->all(); 
    $validator = Validator::make($input, [ 
            'fname' => 'required', 
            'lname' => 'required', 
            'picture' => 'required',
            'occupation' => 'required',
            'message' => 'required'
        ]); 

    if($validator->fails()){ 
        return $this->sendError('Validation Error.', $validator->errors()); 
    } 
    $Namartist = Namartist::find($id);
    $Testmonies->fname = $input['fname']; 
    $Testmonies->lname = $input['lname']; 
    $Testmonies->picture = $input['picture']; 
    $Testmonies->occupation = $input['occupation']; 
    $Testmonies->message = $input['message']; 
    $Testmonies->save(); 

    return $this->sendResponse($Testmonies->toArray(), '200 Congratulation! Testmonies updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testmonies  $testmonies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testmonies $Testmonies, $id)
    {
        $Testmonies= Testmonies::find($id);
        $Testmonies->delete(); 
        return $this->sendResponse($Testmonies->toArray(), '204! Testmonies deleted successfully.');
    }
}
