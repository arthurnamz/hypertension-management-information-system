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


class GalleryController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Gallery = Gallery::with('Gallery_album')->all(); 
        return $this->sendResponse($Gallery->toArray(), '200 Congratution! Gallery successfully retrived.');
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
    public function store(Request $request, Gallery $Gallery)
    {
        $input = $request->all(); 
        $validator = Validator::make($input, [ 
            'gallery_album_id' => 'required', 
            'name' => 'required', 
            'image' => 'required',
            'description' => 'required'
        ]); 

     if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 
        $album_check = Gallery_album::where('id',$request -> gallery_album_id)->count();

        if($album_check == 1 ){
        $Gallery = Gallery::create($input); 
        return $this->sendResponse($Gallery->toArray(), '200 Congratulation! Gallery created successfully.');
    }else{

        return $this->sendWarning( '404 ! Sorry something went wrong.');
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
        $Gallery = Gallery::find($id); 

        if (is_null($Gallery)) { 

        return $this->sendError('404! Gallery not found.'); 

        } 

    return $this->sendResponse($Gallery->toArray(), '200 Congratulation! Gallery retrieved successfully.');
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
            'gallery_album_id' => 'required', 
            'name' => 'required', 
            'image' => 'required',
            'description' => 'required'
        ]); 
        if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 
        $Gallery = Gallery::find($id);
        $Gallery->gallery_album_id = $input['gallery_album_id']; 
        $Gallery->name = $input['name']; 
        $Gallery->image = $input['image']; 
        $Gallery->description = $input['description'];  
        $Gallery->save(); 

    return $this->sendResponse($Gallery->toArray(), '200 Congratulation! Gallery updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Gallery= Gallery::find($id);
        $Gallery->delete(); 
        return $this->sendResponse($Gallery->toArray(), '204! Gallery deleted successfully.');
    }
}
