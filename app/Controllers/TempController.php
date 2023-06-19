

 <?php

   
use App\Controllers\Controller;
use App\Models\temperatura;

    class TemperaturaController extends Controller
    {

        public function index()
        {
           
            $model = new temperatura;
            $contacts = $model->all();
            foreach ($$contacts as $contact)
             {
              $id_tempteratura= $contact['id_temperatura'];
              $temperatura=$contact['temperatura'];
              $fecha=$contact['fecha'];

             }

            


            //compact() genera un array con la estructura ['contact'=>$contacts]
            // return $this->view('contact.index',compact('contacts'));
        }
        public function create()
        {
        }
        public function store()
        {
            $model = new temperatura;
            $contacts = $model->all();
            return $this->$contacts = json_encode($contacts);
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
