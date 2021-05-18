<?php
  function rupiah($angka){
	
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
  
    <!-- Custom fonts for this template-->
    <link href="<?= base_url()?>assets/css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="<?= base_url()?>assets/css/simple-sidebar.css" rel="stylesheet">

    <link href="<?= base_url()?>assets/css/style.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!-- sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  
  <script src="<?= base_url()?>assets/js/script.js"></script>

  <title><?= $title?></title>
</head>

<body>

<div class="d-flex mt-3" id="wrapper">

<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
  <!-- <div class="sidebar-heading"><a href="<?= base_url()?>katalog/" class="text-dark">Home</a></div> -->
  <div class="list-group list-group-flush mt-3">
    <a href="<?= base_url()?>admin/" class="list-group-item list-group-item-action" id="rekap"><i class="fa fa-flag"></i> Rekap</a>
    <a href="<?= base_url()?>admin/pemasukan" class="list-group-item list-group-item-action" id="pemasukan"><i class="fa fa-sign-in-alt"></i> Pemasukan</a>
    <a href="<?= base_url()?>admin/pengeluaran" class="list-group-item list-group-item-action" id="pengeluaran"><i class="fa fa-sign-out-alt"></i> Pengeluaran</a>
    <a href="<?= base_url()?>login/logout" class="list-group-item list-group-item-action" id="pengeluaran">Keluar</a>
  </div>
</div>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<div id="page-content-wrapper">
  <div class="container sticky-top">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-info pt-0">
            <li class="mr-3 mt-2 d-flex justify-content-between">
              <a href="#" id="menu-toggle" class="btn btn-sm"><i class="fa fa-bars text-light"></i><span class="ml-3 text-light"><b><?= $title?></b></span></a> 
            </li>
        </ol>
    </nav>
  </div>