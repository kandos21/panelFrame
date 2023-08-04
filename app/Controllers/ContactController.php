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
        return $this->view('contact.create');
    }
    public function store()
    { 
        
           
          $data=$_POST;
        //return $data; //retonar datos del formulario
         $model= new contact;

         $model->create($data);

        return $this->redirect('/contacts');
        
     
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