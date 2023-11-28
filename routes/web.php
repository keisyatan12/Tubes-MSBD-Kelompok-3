<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\GuruController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('landingpage');
});

//login
Route::get('/login', function () {
    return view('login/loginpage');
});

Route::get('/forgot', function () {
    return view('login/forgotpassword');
});

//siswa
Route::get('/dashboardsiswa', function () {
    return view('siswa/dashboardsiswa');
});

Route::get('/jadwalsiswa', function () {
    return view('siswa/jadwalsiswa');
});

Route::get('/profilesiswa', function () {
    return view('siswa/profilelengkapsiswa');
});

Route::get('/editprofilesiswa', function () {
    return view('siswa/editprofilesiswa');
});


Route::get('/raporsiswa', function () {
    return view('siswa/raporsiswa');
});

//guru
/*
Route::get('/dashboardguru', function () {
    return view('guru/dashboardguru');
});
*/
Route::get('/dashboardguru', [GuruController::class, 'index']);

Route::get('/jadwalmengajarguru', function () {
    return view('guru/jadwalmengajarguru');
});

Route::get('/raporsiswaguru', function () {
    return view('guru/raporsiswaguru');
});

Route::get('/listsiswaguru', function () {
    return view('guru/listsiswaguru');
});

Route::get('/tambahnilaiguru', function () {
    return view('guru/tambahnilaiguru');
});

Route::get('/profilelengkapguru', function () {
    return view('guru/profilelengkapguru');
});

Route::get('/editprofileguru', function () {
    return view('guru/editprofileguru');
});

//admin
Route::get('/dashboardadmin', function () {
    return view('admin/dashboardadmin');
});

Route::get('/daftarkelassiswa-adminMU', function () {
    return view('admin/manajemenuser/daftarkelassiswa-adminMU');
});

Route::get('/tambahkelas-adminMU', function () {
    return view('admin/manajemenuser/tambahkelas-adminMU');
});

Route::get('/listsiswa-adminMU', function () {
    return view('admin/manajemenuser/listsiswa-adminMU');
});

Route::get('/tambahsiswa-adminMU', function () {
    return view('admin/manajemenuser/tambahsiswa-adminMU');
});

Route::get('/detailsiswa-adminMU', function () {
    return view('admin/manajemenuser/detailsiswa-adminMU');
});


Route::get('/daftarptk-adminMU', function () {
    return view('admin/manajemenuser/daftarptk-adminMU');
});

Route::get('/detailptk-adminMU', function () {
    return view('admin/manajemenuser/detailptk-adminMU');
});

Route::get('/daftartu-adminMU', function () {
    return view('admin/manajemenuser/daftartu-adminMU');
});

Route::get('/detailtu-adminMU', function () {
    return view('admin/manajemenuser/detailtu-adminMU');
});

Route::get('/listraporsiswa-admin', function () {
    return view('admin/listraporsiswa-admin');
});

Route::get('/raporsiswa-admin', function () {
    return view('admin/raporsiswa-admin');
});

Route::get('/editraporsiswa-admin', function () {
    return view('admin/editraporsiswa-admin');
});

Route::get('/daftarkelassiswa-adminJS', function () {
    return view('admin/daftarkelassiswa-adminJS');
});

Route::get('/jadwalsiswa-admin', function () {
    return view('admin/jadwalsiswa-admin');
});

Route::get('/daftarekskul-admin', function () {
    return view('admin/daftarekskul-admin');
});


Route::get('/tambahekskul-admin', function () {
    return view('admin/tambahekskul-admin');
});


Route::get('/daftarekskulsiswa-admin', function () {
    return view('admin/daftarekskulsiswa-admin');
});


Route::get('/audit-admin', function () {
    return view('admin/audit-admin');
});

Route::get('/audit-admin', function () {
    return view('admin/audit-admin');
});

Route::get('/log_aktivitas_admin', function () {
    return view('admin/log/log_aktivitas_admin');
});

Route::get('/log_guru_admin', function () {
    return view('admin/log/log_guru_admin');
});
Route::get('/log_permission_admin', function () {
    return view('admin/log/log_permission_admin');
});

Route::get('/log_profile_admin', function () {
    return view('admin/log/log_profile_admin');
});

Route::get('/log_role_admin', function () {
    return view('admin/log/log_role_admin');
});

Route::get('/log_user_admin', function () {
    return view('admin/log/log_user_admin');
});

