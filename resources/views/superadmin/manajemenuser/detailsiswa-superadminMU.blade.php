@extends('layouts.main_superadmin')

@section('container')

    <!-- Page Heading -->
    <div class="isi ">
        <h1 class="jadwal h3 mb-0 text-gray-800" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; text-align: center;"> PROFILE &nbsp;  LENGKAP</h1></div>
                                
        <div class="informasi py-3 px-3">
          
            <table class="table  mt-4">
              <tr>
            
                <th scope="col">NISN</th>
                <th scope="col">NIPD</th>
                <th scope="col">Nama_Siswa</th>
                <th scope="col">Jenis_Kelamin</th>
                <th scope="col">Tempat_Lahir</th>
                <th scope="col">Tanggal_Lahir</th>
                <th scope="col">Agama</th>
                <th scope="col">Alamat</th>
                <th scope="col">No_hp</th>
                <th scope="col">Status dlm Keluarga</th>
                <th scope="col">Nama_Ayah</th>
                <th scope="col">Nama_Ibu</th>
                <th scope="col">Pekerjaan_Ayah</th>
                <th scope="col">Pekerjaan_Ibu</th>
                <th scope="col">No_Rek_Bank</th>
                <th scope="col">Bank_Atas_Nama</th>
                <th scope="col">Status_Siswa</th>
                <th scope="col">Sekolah_Asal</th>
                <th scope="col">Anak_Ke</th>
            </tr>
            </thead>
            
            <tbody >
                <tr>
                    @foreach($siswa as $listsiswa)
                    <td>{{ $listsiswa->NISN }}</td>
                    <td>{{ $listsiswa->NIPD }}</td>
                    <td>{{ $listsiswa->Nama_Siswa }}</td>
                    <td>{{ $listsiswa->Jenis_Kelamin }}</td>
                    <td>{{ $listsiswa->Tempat_Lahir }}</td>
                    <td>{{ $listsiswa->Tanggal_Lahir }}</td>
                    <td>{{ $listsiswa->Agama }}</td>
                    <td>{{ $listsiswa->Alamat }}</td>
                    <td>{{ $listsiswa->No_hp }}</td>
                    <td>{{ $listsiswa->Status_dlm_Klrg }}</td>
                    <td>{{ $listsiswa->Nama_Ayah }}</td>
                    <td>{{ $listsiswa->Nama_Ibu }}</td>
                    <td>{{ $listsiswa->Pekerjaan_Ayah }}</td>
                    <td>{{ $listsiswa->Pekerjaan_Ibu }}</td>
                    <td>{{ $listsiswa->No_Rek_Bank }}</td>
                    <td>{{ $listsiswa->Bank_Atas_Nama }}</td>
                    <td>{{ $listsiswa->Status_Siswa }}</td>
                    <td>{{ $listsiswa->Sekolah_Asal }}</td>
                </tr>
                @endforeach
      
      
            
                  
      
        </table>
        </div>
        <!-- <button type="button" class="btn btn-secondary mt-3 mb-3" >Print Jadwal</button> -->
                            </div>     
@endsection