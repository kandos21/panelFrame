<?php

namespace App\Controllers; 
//use App\Models\Temperatura;

    class TemplateController extends Controller
    {

        public  function header()
        {
           
            print($this->view('layout.header'));
            
        }
        public function menu()
        {  
           print($this->view('layout.menu'));
        }


        public function footer()
        {  
           print($this->view('layout.footer'));
        }
        
        
    }
