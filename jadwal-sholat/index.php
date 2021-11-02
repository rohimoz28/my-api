<?php require '../layout/header.php' ?>
<?php
$tahun = date('Y');
$bulan = date('m') . '.json';
$hari = date('d');
$namaKota = $_POST['kota'];

$url = 'https://cdn.statically.io/gh/lakuapik/jadwalsholatorg/master/adzan/tangerang/2021/10.json';
$urlArray = (explode("/", $url));
$urlArray[9] = $tahun;
$urlArray[10] = $bulan;

$urlNow = implode('/', $urlArray);
/* $rootPath = basename('/srv/http/rest-api/my-api'); */
/* var_dump($rootPath); */
/* die; */
function searchKota($namaKota)
{
  global $urlNow;

  $str = $urlNow;
  $url = (explode("/", $str));

  // Ganti nama kota sesuai query pencarian
  array_splice($url, 8, 0);
  $url[8] = $namaKota;
  $result = implode('/', $url);

  /* echo $result; */
  return $result;
}


// CARI NAMA KOTA
$urlKota = 'https://raw.githubusercontent.com/lakuapik/jadwalsholatorg/master/kota.json';
$getKota = file_get_contents($urlKota);
$dataKota = json_decode($getKota);


if (isset($_POST['search'])) {
  $urlJadwalSholat = searchKota($namaKota);
  $getJadwalSholat = file_get_contents($urlJadwalSholat);
  $data = json_decode($getJadwalSholat, 1);
} else {
  // CARI JADWAL SHOLAT
  global $urlNow;
  $urlJadwalSholat = $urlNow;
  $getJadwalSholat = file_get_contents($urlJadwalSholat);
  $data = json_decode($getJadwalSholat, 1);
}

/* var_dump($dataKota); */
/* die; */

?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="text-center">Jadwal Sholat</h1>
    <form class="form-inline justify-content-center" method="POST" action="">
      <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Pilih Kota</label>
      <select class="custom-select my-1 mr-sm-2" name="kota" id="inlineFormCustomSelectPref">
        <option selected>Default - Tangerang</option>
        <?php foreach ($dataKota as $kota) : ?>
          <option value="<?= $kota ?>"><?= $kota ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit" class="btn btn-primary my-1" name="search">Cari</button>
    </form>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="row justify-content-center">
      <table class="table table-sm table-bordered">
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">Tgl</th>
            <th scope="col">Imsyak</th>
            <th scope="col">Subuh</th>
            <th scope="col">Terbit</th>
            <th scope="col">Dhuha</th>
            <th scope="col">Dzuhur</th>
            <th scope="col">Ashar</th>
            <th scope="col">Maghrib</th>
            <th scope="col">Isya</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 ?>
          <?php foreach ($data as $res) : ?>
            <?php if ($hari == $i) : ?>
              <tr class="table-primary">
              <?php else : ?>
              <tr>
              <?php endif; ?>
              <th scope="row"><?= $i ?></th>
              <td><?= $res['imsyak']  ?></td>
              <td><?= $res['shubuh']  ?></td>
              <td><?= $res['terbit']  ?></td>
              <td><?= $res['dhuha']  ?></td>
              <td><?= $res['dzuhur']  ?></td>
              <td><?= $res['ashr']  ?></td>
              <td><?= $res['magrib']  ?></td>
              <td><?= $res['isya']  ?></td>
              </tr>
              <?php $i++ ?>
            <?php endforeach ?>
        </tbody>
      </table>

    </div>
  </div>
  <?php require '../layout/footer.php' ?>
