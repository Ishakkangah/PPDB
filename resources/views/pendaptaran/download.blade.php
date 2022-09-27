<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
.header{
  text-align: center;
  padding-bottom: 10px;
  border-bottom: 5px solid;
}
.mt-2{
  margin-top: 5px;
  margin-bottom: 50px;
  text-align:center;
}
.text-brow{
  color:dimgrey
}
</style>
</head>
<body>

  <div class="header">
    <h2>PANITIA PENERIMAAN PESERTA DIDIK BARU</h2>
    <H2>SMK NEGERI 1 KAYUAGUNG</H2>
    <p class="text-brow">Jalan Letnan Sayuti, Kelurahan Kotaraya, Kecamatan Kayuagung, Kabupaten Ogan Komering Ilir, Provinsi Sumatera Selatan, Indonesia 30617</p>
  </div>
  <div class="mt-2">
    <h3>DAFTAR CALON PESERTA DIDIK LOLOS SELEKSI TAHAP SELANJUTNYA</h3>
  </div>
<table>
  <tr>
    <th>#</th>
    <th>NAMA</th>
    <th>ASAL SEKOLAH</th>
    <th>JENIS KELAMIN</th>
  </tr>
  @foreach ($data as $index => $d)
  <tr>
      <td>{{ ++$index }}</td>
      <td>{{ $d->nama }}</td>
      <td>{{ $d->asal_sekolah }}</td>
      <td>{{ $d->jenis_kelamin }}</td>
  </tr>
  @endforeach
</table>

</body>
</html>


