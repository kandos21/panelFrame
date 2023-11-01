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
              <h1>SN:XXXXXXXXXX</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/contacts/create">inicio</a></li>
                <li class="breadcrumb-item active">DIETA 02</li>
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
                <span class="info-box-text">Temperatura promedio</span>
                <span class="info-box-number">50 ¨C</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 50%"></div>
                </div>
                <span class="progress-description">
                  ultimas 2 hrs.
                </span>
              </div>

            </div>

          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
              <span class="info-box-icon"><i class="fas fa-tint"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Humedad promedio</span>
                <span class="info-box-number">2 %</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 2%"></div>
                </div>
                <span class="progress-description">
                ultimas 2 hrs.
                </span>
              </div>

            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="card">
              <div class="card-header">
                 Sensor Temperatura 1
              </div>
              <div class="card-body">
                <div id="chart">

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="card">
              <div class="card-header">
                 Sensor Humedad 2
              </div>
              <div class="card-body">
                <div id="chart">

                </div>
              </div>
            </div>
          </div>
        </div>


       

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ultimas 24 horas </h3>
              </div>

              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <div class="dt-buttons btn-group flex-wrap"> <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Copy</span></button> <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>CSV</span></button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Excel</span></button> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>PDF</span></button> <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button"><span>Print</span></button>
                        <div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true" aria-expanded="false"><span>Column visibility</span><span class="dt-down-arrow"></span></button></div>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div id="example1_filter" class="dataTables_filter"><label>busqueda:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                        <thead>
                          <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Rendering engine</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Browser</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="odd">
                            <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                            <td>Firefox 1.0</td>

                          </tr>
                          <tr class="even">
                            <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                            <td>Firefox 1.5</td>

                          </tr>
                          <tr class="odd">
                            <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                            <td>Firefox 2.0</td>

                          </tr>
                          <tr class="even">
                            <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                            <td>Firefox 3.0</td>

                          </tr>
                          <tr class="odd">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td>Camino 1.0</td>

                          </tr>
                          <tr class="even">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td>Camino 1.5</td>

                          </tr>
                          <tr class="odd">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td>Netscape 7.2</td>

                          </tr>
                          <tr class="even">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td>Netscape Browser 8</td>

                          </tr>
                          <tr class="odd">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td>Netscape Navigator 9</td>

                          </tr>
                          <tr class="even">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td>Mozilla 1.0</td>

                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th rowspan="1" colspan="1">Rendering engine</th>
                            <th rowspan="1" colspan="1">Browser</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-5">
                      <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        <ul class="pagination">
                          <li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                          <li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                          <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                          <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                          <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                          <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                          <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                          <li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

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
    series: [{
      name: "Temp(c)",
      data: [45, 52, 38, 45, 19, 23, 2]
    }],
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

  function obtenerDatos() {
    const options = {
      method: "GET"
    };

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