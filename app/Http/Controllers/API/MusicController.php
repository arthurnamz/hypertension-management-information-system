<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Music;
use Illuminate\Http\Request;
use App\Contact;
use App\Namartist;
use App\Album;
use App\Testmonies;
use Validator;

class MusicController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Music = Music::with('Album')->all(); 
        return $this->sendResponse($Music->toArray(), '200 Congratution! Music successfully retrived.');
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
    public function store(Request $request, Music $Music)
    {
       $input = $request->all(); 
        $validator = Validator::make($input, [ 
            'namartists_id' => 'required', 
            'albums_id' => 'required', 
            'song_name' => 'required',
            'downloads' => 'required',
            'streams' => 'required',
            'image' => 'required',
            'song_file' => 'required',
            'genres' => 'required',
            'for_sale' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'released_time' => 'required',
            'date_produced' => 'required'
        ]); 

     if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 
        $artist_check = Namartist::where('id',$request -> namartists_id)->count();
        $album_check = ALbum::where('id',$request -> albums_id)->count();

        if($artist_check == 1 && $album_check == 1){
        $Music = Music::create($input); 
        return $this->sendResponse($Music->toArray(), '200 Congratulation! Music created successfully.');
    }else{

        return $this->sendWarning( '404 ! Sorry something went wrong.');
    }

    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function show(Music $Music, $id)
    {
      $Music = Music::find($id); 

        if (is_null($Music)) { 

        return $this->sendError('404! Music not found.'); 

        } 

        return $this->sendResponse($Music->toArray(), '200 Congratulation! Music retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit(Music $music)
    {
        //
    }

    public function download(Music $music, $id)
    {
        
        $Music = Music::find($id);
        $current_number = $Music->downloads;
        $Music->downloads = $current_number + 1;

        return $this->sendResponseForDownloads($Music->toArray(), 'Music downloaded successfully.');

    }

    public function stream(Music $music, $id)
    {
        $Music = Music::find($id);
        $current_number = $Music->streams;
        $Music->streams = $current_number + 1;

        return $this->sendResponseForDownloads($Music->toArray(), 'Music streamed successfully.');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $Music, $id)
    {
        //
        $input = $request->all(); 
        $validator = Validator::make($input, [ 
            'namartists_id' => 'required', 
            'albums_id' => 'required', 
            'song_name' => 'required',
            'downloads' => 'required',
            'streams' => 'required',
            'image' => 'required',
            'song_file' => 'required',
            'genres' => 'required',
<<<<<<< HEAD
=======
            'for_sale' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'released_time' => 'required',
>>>>>>> 3d5c7a1e1450b75a69de16b14572ce597300cb78
            'date_produced' => 'required'
        ]); 

     if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 
        $Music = Music::find($id);
        $Music->namartists_id = $input['namartists_id']; 
        $Music->albums_id = $input['albums_id']; 
        $Music->song_name = $input['song_name']; 
        $Music->downloads = $input['downloads']; 
        $Music->streams = $input['streams']; 
        $Music->image = $input['image']; 
        $Music->song_file = $input['song_file']; 
        $Music->genres = $input['genres'];  
<<<<<<< HEAD
=======
        $Music->for_sale = $input['for_sale'];  
        $Music->price = $input['price'];  
        $Music->duration = $input['duration'];  
        $Music->released_time = $input['released_time'];  
>>>>>>> 3d5c7a1e1450b75a69de16b14572ce597300cb78
        $Music->date_produced = $input['date_produced'];  
        $Music->save(); 

    return $this->sendResponse($Music->toArray(), '200 Congratulation! Music updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $Music, $id)
    {
    $Music= Music::find($id);
    $Music->delete(); 
    return $this->sendResponse($Music->toArray(), '204! Music deleted successfully.');
    }
}
