<?php

use App\Http\Controllers\PendaptaranController;
use App\Http\Middleware\adminCheck;
use App\Models\pendaptaran;
use Illuminate\Support\Facades\Route;



Route::prefix('app')->middleware(adminCheck::class)->group(function(){
    Route::post('uploadPhotoProfile', [PendaptaranController::class, 'uploadPhotoProfil']);
    Route::post('deleteImage', [PendaptaranController::class, 'deleteImage']);
    Route::post('uploadIjazah', [PendaptaranController::class, 'uploadIjazah']);
    Route::post('deleteIjazah', [PendaptaranController::class, 'deleteIjazah']);
    Route::post('uploadKartuKeluarga', [PendaptaranController::class, 'uploadKartuKeluarga']);
    Route::post('deleteKartuKeluarga', [PendaptaranController::class, 'deleteKartuKeluarga']);
    Route::post('uploadAktaKelahiran', [PendaptaranController::class, 'uploadAktaKelahiran']);
    Route::post('deleteAktaKelahiran', [PendaptaranController::class, 'deleteAktaKelahiran']);
    
    Route::post('addBiodata', [PendaptaranController::class, 'addBiodata']);
    Route::get('getCalonSiswa', [PendaptaranController::class, 'getCalonSiswa']);
    Route::get('detailCalonSiswa/{id}', [PendaptaranController::class, 'detailCalonSiswa']);
    Route::post('terimaCalonSiswa/{id}', [PendaptaranController::class, 'terimaCalonSiswa']);
    Route::post('batalkanCalonSiswa/{id}', [PendaptaranController::class, 'batalkanCalonSiswa']);
    Route::delete('hapusCalonSiswa/{id}', [PendaptaranController::class, 'hapusCalonSiswa']);
    Route::get('cariCalonSiswa', [PendaptaranController::class, 'cariCalonSiswa']);
    Route::get('getFile', [PendaptaranController::class, 'getFile']);
    
    // data wali
    Route::post('addDataWali', [PendaptaranController::class, 'addDataWali']);
    Route::post('simpanPengaturan', [PendaptaranController::class, 'simpanPengaturan']);
    Route::get('tampilkanTanggalPengaturan', [PendaptaranController::class, 'tampilkanTanggalPengaturan']);
    
    // roles
    Route::get('tampilkanAturan', [PendaptaranController::class, 'tampilkanAturan']);
    Route::get('tampilkanAturanUntukPengaturan', [PendaptaranController::class, 'tampilkanAturanUntukPengaturan']);
    Route::post('tambahAturan', [PendaptaranController::class, 'tambahAturan']);
    Route::post('editAturan', [PendaptaranController::class, 'editAturan']);
    Route::delete('deleteAturan', [PendaptaranController::class, 'deleteAturan']);
    Route::post('assignRole', [PendaptaranController::class, 'assignRole']);
    
    // admin
    Route::post('tambahAdminBaru', [PendaptaranController::class, 'tambahAdminBaru']);
    Route::get('tampilkanAdmin', [PendaptaranController::class, 'tampilkanAdmin']);
    Route::delete('deleteAdmin', [PendaptaranController::class, 'deleteAdmin']);
    Route::post('editAdmin', [PendaptaranController::class, 'editAdmin']);
    
    // download excell
    Route::get('downloadExcell', [PendaptaranController::class, 'donwloadLaporanExcel']);
    Route::get('downloadPDF', [PendaptaranController::class, 'downloadPDF']);
    Route::get('lihat_laporan_pdf', [PendaptaranController::class, 'lihat_laporan_pdf']);
    Route::post('login', [PendaptaranController::class, 'login']);

    // Blog
    Route::get('tampilSemuaDataBlog', [PendaptaranController::class, 'tampilSemuaDataBlog']);
    Route::post('tambahPostinganBaru', [PendaptaranController::class, 'tambahPostinganBaru']);
    Route::get('tampilDataBerdasarkanId/{id}', [PendaptaranController::class, 'tampilDataBerdasarkanId']);
    Route::post('editPostingan/{id}', [PendaptaranController::class, 'editPostingan']);
    Route::delete('deleteBlog', [PendaptaranController::class, 'deleteBlog']);
    Route::get('getBlogBerdasarkanId/{id}', [PendaptaranController::class, 'getBlogBerdasarkanId']);

    // Tags
    Route::get('tampilSemuaDataTag', [PendaptaranController::class, 'tampilSemuaDataTag']);
    Route::post('tambahTagBaru', [PendaptaranController::class, 'tambahTagBaru']);
    Route::delete('deleteTag', [PendaptaranController::class, 'deleteTag']);
    Route::post('editTag', [PendaptaranController::class, 'editTag']);

    // Kategori
    Route::get('tampilSemuaDataKategori', [PendaptaranController::class, 'tampilSemuaDataKategori']);
    Route::post('tambahKategoriBaru', [PendaptaranController::class, 'tambahKategoriBaru']);
    Route::delete('deleteKategori', [PendaptaranController::class, 'deleteKategori']);
    Route::post('editKategori', [PendaptaranController::class, 'editKategori']);
});

// upload image blog
Route::post('create_blog', [PendaptaranController::class, 'create_blog']);



Route::get('/', [PendaptaranController::class, 'index']);
Route::get('/logout', [PendaptaranController::class, 'logout']);
Route::any('{slug}', [PendaptaranController::class, 'index'])->where('slug', '.*');
    
