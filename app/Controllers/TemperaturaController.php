<?php

namespace App\Controllers; 
use App\Models\temperatura;




    class TemperaturaController extends Controller
    {

        public function index()
        {
           
            $model = new temperatura;
           return $contacts = $model->all();
           /* foreach ($$contacts as $contact)
             {
              $id_tempteratura= $contact['id_temperatura'];
              $temperatura=$contact['temperatura'];
              $fecha=$contact['fecha'];

             }*/

             

            //compact() genera un array con la estructura ['contact'=>$contacts]
             //return $this->view('contact.index',compact('contacts'));
        }
        public function create()
        {
            return $this->view('temperatura.create');
        }
        public function store()
        {
            //$model = new temperatura;
            //$contacts = $model->all();
            //return $this->$contacts = json_encode($contacts);

            $data=$_POST;
            //return $data; //retonar datos del formulario
             $model= new temperatura;
    
             return $model->create($data);
    
           // return $this->redirect('/dispositivo');
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
