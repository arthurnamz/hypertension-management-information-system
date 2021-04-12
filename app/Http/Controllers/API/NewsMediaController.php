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
use App\News;
use App\News_media;
use App\Gallery_album;
use Validator;

class NewsMediaController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $News_media = News_media::with('News')->all(); 
        return $this->sendResponse($News_media->toArray(), '200 Congratution! News Media successfully retrived.');
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
            'news_id' => 'required', 
            'media' => 'required', 
            'type' => 'required'
        ]); 

     if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 
        $news_check = News::where('id',$request -> news_id)->count();

        if($news_check == 1 ){
        $News_media = News_media::create($input); 
      return $this->sendResponse($News_media->toArray(), '200 Congratulation! News Media created successfully.');
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
        $News_media = News_media::find($id); 

        if (is_null($News_media)) { 

        return $this->sendError('404! News_media not found.'); 

        } 

        return $this->sendResponse($News_media->toArray(), '200 Congratulation! News Media retrieved successfully.');
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
           'news_id' => 'required', 
            'media' => 'required', 
            'type' => 'required'
        ]); 

     if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 
        $News_media = News_media::find($id);
        $News_media->news_id = $input['news_id']; 
        $News_media->media = $input['media']; 
        $News_media->type = $input['type'];  
        $News_media->save(); 

    return $this->sendResponse($News_media->toArray(), '200 Congratulation! News Media updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $News_media= News_media::find($id);
        $News_media->delete(); 
        return $this->sendResponse($News_media->toArray(), '204! News Media deleted successfully.');
    }
}
