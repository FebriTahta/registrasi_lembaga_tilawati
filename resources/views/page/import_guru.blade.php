@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Import Guru Lembaga {{auth()->user()->username}}</h5>
                                <p class="mb-4">
                                    - Unduh Template yang telah kami sediakan.<br>
                                    - Isi data Guru sesuai dengan template.<br>
                                    - Kemudian import lagi file template yang sudah diisi dengan data guru.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="card-body">
                        <a href="/export-template-guru" class="btn btn-info mb-2"><i class="fa fa-download"></i> Unduh Template Guru</a>
                        <a href="#" class="btn btn-primary mb-2"><i class="fa fa-upload"></i> Import Data Guru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection