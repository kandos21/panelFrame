<?php

//use App\Controllers\Controller;
namespace App\Controllers;

use App\Models\Contact;
//use App\Models\Model;

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
        $model= new contact;
        $contact=$model->find($id);
    
        return $this->view("contact.show",compact('contact'));
    }

    public function edit($id)
    {   
        $model= new contact;
        $contact=$model->find($id);
        return $this->view("contact.edit",compact('contact'));
    }
    public function update($id)
    {
       $data=$_POST;
       $model= new contact;

       $model->update($id,$data);
       $this->redirect("/contacts/{$id}");

       
    }
    public function destroy($id)
    {
        $model=new contact;
        $model->delete($id);
        $this->redirect("/contacts");
    }

}