<?php

namespace App\Http\Controllers\API;

use App\Contact;
use App\Namartist;
use App\Music;
use App\Album;
use App\Testmonies;
use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Validator;

class AlbumController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Album = Album::all(); 
        return $this->sendResponse($Album->toArray(), '200 Congratution! Album  successfully retrived.');
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
            'album_title' => 'required', 
            'cover_picture' => 'required',
            'for_sale' => 'required',
            'price' => 'required',
            'download' => 'required',
            'released_time' => 'required'
        ]); 


        if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 

        $Album = Album::create($input); 
        return $this->sendResponse($Album->toArray(), '200 Congratulation! Album created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Album = Album::find($id); 

    if (is_null($Album)) { 

    return $this->sendError('404! Album not found.'); 

    } 

    return $this->sendResponse($Album->toArray(), '200 Congratulation! Album retrieved successfully.');
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
            'album_title' => 'required', 
            'cover_picture' => 'required',
            'for_sale' => 'required',
            'price' => 'required',
            'download' => 'required',
            'released_time' => 'required'
        ]); 

    if($validator->fails()){ 
        return $this->sendError('Validation Error.', $validator->errors()); 
    } 
    $Album = Album::find($id);
    $Album->album_title = $input['album_title']; 
    $Album->cover_picture = $input['cover_picture'];  
    $Album->for_sale = $input['for_sale'];  
    $Album->price = $input['price'];  
    $Album->download = $input['download'];  
    $Album->released_time = $input['released_time'];  
    $Album->save(); 

    return $this->sendResponse($Album->toArray(), '200 Congratulation! Album updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Album= Album::find($id);
        $Album->delete(); 
        return $this->sendResponse($Album->toArray(), '204! Album deleted successfully.');
    }
}
