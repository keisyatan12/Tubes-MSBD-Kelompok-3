@extends('layouts.main_superadmin')

@section('container')
<div class="edit text-sm-end"><a type="button" href="/tambahtu-superadminMU" class="btn btn-secondary mt-3 mb-3" ><i class="fa-solid fa-file-pen" style="color: #ffffff;"></i>Tambah Tata  Usaha</a></div>


                <!-- Page Heading -->
<h1 class="jadwal h3 mb-0 text-gray-800" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; text-align: center;"> Daftar Tata Usaha </h1></div>
<div class="tablewali">
<table  class="table text-center table-bordered  mt-4"style="width:900px ;" >
  <thead style="background-color: #748E63; color: #000;" >
    <tr>
      <th scope="col">No.</th>
      <th scope="col">NAMA</th>
      <th scope="col">NIP</th>
      <th scope="col">Jabatan</th>
      <td>Detail Profile</td>
      <td>Aksi</td>
      <!-- <th scope="col">AKSI</th> -->
    </tr>
  </thead>
  
  <tbody >
    <tr>
      <th scope="row">1</th>
      <td>Kairi hbvibrevbi</td>
      <td>214523748</td>
      <td>Tu satu</td>
      <td><a type="button"  href="/detailtu-superadminMU"  class="btn btn-warning">Lihat Detail</a></td>
      <td><a type="button" href="" class="btn btn-warning" ><i class="fa-solid fa-delete-left" style="color: #ffffff;"></i></a>
    </td>
      <!-- <td><a type="button" href="" class="btn btn-warning" ><i class="fa-solid fa-file-pen" style="color: #ffffff;"></i></a>
        <a type="button" href="" class="btn btn-warning" ><i class="fa-solid fa-delete-left" style="color: #ffffff;"></i></a>
    </td> -->
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Kiboy hbdiirrbiv </td>
      <td>214523748</td>
      <td>Tu dua</td>
      <td><a type="button"  href="/detailtu-superadminMU"  class="btn btn-warning">Lihat Detail</a></td>
      <td><a type="button" href="" class="btn btn-warning" ><i class="fa-solid fa-delete-left" style="color: #ffffff;"></i></a>
      </td>
      <!-- <td><a type="button" href="" class="btn btn-warning" ><i class="fa-solid fa-file-pen" style="color: #ffffff;"></i></a>
        <a type="button" href="" class="btn btn-warning" ><i class="fa-solid fa-delete-left" style="color: #ffffff;"></i></a></td> -->
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Calvin candrawinata</td>
      <td>214523748</td>
      <td>Tu tiga</td>
      <td><a type="button"  href="/detailtu-superadminMU"  class="btn btn-warning">Lihat Detail</a></td>
      <td><a type="button" href="" class="btn btn-warning" ><i class="fa-solid fa-delete-left" style="color: #ffffff;"></i></a>
      </td>
      <!-- <th scope="row"><a type="button" href="" class="btn btn-warning" ><i class="fa-solid fa-file-pen" style="color: #ffffff;"></i></a>
        <a type="button" href="" class="btn btn-warning" ><i class="fa-solid fa-delete-left" style="color: #ffffff;"></i></a></th> -->
    </tr>
  </tbody>
</table>
</div> 
@endsection