<?php

//use App\Controllers\Controller;
namespace App\Controllers;

use App\Models\Home;
//use App\Models\Model;

class HomeController extends Controller
{

    public function index()
    {  
       
        $model= new home;
        $homes=$model->all();
        //compact() genera un array con la estructura ['contact'=>$contacts]
      return $this->view('home.index',compact('homes'));
    }
    public function create()
    {   
        return $this->view('home.create');
    }
    public function store()
    { 
        
           
          $data=$_POST;
        //return $data; //retonar datos del formulario
         $model= new home;

         $model->create($data);

        return $this->redirect('/contacts');
        
     
    }
    public function show($id)
    {  
        $model= new home;
        $contact=$model->find($id);
    
        return $this->view("home.show",compact('home'));
    }

    public function edit($id)
    {   
        $model= new home;
        $contact=$model->find($id);
        return $this->view("home.edit",compact('home'));
    }
    public function update($id)
    {
       $data=$_POST;
       $model= new home;

       $model->update($id,$data);
       $this->redirect("/homes/{$id}");

       
    }
    public function destroy($id)
    {
        $model=new home;
        $model->delete($id);
        $this->redirect("/homes");
    }

}