<?php

namespace App\Controllers; 
use App\Models\Temperatura;

    class TemperaturaController extends Controller
    {

        public function index()
        {
           
            $model = new temperatura;
           return $temperaturas = $model->all();
           
        }
        public function create()
        {  
            return $this->view('temperatura.create');
        }
        public function store()
        {   
            $fecha = date("Y-m-d H:i:s", strtotime('now'));
           
             $data=$_POST;
             $keyData="fecha";
             $valorData=$fecha;
             $data[$keyData]=$valorData;
            //return $data; //retonar datos del formulario
             $model= new temperatura;
             return $model->create($data);
    
           // return $this->redirect('/dispositivo');
        }
        public function show($id)
        {
            return "se encontrara el id $id";
        }

        public function showUltimate()
        {
            $model = new temperatura;
            return $ultimoRegistro = $model->ultimateR();
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
