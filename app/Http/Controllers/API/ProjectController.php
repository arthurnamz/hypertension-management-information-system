<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Namartist;
use App\Contact;
use App\Project;
use App\Music;
use App\Album;
use App\Testmonies;
use Illuminate\Http\Request;
use Validator;

class ProjectController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Project = Project::all(); 
        return $this->sendResponse($Project->toArray(), '200 Congratution! Project  successfully retrived.');
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
            'project_name' => 'required', 
            'picture' => 'required',
            'description' => 'required',
            'coordinator' => 'required',
            'date_started' => 'required'
        ]); 


        if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 

        $Project = Project::create($input); 
        return $this->sendResponse($Project->toArray(), '200 Congratulation! Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $Project = Project::find($id); 

        if (is_null($Project)) { 

        return $this->sendError('404! Project not found.'); 

        } 

        return $this->sendResponse($Project->toArray(), '200 Congratulation! Project retrieved successfully.');
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
    $input = $request->all(); 
    $validator = Validator::make($input, [ 
            'project_name' => 'required', 
            'picture' => 'required',
            'description' => 'required',
            'coordinator' => 'required',
            'date_started' => 'required'
        ]); 

    if($validator->fails()){ 
        return $this->sendError('Validation Error.', $validator->errors()); 
    } 
    $Project = Project::find($id);
    $Project->project_name = $input['project_name']; 
    $Project->picture = $input['picture']; 
    $Project->description = $input['description']; 
    $Project->coordinator = $input['coordinator']; 
    $Project->date_started = $input['date_started']; 
    $Project->save(); 

    return $this->sendResponse($Project->toArray(), '200 Congratulation! Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Project= Project::find($id);
        $Project->delete(); 
        return $this->sendResponse($Project->toArray(), '204! Project deleted successfully.');
    }
}