Route::get('/profile-admin', function () {
    return view('admin/profile-admin');
});

Route::get('/editprofile-admin', function () {
    return view('admin/editprofile-admin');
});

//superadmin
Route::get('/dashboardsuperadmin', function () {
    return view('superadmin/dashboardsuperadmin');
});

Route::get('/daftarkelassiswa-superadminMU', function () {
    return view('superadmin/manajemenuser/daftarkelassiswa-superadminMU');
});

Route::get('/tambahkelas-superadminMU', function () {
    return view('superadmin/manajemenuser/tambahkelas-superadminMU');
});

Route::get('/listsiswa-superadminMU', function () {
    return view('superadmin/manajemenuser/listsiswa-superadminMU');
});

Route::get('/tambahsiswa-superadminMU', function () {
    return view('superadmin/manajemenuser/tambahsiswa-superadminMU');
});

Route::get('/detailsiswa-superadminMU', function () {
    return view('superadmin/manajemenuser/detailsiswa-superadminMU');
});


Route::get('/daftarptk-superadminMU', function () {
    return view('superadmin/manajemenuser/daftarptk-superadminMU');
});

Route::get('/tambahptk-superadminMU', function () {
    return view('superadmin/manajemenuser/tambahptk-superadminMU');
});


Route::get('/detailptk-superadminMU', function () {
    return view('superadmin/manajemenuser/detailptk-superadminMU');
});

Route::get('/daftartu-superadminMU', function () {
    return view('superadmin/manajemenuser/daftartu-superadminMU');
});

Route::get('/tambahtu-superadminMU', function () {
    return view('superadmin/manajemenuser/tambahtu-superadminMU');
});


Route::get('/detailtu-superadminMU', function () {
    return view('superadmin/manajemenuser/detailtu-superadminMU');
});

Route::get('/listraporsiswa-superadmin', function () {
    return view('superadmin/listraporsiswa-superadmin');
});

Route::get('/listsiswa-superadmin', function () {
    return view('superadmin/listsiswa-superadminNS');
});


Route::get('/editraporsiswa-superadmin', function () {
    return view('superadmin/editraporsiswa-superadmin');
});

Route::get('/daftarkelas-superadminMP', function () {
    return view('superadmin/daftarkelas-superadminMP');
});

Route::get('/daftarmapel-superadminMP', function () {
    return view('superadmin/daftarmapel-superadminMP');
});

Route::get('/tambahmapel-superadmin', function () {
    return view('superadmin/tambahmapel-superadmin');
});

Route::get('/daftarkelas-superadminJS', function () {
    return view('superadmin/daftarkelas-superadminJS');
});

Route::get('//jadwalsiswa-superadmin', function () {
    return view('superadmin/jadwalsiswa-superadmin');
});

Route::get('/daftarkelas-superadminVR', function () {
    return view('superadmin/daftarkelas-superadminVR');
});

Route::get('/listsiswa-superadminVR', function () {
    return view('superadmin//listsiswa-superadminVR');
});

Route::get('/raporsiswa-superadmin', function () {
    return view('superadmin/raporsiswa-superadmin');
});

Route::get('/daftarekskul-superadmin', function () {
    return view('superadmin/daftarekskul-superadmin');
});
Route::get('/tambahekskul-superadmin', function () {
    return view('superadmin/tambahekskul-superadmin');
});

Route::get('/daftarekskulsiswa-superadmin', function () {
    return view('superadmin/daftarekskulsiswa-superadmin');
});

Route::get('/audit-superadmin', function () {
    return view('superadmin/audit-superadmin');
});

Route::get('/log_aktivitas_superadmin', function () {
    return view('superadmin/log/log_aktivitas_superadmin');
});

Route::get('/log_guru_superadmin', function () {
    return view('superadmin/log/log_guru_superadmin');
});

Route::get('/log_permission_superadmin', function () {
    return view('superadmin/log/log_permission_superadmin');
});

Route::get('/log_profile_superadmin', function () {
    return view('superadmin/log/log_profile_superadmin');
});

Route::get('/log_role_superadmin', function () {
    return view('superadmin/log/log_role_superadmin');
});

Route::get('/log_user_superadmin', function () {
    return view('superadmin/log/log_user_superadmin');
});

Route::get('/profile-superadmin', function () {
    return view('superadmin/profile-superadmin');
});

Route::get('/editprofile-superadmin', function () {
    return view('superadmin/editprofile-superadmin');
});

