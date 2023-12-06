
<!-- Tampilan HTML -->
@extends('layouts.main_superadmin')

@section('container')
<h1 class="jadwal h3 mb-0 text-gray-800" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; text-align: center;"> TAMBAH KELAS</h1>
          
<div class="tablewali">
    <form action="/tambahkelas-superadminMU" method="post">
        @csrf
        <div class="form-group">
            <label for="id_kelas">ID Kelas:</label>
            <input type="text" class="form-control" id="id_kelas" name="id_kelas" >
        </div>
        <div class="form-group">
            <label for="wali_kelas">Wali Kelas:</label>
            <input type="text" class="form-control" id="wali_kelas" name="wali_kelas">
        </div>
        <div class="form-group">
            <label for="nama_kelas">Nama Kelas:</label>
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas">
        </div>
        <div class="form-group">
            <label for="tingkatan_kelas">Tingkatan Kelas:</label>
            <input type="text" class="form-control" id="tingkatan_kelas" name="tingkatan_kelas">
        </div>
        <div class="form-group">
            <label for="kelompok_kelas">Kelompok Kelas:</label>
            <input type="text" class="form-control" id="kelompok_kelas" name="kelompok_kelas">
        </div>
        <button type="submit" class="btn btn-warning">Tambah Kelas</button>
    </form>
</div> 




@endsection
