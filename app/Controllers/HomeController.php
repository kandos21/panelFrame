<?php
 
 namespace App\Controllers; 
 use App\Models\Contact;
//use App\Models\Model;


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
    //return $contacModel->update(1751,['temperatura'=>'46.2','fecha'=>'2023-06-15 09:41:57','id_sensor'=>'1']);

    //return $contacModel->where('temperatura','>=',35)->get();

    //return $contacModel->update(1748,[ 'temperatura'=>'24.9','id_sensor'=>'1','fecha'=>'2023-08-05 12:10:03']);
   // return $contacModel->delete(1751);
    //return $contacModel->where("temperatura","30 ' OR 'a'='a' ")->get();

   // return $contacModel->first();
    return $this->view('home',['title'=>'Inicio','descripcion'=>'pagina inicio 2023']);
    }

  

    

}