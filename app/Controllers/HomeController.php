<?php
 
 namespace App\Controllers; 
 use App\Models\contact;

class HomeController extends Controller
{
    public function index()
    {
    $contacModel=new Contact();  
    // return $contacModel->all();
    //return $contacModel->find(1100);
    //return $contacModel->where('temperatura','30');
    //return $contacModel->where('temperatura','30')->get();
    //return $contacModel->where('temperatura','30')->first();

    //return $contacModel->where('temperatura','>=',35)->get();

    //return $contacModel->update(1748,[ 'temperatura'=>'24.9','id_sensor'=>'1','fecha'=>'2023-08-05 12:10:03']);
    return $contacModel->delete(1748);

   // return $contacModel->first();
    return $this->view('home',['title'=>'Inicio','descripcion'=>'pagina inicio 2023']);
    }

  

    

}