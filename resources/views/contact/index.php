<?php

use App\Controllers\TemplateController;

// TemplateController::class,'header';
$template = new TemplateController();
$template->header();


?>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">


    <!-- menu inicio -->
    <?php $template->menu(); ?>

    <!-- menu fin -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Slave Methat</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/contacts/create">inicio</a></li>
                <li class="breadcrumb-item active">Temperatura</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->


        <div class="row">
          <!-- <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-thermometer-full"></i></span>

              <div class="info-box-content">
                <span id="boxTempPromedio" class=" boxTempPromedio info-box-text">Temperatura Promedio</span>

              </div>
              
            </div>
            
          </div>-->


          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fas fa-temperature-low"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Temperatura</span>
                <span class="info-box-number">50 ¨C</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 50%"></div>
                </div>
                <span class="progress-description">
                  13/08/2023 15:00:50
                </span>
              </div>

            </div>

          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
              <span class="info-box-icon"><i class="fas fa-tint"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Humedad</span>
                <span class="info-box-number">2 %</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 2%"></div>
                </div>
                <span class="progress-description">
                  13/08/2023 15:00:50
                </span>
              </div>

            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div id="chart">

            </div>
          </div>
        </div>


      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php $template->footer(); ?>



</body>

<script>

  obtenerDatos();
  var options = {
  chart: {
    height: 280,
    type: "area"
  },
  dataLabels: {
    enabled: false
  },
  series: [
    {
      name: "Temp(c)",
      data: [45, 52, 38, 45, 19, 23, 2]
    }
  ],
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.7,
      opacityTo: 0.9,
      stops: [0, 90, 100]
    }
  },
  xaxis: {
    categories: [
      "01 Jan",
      "02 Jan",
      "03 Jan",
      "04 Jan",
      "05 Jan",
      "06 Jan",
      "07 Jan"
    ]
  }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();








function obtenerDatos()
    {
      const options = 
    {  method: "GET"};

    let url = "https://me.wafflesbelgas.mx/temperatura";
    fetch(url, options)
      .then(response => {
        if (response.ok) return response.json()
      })
      .then(datos => chart.updateSeries([{
           name: 'Temperatura',
          data: response.data
  }]))
      .catch(error => console.log(error))



      
      
    }





</script>

</html>



<?php // foreach ($contacts as $contact) : 
?>
<!-- <tr>
                    <td><a href="/contacts/<?= $contact['id_temperatura'] ?>"><?= $contact['id_sensor'] ?></a></td>
                    <td><?= $contact['temperatura1'] ?></td>
                    <td><?= $contact['temperatura2'] ?></td>
                    <td><?= $contact['id_modulo'] ?></td>
                    <td><?= $contact['fecha'] ?></td>
                  </tr>-->
<?php //endforeach 
?>