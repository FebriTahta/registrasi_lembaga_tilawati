@extends('layouts.master')

@section('style')
    
@endsection

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
                                <h5 class="card-title text-primary">Menambahkan Santri Baru</h5>
                                <p class="mb-4">
                                    Isi form yang diperlukan berikut ini untuk menambahkan Santri baru
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
                        <form id="formsubmit"> @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="nama_santri">Nama Santri</label>
                                        <input type="text" name="nama_santri" class="form-control text-capitalize">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <div class="form-group">
                                        <label for="tempat_lahir_santri">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir_santri" class="form-control text-capitalize">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <label for="tanggal_lahir_santri">Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col-sm-4 col-4">
                                            <div class="form-group">
                                                <input type="number" name="tgl" min="1" max="31" class="form-control" placeholder="tgl">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-4">
                                            <div class="form-group">
                                                <select name="bln" class="form-control" id="" required>
                                                    <option value="">bln</option>
                                                    <option value="01">Jan</option>
                                                    <option value="02">Feb</option>
                                                    <option value="03">Mar</option>
                                                    <option value="04">Apr</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Jun</option>
                                                    <option value="07">Jul</option>
                                                    <option value="08">Agus</option>
                                                    <option value="09">Sep</option>
                                                    <option value="10">Okt</option>
                                                    <option value="11">Nov</option>
                                                    <option value="12">Des</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-4">
                                            <div class="form-group">
                                                <input type="number" name="thn" min="1950" max="{{date('Y')}}" class="form-control" placeholder="thn">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <div class="form-group">
                                        <label for="telp_guru">Wali Santri</label>
                                        <div class="col-md">
                                            <div class="form-check form-check-inline mt-3">
                                              <input class="form-check-input" type="radio" name="jenis_wali_santri" id="inlineRadio1" value="ayah" required>
                                              <label class="form-check-label" for="inlineRadio1">Ayah </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="jenis_wali_santri" id="inlineRadio2" value="ibu" required>
                                              <label class="form-check-label" for="inlineRadio2">Ibu </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_wali_santri" id="inlineRadio3" value="lainnya" required>
                                                <label class="form-check-label" for="inlineRadio3">Selain Ayah & Ibu </label>
                                              </div>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <div class="form-group">
                                        <label for="nama_wali_santri">Nama Wali Santri</label>
                                        <input type="text" name="nama_wali_santri" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <div class="form-group">
                                        <label for="telp_wali_santri">No. Telp (Whatsapp)</label>
                                        <input type="number" name="telp_wali_santri" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-3 ">
                                    <div class="form-group">
                                        <label for="alamat_santri">Alamat Santri</label>
                                        <textarea name="alamat_santri" class="form-control" id="alamat_santri" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit" id="btnsubmit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</div>
@endsection