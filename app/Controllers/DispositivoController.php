<?php

//use App\Controllers\Controller;
namespace App\Controllers;

use App\Models\Dispositivo;
use App\Models\Model;

class DispositivoController extends Controller
{

    public function index()
    {  
       
        $model= new dispositivo;
        $dispositivos=$model->all();
        //compact() genera un array con la estructura ['contact'=>$contacts]
      return $this->view('dispositivo.index',compact('dispositivos'));
    }
    public function create()
    {   
        return $this->view('dispositivo.create');
    }
    public function store()
    { 
        
           
          $data=$_POST;
        //return $data; //retonar datos del formulario
         $model= new dispositivo;

         $model->create($data);

        return $this->redirect('/dispositivo');
        
     
    }
    public function show($id)
    {  
        $model= new dispositivo;
        $dispositivo=$model->find($id);
    
        return $this->view("dispositivo.show",compact('dispositivo'));
    }

    public function edit($id)
    {   
        $model= new dispositivo;
        $dispositivo=$model->find($id);
        return $this->view("dispositivo.edit",compact('dispositivo'));
    }
    public function update($id)
    {
       $data=$_POST;
       $model= new dispositivo;

       $model->update($id,$data);
       $this->redirect("/dispositivo/{$id}");

       
    }
    public function destroy($id)
    {
        $model=new dispositivo;
        $model->delete($id);
        $this->redirect("/dispositivos");
    }

}