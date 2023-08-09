<?php

namespace App\Controllers; 
use App\Models\Humedad;



    class HumedadController extends Controller
    {

        public function index()
        {
           
            $model = new humedad;
           return $contacts = $model->all();
           print("entro a index");
           /* foreach ($$contacts as $contact)
             {
              $id_tempteratura= $contact['id_humedad'];
              $humedad=$contact['humedad'];
              $fecha=$contact['fecha'];

             }*/

             

            //compact() genera un array con la estructura ['contact'=>$contacts]
             //return $this->view('contact.index',compact('contacts'));
        }
        public function create()
        {  print("entro a create");
            return $this->view('humedad.create');
        }
        public function store()
        {   
            $fecha = date("Y-m-d H:i:s", strtotime('now'));
            //$model = new humedad;
            //$contacts = $model->all();
            //return $this->$contacts = json_encode($contacts);
            print("entro a store");
             $data=$_POST;
             var_dump($data);
             $keyData="fecha";
             $valorData=$fecha;
             $data[$keyData]=$valorData;
            //return $data; //retonar datos del formulario
             $model= new humedad;
    
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
