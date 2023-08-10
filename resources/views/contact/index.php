<?php

use App\Controllers\TemplateController;

    // TemplateController::class,'header';
  $template= new TemplateController();
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
              <h1>Temperatura</h1>
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
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-thermometer-full"></i></span>

              <div class="info-box-content">
                <span id="boxTempPromedio" class=" boxTempPromedio info-box-text">Temp. Promedio</span>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  <?php $template->footer(); ?>



  <?php // foreach ($contacts as $contact) : ?>
                 <!-- <tr>
                    <td><a href="/contacts/<?= $contact['id_temperatura'] ?>"><?= $contact['id_sensor'] ?></a></td>
                    <td><?= $contact['temperatura1'] ?></td>
                    <td><?= $contact['temperatura2'] ?></td>
                    <td><?= $contact['id_modulo'] ?></td>
                    <td><?= $contact['fecha'] ?></td>
                  </tr>-->
                <?php //endforeach ?>