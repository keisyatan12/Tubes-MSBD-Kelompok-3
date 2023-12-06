@extends('layouts.main_superadmin')

@section('container')
                  <!-- Page Heading -->
                  <h1 class="jadwal h3 mb-0 text-gray-800" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; text-align: center;"> TAMBAH MATA PELAJARAN</h1></div>
                  <br>
                  <div class="tablewali">
                     <form action="{{__('/superadmin/store_post')}}" method="post" enctype="multipart/form-data">  
                         
                         <div class="form-group">
                             <label for="Kode_Mapel">Kode:</label>
                             <input type="text" class="form-control @error('Kode_Mapel') is-invalid @enderror" id="Kode_Mapel" name="Kode_Mapel">
                             @error('Kode_Mapel')
                             <div class="text-danger">{{$message}}</div>
                             @enderror
                         </div>
                         <div class="form-group">
                             <label for="Nama_Mapel">Mapel:</label>
                             <input type="text" class="form-control @error('Nama_Mapel') is-invalid @enderror" id="Nama_Mapel" name="Nama_Mapel">
                             @error('Nama_Mapel')
                             <div class="text-danger">{{$message}}</div>
                             @enderror
                         </div>
                         <div class="form-group">
                             <label for="KKM">KKM:</label>
                             <input type="text" class="form-control @error('KKM') is-invalid @enderror" id="KKM" name="KKM">
                             @error('KKM')
                             <div class="text-danger">{{$message}}</div>
                             @enderror
                         </div>
                         <div class="form-group">
                             <label for="Guru_Mapel">Guru:</label>
                             <input type="text" class="form-control @error('Guru_Mapel') is-invalid @enderror" id="guru" name="guru">
                             @error('guru')
                             <div class="text-danger">{{$message}}</div>
                             @enderror
                         </div>
                         <button type="submit" class="btn btn-warning">Tambah Mapel</button>
                         
                         </div>
                     </form>
                 </div> 
                                 </div>
                                 <!-- container-fluid -->    
                                 
                                  </div>
                                 <!-- <button type="button" class="btn btn-secondary mt-3 mb-3" >Print Jadwal</button> -->
                                                     </div>           
                                   
                                              </div>
                                          </div>
@endsection