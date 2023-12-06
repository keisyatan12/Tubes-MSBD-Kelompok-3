@extends('layouts.main_superadmin')

@section('container')
<div class="edit text-sm-end"><a  href="{{('/superadmin/create_post')}}" class="btn btn-secondary mt-3 mb-3"><i class="fa-solid fa-file-pen" style="color: #ffffff;"></i> Tambah Mata Pelajaran</a></div>

<!-- Page Heading -->
<h1 class="jadwal h3 mb-0 text-gray-800" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; text-align: center;"> DAFTAR MATA PELAJARAN KELAS (XA) </h1></div>
<div class="tablewali">
<table  class="table text-center table-bordered  mt-4"style="width:900px ;" >
<thead style="background-color: #748E63; color: #000;" >
<tr>
<th scope="col">No.</th>
<th scope="col">KODE</th>
<th scope="col">MATA PELAJARAN</th>
<th scope="col">KKM</th>
<th scope="col">GURU</th>
<th scope="col">AKSI</th>
</tr>
</thead>

<tbody >
    
<tr>
    @foreach($mata_pelajarans as $post)
<td>{{$post->Kode_Mapel}}</td>
<td>{{$post->Nama_Mapel}}</td>
<td>{{$post->KKM}}</td>
<td>{{$post->Guru_Mapel}}</td>
<td><a type="button" href="" class="btn btn-warning" ><i class="fa-solid fa-delete-left" style="color: #ffffff;"></i></a>
@endforeach

</tr>

</tbody>
</table>
</div> 

@endsection