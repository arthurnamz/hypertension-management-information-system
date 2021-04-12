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

class ContactController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $Contact = Contact::all(); 
        return $this->sendResponse($Contact->toArray(), '200 Congratution! Contact us  successfully retrived.');
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
    public function store(Request $request, Contact $Contact) 
    {
        //
        $input = $request->all(); 
        $validator = Validator::make($input, [ 
            'name' => 'required', 
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]); 


        if($validator->fails()){ 

            return $this->sendError('Validation Error.', $validator->errors()); 
        } 

        $Contact = Contact::create($input); 
        return $this->sendResponse($Contact->toArray(), '200 Congratulation! Contact created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact, $id)
    {
    
    $Contact = Contact::find($id); 

    if (is_null($Contact)) { 

    return $this->sendError('404! Contact not found.'); 

    } 

    return $this->sendResponse($Contact->toArray(), '200 Congratulation! Contact retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $Contact, $id)
    {
    $input = $request->all(); 
    $validator = Validator::make($input, [ 
            'name' => 'required', 
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]); 

    if($validator->fails()){ 
        return $this->sendError('Validation Error.', $validator->errors()); 
    } 

    $Contact = Contact::find($id);
    $Contact->name = $input['name']; 
    $Contact->email = $input['email']; 
    $Contact->subject = $input['subject']; 
    $Contact->message = $input['message']; 
    $Contact->save(); 

    return $this->sendResponse($Contact->toArray(), '200 Congratulation! Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact, $id)
    {
        //
    $Contact= Contact::find($id);
    $Contact->delete(); 
    return $this->sendResponse($Contact->toArray(), '204! Contact deleted successfully.');
    }
}
