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

class NewsController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $News = News::with('News_media')->all(); 
        return $this->sendResponse($News->toArray(), '200 Congratution! News successfully retrived.');
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
            'heading' => 'required', 
            'description' => 'required', 
            'date_published' => 'required'
        ]); 

     if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 
        
        $News = News::create($input); 
        return $this->sendResponse($News->toArray(), '200 Congratulation! News created successfully.');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $News = News::find($id); 

        if (is_null($News)) { 

        return $this->sendError('404! News not found.'); 

        } 

        return $this->sendResponse($News->toArray(), '200 Congratulation! News retrieved successfully.');
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
            'heading' => 'required', 
            'description' => 'required', 
            'date_published' => 'required'
        ]); 

     if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 
        $News = News::find($id);
        $News->heading = $input['heading']; 
        $News->description = $input['description']; 
        $News->date_published = $input['date_published'];  
        $News->save(); 

    return $this->sendResponse($News->toArray(), '200 Congratulation! News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $News= News::find($id);
         $News->delete(); 
        return $this->sendResponse($News->toArray(), '204! News deleted successfully.');
    }
}
