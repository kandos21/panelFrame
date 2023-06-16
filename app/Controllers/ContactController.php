<?php

//use App\Controllers\Controller;
namespace App\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{

    public function index()
    {  
       
        $model= new contact;
        $contacts=$model->all();

        //compact() genera un array con la estructura ['contact'=>$contacts]
       
      return $this->view('contact.index',compact('contacts'));
    }
    public function create()
    {

    }
    public function store()
    {

    }
    public function show($id)
    {
        return "se encontrara el id $id";
    }

    public function edit($id)
    {
       return "se encontrara el id";
    }
    public function update($id)
    {

    }
    public function destroy($id)
    {

    }

}