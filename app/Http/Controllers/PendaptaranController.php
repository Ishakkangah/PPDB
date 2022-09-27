<?php

namespace App\Http\Controllers;
use App\Exports\PendaptaranExport;
use App\Models\{blog, categori, file, nilai, pendaptaran, pengaturan, role, User, datawali, tag};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use PhpParser\Node\Stmt\TryCatch;

class PendaptaranController extends Controller
{
    // index
    public function index(Request $request){
        return view('index');
        // Jika belum login && request url selain login
        // tendang ke login
        if(!Auth::check() && $request->path() !== 'login'){
            return redirect('/login');
        }

        // // Jika belum login && request url login
        // // tendang ke index.blade.php
        if(!Auth::check() && $request->path() === 'login'){
            return view('index');
        }
        
        // // // Jika sudah login && userType sama dengan User
        // // // tendang ke login 
        $user = Auth::user();
        if($user->role->isAdmin === 0){
            Auth::logout();
            return redirect('/login');
        }

        // // Jika sudah login && request login sama dengan login
        // // tendang ke route "/"
        if(Auth::check() && $request->path() ==='login'){
            return redirect('/');
        }

        return $this->checkPermissions($user, $request);

    }

    // check permission
    public function checkPermissions($user, $request){
        // ambil permission dari user yang login
        $permissions = json_decode($user->role->permissions);
        $hasPermissions = false;
        return view('index');
        // looping data array permissions
        foreach($permissions as $p){
            // jika permission->name === request url &
            if($p->name === $request->path()){
                // jika permission->lihat nya ada / true
                if($p->lihat){
                    // isi variable $hasPermission menjadi true
                    $hasPermissions = true;
                }
            }
            // jika variable $hasPermissions true lempar ke view index.blade.php 
            if($hasPermissions){
                return view('index');
            } 
            return view('notfound');
        }
        return view('index');
    }
    // upload photo calon siswa
    public function uploadPhotoProfil(Request $request){
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        $poto_profil = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploadProfile'), $poto_profil);
        return $poto_profil;
    }
    // hapus upload photo
     public function deleteImage(Request $request){
        $fictName = $request->photo;
        $pathName = public_path('/uploadProfile/').$fictName;
        if(file_exists($pathName)){
            @unlink($pathName);
        }
        return 'done';
    }
    // upload ijazah calon siswa
    public function uploadIjazah(Request $request){
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        $ijazah = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploadIjazah'), $ijazah);
        return $ijazah;
    }
    // hapus ijazah siswa
     public function deleteIjazah(Request $request){
        $fictName = $request->ijazah;
        $pathName = public_path('/uploadIjazah/').$fictName;
        if(file_exists($pathName)){
            @unlink($pathName);
        }
        return 'done';
    }
    // upload kartu keluarga calon siswa
    public function uploadKartuKeluarga(Request $request){
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        $Kartu_Keluarga = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploadKartuKeluarga'), $Kartu_Keluarga);
        return $Kartu_Keluarga;
    }
    // hapus kartu keluarga siswa
     public function deleteKartuKeluarga(Request $request){
        $fictName = $request->Kartu_Keluarga;
        $pathName = public_path('/uploadKartuKeluarga/').$fictName;
        if(file_exists($pathName)){
            @unlink($pathName);
        }
        return 'done';
    }
    // upload akta kelahiran calon siswa
    public function uploadAktaKelahiran(Request $request){
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        $akta_kelahiran = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploadAktaKelahiran'), $akta_kelahiran);
        return $akta_kelahiran;        
    }
    // hapus akta kelahiran siswa
    public function deleteAktaKelahiran(Request $request){
        $fictName = $request->Akta_Kelahiran;
        $pathName = public_path('/uploadAktaKelahiran/').$fictName;
        if(file_exists($pathName)){
            @unlink($pathName);
        }
        return 'done';
    }
    // add biodata
    public function addBiodata(Request $request){
       $request->validate([
            'nama'  => 'required|string|max:100',
            'asal_sekolah'  => 'required|string|max:100',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string|max:200',
            'nisn' => 'required|numeric',
            'b_indonesia' => 'required|numeric',
            'matematika'  => 'required|numeric',
            'b_inggris' => 'required|numeric',
            'ipa' => 'required|numeric',
            'photo' => 'required',
            'akta_kelahiran' => 'required',
            'kartu_keluarga' => 'required',
            'ijazah' => 'required',
        ]);
        DB::beginTransaction();

        $pengaturan = pengaturan::where('id', 1)->first();
        $batas_pendaptaran = date('d-M-y', strtotime($pengaturan->batas_pendaptaran));
        $tanggal_pendaptaran = date('d-M-y', strtotime(Now('Asia/Jakarta'))); 
        $tahun_lahir_pendaptar = date('Y', strtotime($request->tanggal_lahir));
        $batas_umur_pendaptar = date('Y', strtotime($pengaturan->batas_umur));
        $jumlah_nilai_pendaptar = $request->b_indonesia + $request->b_inggris + $request->matematika + $request->ipa;
        
        if($tanggal_pendaptaran > $batas_pendaptaran){
            return response()->json([
                'msg' => 'Waktu pendaptaran telah habis'
            ], 502);
        } else {
            if($tahun_lahir_pendaptar >= $batas_umur_pendaptar){
                try {
                    $nilai = nilai::create([
                        'nisn' => $request->nisn,
                        'b_indonesia' => $request->b_indonesia,
                        'b_inggris' => $request->b_inggris,
                        'matematika' => $request->matematika,
                        'ipa' => $request->ipa,
                        'jumlah' => $jumlah_nilai_pendaptar,
                    ]);
        
                    $photo = '/uploadProfile/' .  $request->photo;
                    $kk = '/uploadKartuKeluarga/' .$request->kartu_keluarga;
                    $ak = '/uploadAktaKelahiran/' . $request->akta_kelahiran;
                    $ijazah = '/uploadIjazah/' . $request->ijazah;
                    $nilai_rapot = $jumlah_nilai_pendaptar / 4;
                    
                    $berkas = file::create([
                        'photo' => $photo,
                        'kartu_keluarga' => $kk,
                        'akta_kelahiran' => $ak,
                        'ijazah' => $ijazah,
                        'nilai_rapot' => (int) $nilai_rapot,
                    ]);
        
                    pendaptaran::create([
                        'user_id' => Auth::user()->id,
                        'nama' => $request->nama,
                        'asal_sekolah' => $request->asal_sekolah,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'agama' => $request->agama,
                        'alamat' => $request->alamat,
                        'file_id' => $berkas->id,
                        'nilai_id' => $nilai->id,
                    ]);
                    DB::commit();
                    return 'Pendaptaran berhasil';    
                } catch (\Throwable $e) {
                    DB::rollBack();
                    return 'Pendaptaran gagal' .  $e;
                }
            } else {
                return response()->json([
                    'msg' => 'Umur tidak memenuhi syarat!',
                ], 502);
            }
        }
    }
    // add data wali
    public function addDataWali(Request $request){
        $request->validate([
            'nama_ayah' => 'required|string|max:100',
            'tanggal_lahir_ayah' => 'required|date',
            'perkerjaan_ayah' => 'required|string|max:100',
            'nomor_ktp_ayah' => 'nullable|numeric',
            'agama_ayah' => 'required|string|max:100',
            'alamat_ayah' => 'required|string|max:100',
            'pendidikan_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'tanggal_lahir_ibu' => 'required|date',
            'perkerjaan_ibu' => 'required|string|max:100',
            'nomor_ktp_ibu' => 'nullable|numeric',
            'agama_ibu' => 'required|string|max:100',
            'alamat_ibu' => 'required|string|max:100',
            'pendidikan_ibu' => 'required|string|max:100',
        ]);
            datawali::create([
                'user_id' => 1,
                'nama_ayah' => $request->nama_ayah,
                'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
                'perkerjaan_ayah' => $request->perkerjaan_ayah,
                'nomor_ktp_ayah' => $request->nomor_ktp_ayah,
                'agama_ayah' => $request->agama_ayah,
                'alamat_ayah' => $request->alamat_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
                'perkerjaan_ibu' => $request->perkerjaan_ibu,
                'nomor_ktp_ibu' => $request->nomor_ktp_ibu,
                'agama_ibu' => $request->agama_ibu,
                'alamat_ibu' => $request->alamat_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu
            ]);
    }
    // get data calon siswa
    public function getCalonSiswa(Request $request){
        $pendaptarans = pendaptaran::orderBy('created_at', 'DESC')->paginate($request->total);
        foreach ($pendaptarans as $pendaptaran) {
            $pendaptaran['tanggal_lahir'] = date('d-M-Y', strtotime($pendaptaran->tanggal_lahir));
        }
        return $pendaptarans;
    }
    // get detail calon siswa
    public function detailCalonSiswa(Request $request, $id){
        $pendaptar = pendaptaran::where('id', $id);
        return $pendaptar->first();
    }
    // set status calon siswa
    public function terimaCalonSiswa(Request $request, $id){
        $pendaptaran = pendaptaran::where('id', $id)->first();
        $pendaptaran->update([
            'status' => 1
        ]);
        return $pendaptaran;
    }
    // set batalkan calon siswa
    public function batalkanCalonSiswa(Request $request, $id){
        $pendaptaran = pendaptaran::where('id', $id)->first();
        $pendaptaran->update([
            'status' => 0
        ]);
        return $pendaptaran;
    }
    // get file
    public function getFile(){
        return file::get();
    }
    // set hapus calon siswa
    public function hapusCalonSiswa(Request $request, $id){
        $calonSiswa = pendaptaran::with(['file'])->where('id', $id)->first();
        $calonSiswa->file->delete();
        $calonSiswa->delete();

        return 'berhasil di hapus';
    }
    // set cari calon siswa
    public function cariCalonSiswa(Request $request){
        $search = $request->q;
        return pendaptaran::where('nama', 'LIKE',  "%{$search}%")
        ->orWhere('asal_sekolah', 'LIKE', "%{$search}%")
        ->orWhere('alamat', 'LIKE', "%{$search}%")->get();
    }
    // pengaturan
    public function simpanPengaturan(Request $request){
        $request->validate([
            'batas_pendaptaran' => 'required|date',
            'batas_umur' => 'required|date',
        ]);
        
        $pengaturan = pengaturan::where('id' , 1)->first();
        return $pengaturan->update([
            'batas_pendaptaran' => $request->batas_pendaptaran,
            'batas_umur' => $request->batas_umur,
        ]);
    }
    // get pengaturan
    public function tampilkanTanggalPengaturan(){
        return pengaturan::where('id', 1)->first(['batas_umur', 'batas_pendaptaran']);
    }
    // get aturan / roles
    public function tampilkanAturan(Request $request){
        return role::orderBy('id', 'DESC')->paginate($request->total);
    }
    // get aturan / roles untuk pengaturan
    public function tampilkanAturanUntukPengaturan(){
        return role::orderBy('id', 'DESC')->get();
    }
    // tambah aturan baru
    public function tambahAturan(Request $request){
        $request->validate([
            'nama_aturan' => 'required|string|max:20'
        ]);

        return role::create([
            'isAdmin' => 1,
            'roleName' => $request->nama_aturan,
        ]);
    }
    // edit aturan baru
    public function editAturan(Request $request){
        $request->validate([
            'nama_aturan' => 'required|string|max:20'
        ]);

        $aturan = role::where('id', $request->id)->first();
        return $aturan->update([
            'roleName' => $request->nama_aturan,
        ]);
    }
    // delete aturan / role
    public function deleteAturan(Request $request){
        return role::where('id', $request->id)->delete();
    }
    // assignRole / edit role khusus
    public function assignRole(Request $request){
        $request->validate([
            'id' => 'required|numeric',
            'permissions' => 'required'
        ]);
        try {
            $role = role::where('id', $request->id)->first();
            $role->update([
                'permissions' => $request->permissions
            ]);
            return $role;
        } catch (\Throwable $e) {
            return 'Fails ' . $e->errorInfo;
        }
    }
    // tambah admin baru
    public function tambahAdminBaru(Request $request){
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|max:30|min:5',
            'role_id' => 'required|numeric',
        ]);

        try {
            return User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => bcrypt($request->password)
            ]);
        } catch (\Throwable $e) {
            return 'Gagal ' . $e;
        }
    }

    // tampilkan seluruh admin
    public function tampilkanAdmin(){
        $users = User::whereHas('role', function($q){
            $q->where('isAdmin', 1);
        })->orderBy('role_id', 'Desc')->get();
        return $users;
    }
    // delete admin yang tidak terpakai
    public function deleteAdmin(Request $request){
        if($request->test){
            return User::where('id', $request->id)->delete();
        } else{
            return User::where('role_id', $request->id)->delete();
        }
    }
    // edit admin
    public function editAdmin(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'role_id' => 'required|numeric',
        ]);

        $admin = User::where('id', $request->id)->first();
        try {
            return $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id
            ]);       
        } catch (\Throwable $e) {
            return 'Gagal ' . $e;
        }
    }
    // download excell
    public function donwloadLaporanExcel(){
        return Excel::download(new PendaptaranExport, 'pendaptaran.xlsx');
    }
    // download PDF
    public function downloadPDF(){
        $data = pendaptaran::where('status', 1)->orderBy('asal_sekolah', 'DESC')->get(['id', 'nama', 'asal_sekolah', 'jenis_kelamin']);; 
        view()->share('data', $data);
        $pdf = PDF::loadView('pendaptaran.download');
        return $pdf->download('pendaptaran.pdf');
    }
    // lihat_laporan_pdf
    public function lihat_laporan_pdf(){
        return pendaptaran::where('status', 1)->orderBy('asal_sekolah', 'DESC')->get(['id', 'nama', 'asal_sekolah', 'jenis_kelamin']);; 
    }
    // login
    public function login(Request $request){
        $request->validate([
            'email' => 'bail|required|string',
            'password' => 'bail|required|string'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            if($user->role->isAdmin === 0){
                return response()->json([
                    'msg' => 'Incorect logging details'
                ], 401); 
            }
            return response()->json([
                'msg' => 'Anda sekarang  login',
                'user' => $user
            ]);
        }
        else {
            return response()->json(['msg' => 'Incorect logging details'], 401);
        }   
    }
    // logout
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    // Tampil semua data Blog
    public function tampilSemuaDataBlog(){
        return blog::with(['tags', 'categoris'])->orderBy('created_at', 'DESC')->get(['id', 'title']);
    }
    // tambah postingan baru
    public function tambahPostinganBaru(Request $request){
        $request->validate([
            'title' => "required",
            'post' => "required",
            'post_excerpt' => "required",
            'kategori_id' => "required",
            'tag_id' => "required",
            'metaDescription' => "required",
            'jsonData' => "required",
        ]);

            DB::beginTransaction();
            try {
                $blog = blog::create([
                    'title' => $request->title,
                    'slug' => $request->title,
                    'post' => $request->post,
                    'post_excerpt' => $request->post_excerpt,
                    'user_id' => Auth::user()->id,
                    'metaDescription' => $request->metaDescription,
                    'jsonData' => $request->jsonData,
                ]);
    
                // masukan relasi blog kategori
                $blog->categoris()->attach($request->kategori_id);
                // masukan relasi blog->tag
                $blog->tags()->attach($request->tag_id);
                DB::commit();
                return 'Post berhasil di simpan.';
            } catch (\Throwable $th) {
                DB::rollback();
                return 'Post tidak berhasil di simpan';
            }
    }
    // edit postingan 
    public function editPostingan(Request $request, $id){
        $request->validate([
            'title' => "required",
            'post' => "required",
            'post_excerpt' => "required",
            'kategori_id' => "required",
            'tag_id' => "required",
            'metaDescription' => "required",
            'jsonData' => "required",
        ]);

            DB::beginTransaction();
            try {
                $blog = blog::where('id', $id)->first();
                $blog->update([
                    'title' => $request->title,
                    'slug' => $request->title,
                    'post' => $request->post,
                    'post_excerpt' => $request->post_excerpt,
                    'user_id' => Auth::user()->id,
                    'metaDescription' => $request->metaDescription,
                    'jsonData' => $request->jsonData,
                ]);
    
                // masukan relasi blog kategori
                $blog->categoris()->sync($request->kategori_id);
                // masukan relasi blog->tag
                $blog->tags()->sync($request->tag_id);
                DB::commit();
                return 'Post berhasil di simpan.';
            } catch (\Throwable $th) {
                DB::rollback();
                return 'Post tidak berhasil di simpan';
            }
    }
    // delete Blog
    public function deleteBlog(Request $request){
        $blog = blog::where('id', $request->id)->first();
        $blog->delete();
        return 'berhasil';
    }
    // tampil detail Blog Berdasarkan Id
    public function getBlogBerdasarkanId(Request $request, $id){
        return blog::with(['tags', 'categoris'])->where('id', $id)->first();
    }
    // tampil Data Blog Berdasarkan Id
    public function tampilDataBerdasarkanId(Request $request, $id){
        return blog::with(['tags', 'categoris'])->where('id', $id)->first();
    }
    // Tampil semua tag
    public function tampilSemuaDataTag(Request $request){
        return tag::orderBy('created_at', 'DESC')->paginate($request->total);
    }
    // tambah tag baru
    public function tambahTagBaru(Request  $request){
        $request->validate([
            'tagName' => 'required|string|max:40',
        ]);

        try {
            return tag::create([
                'tagName' => $request->tagName,
            ]);
        } catch (\Throwable $e) {
            return 'gagal menambah tag ' . $e;
        }
    }
    // hapus tag
    public function deleteTag(Request $request){
        return tag::where('id', $request->id)->delete();
    }
    // edit tag
    public function editTag(Request $request){
        $request->validate([
            'tagName' => 'required|string|max:40'
        ]);

        try {
            $tag = tag::where('id', $request->id)->first();
            $tag->update([
                'tagName' => $request->tagName
            ]);
        } catch (\Throwable $e) {
            return 'gagal update tag ' . $e;
        }
    }
    // Tampil semua kategori
    public function tampilSemuaDataKategori(Request $request){
        return categori::orderBy('created_at', 'DESC')->paginate($request->total);
    } 
     // tambah kategori baru
     public function tambahKategoriBaru(Request  $request){
        $request->validate([
            'categoryName' => 'required|string|max:40',
        ]);

        try {
            return categori::create([
                'categoryName' => $request->categoryName,
            ]);
        } catch (\Throwable $e) {
            return 'gagal menambah kategori ' . $e;
        }
    }
    // hapus kategori
    public function deleteKategori(Request $request){
        return categori::where('id', $request->id)->delete();
    }
    // edit kategori
    public function editKategori(Request $request){
        $request->validate([
            'categoryName' => 'required|string|max:40'
        ]);

        try {
            $categori = categori::where('id', $request->id)->first();
            return $categori->update([
                'categoryName' => $request->categoryName
            ]);
        } catch (\Throwable $e) {
            return 'gagal update kategori ' . $e;
        }
    }
    // upload image blog
    public function create_blog(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);
        $thumbnail = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploadImageBlog'), $thumbnail);
        return response()->json([
            "success" => 1,
            "file" => [
                "url" => "http://tugasakhirku.localhost/uploadImageBlog/$thumbnail",
            ]
        ]);
        return $thumbnail;

    }
}









