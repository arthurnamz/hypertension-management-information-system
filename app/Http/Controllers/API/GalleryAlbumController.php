<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use App\Music;
use App\Contact;
use App\Namartist;
use App\Album;
use App\Testmonies;
use App\Gallery;
use App\Gallery_album;
use Validator;

class GalleryAlbumController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $Gallery_album = Gallery_album::all(); 
        return $this->sendResponse($Gallery_album->toArray(), '200 Congratution! Gallery Album  successfully retrived.');
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
            'name' => 'required', 
            'description' => 'required',
            'gallery_cover' => 'required'
        ]); 


        if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 

        $Gallery_album = Gallery_album::create($input); 
        return $this->sendResponse($Gallery_album->toArray(), '200 Congratulation! Gallery Album created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Gallery_album = Gallery_album::find($id); 

        if (is_null($Gallery_album)) { 

        return $this->sendError('404! Gallery_album not found.'); 

        } 

    return $this->sendResponse($Gallery_album->toArray(), '200 Congratulation! Gallery Album retrieved successfully.');
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
                'name' => 'required', 
                'description' => 'required',
                'gallery_cover' => 'required'
            ]); 

        if($validator->fails()){ 
            return $this->sendError('Validation Error.', $validator->errors()); 
        } 
            $Gallery_album = Gallery_album::find($id);
            $Gallery_album->name = $input['name']; 
            $Gallery_album->description = $input['description'];  
            $Gallery_album->gallery_cover = $input['gallery_cover'];   
            $Gallery_album->save(); 

    return $this->sendResponse($Gallery_album->toArray(), '200 Congratulation! Gallery Album updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Gallery_album= Gallery_album::find($id);
        $Gallery_album->delete(); 
        return $this->sendResponse($Gallery_album->toArray(), '204! Gallery Album deleted successfully.');
    }
}
