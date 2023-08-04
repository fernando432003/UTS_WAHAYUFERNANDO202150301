  <?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "pendaftaran";

$koneksi = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){ // cek koneksi
    die("tidak terkoneksi ke database");
}
$tanggal ="";
$bulan ="";
$tahun = "";
$sukses = "";
$error = "";

if(isset($_GET['op'])){
  $op = $_GET['op'];
}else{
  $op = "";

  if($op == 'edit'){
    $id = $_GET['id'];
    $sql1 = "select * from tahun where id = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1 = mysqli_fetch_array($q1);
    $tanggal = $r1['tanggal'];
    $bulan = $r1['bulan'];
    $tahun = $r1['tahun'];

    if($tanggal == ''){
      $error = "data tidak di temukan";
    }
  }
}
if(isset($_post['simpan'])){
  $tanggal = $_POST['tanggal'];
  $bulan = $_POST['bulan'];
  $tahun = $_POST['tahun'];

  if($tanggal && $bulan && $tahun){
    $sql1 = "insert into tahun (tanggal,bulan,tahun) values('$tanggal,$bulan,$tahun')";
    $q1 = mysqli_query($koneksi,$sql1);
    if($q1){
      $sukses = "berhasil memasukan data baru";
    }else{
      $error = "gagal memasukan data";
    }
  }else{
    $error = "silahkan masukan semua data";
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>pendaftaran siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <style>
    .mx-auto{width: 800px}
  </style>
  </head>
  <body>
   <div class= "mx-auto">
    <div class="card">
      <div class="card-header">
        Create / Edit Data
      </div>
      <div class="card-body">
        <?php
        if ($error) {
        ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $error ?>
        </div>
        <?php
        }
        ?>
        <?php
        if ($sukses) {
        ?>
        <div class="alert alert-success" role="alert">
          <?php echo $sukses ?>
        </div>
        <?php
        }
        ?>
        <form action="" method="post">
          <div clas="mb-3 row">
            <label for="Tanggal" class="col-sm-2 col-form-label">TANGGAL</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"id="tanggal" name="tanggal"  value="<?php echo $tanggal ?>">
            </div>
          </div>
          <div clas="mb-3 row">
            <label for="bulan" class="col-sm-2 col-form-label">BULAN</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"id="bulan" name="bulan"  value="<?php echo $bulan ?>">
            </div>
          </div>
          <div clas="mb-3 row">
            <label for="Tahun" class="col-sm-2 col-form-label">TAHUN</label>
            <div class="col-sm-10">
              <select class="form-control" name="tahun" id="tahun">
                <option value="">-pilih tahun-</option>
                <option value="2023"<?php if($tahun == "2023") echo "selected"?>>2023</option>
                <option value="2024"<?php if($tahun == "2024") echo "selected"?>>2024</option>
                <option value="2025"<?php if($tahun == "2025") echo "selected"?>>2025</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <input type="submit" nama="simpan" value="Simpan Data" class="btn btn-primary"/>
          </div>
        </form>
      </div>
    </div>

    <div class="card">
      <div class="card-header text-white bg-secondary">
        Data Tahun
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Bulan</th>
              <th scope="col">Tahun</th>
              <th scope="col">Aksi </th>
            </tr>
            <tbody>
              <?php 
              $sql2 = "select * from tahun order by id desc";
              $q2 = mysqli_query($koneksi,$sql2);
              while($r2 = mysqli_fetch_array($q2)){
                $id = $r2['id'];
                $tanggal = $r2['tanggal'];
                $bulan = $r2['bulan'];
                $tahun = $r2['tahun'];
                ?>
                <tr>
                  <th scope="row"><?php  echo $urut ++ ?></th>
                  <th scope="row"><?php  echo $tanggal ?></th>
                  <th scope="row"><?php  echo $bulan ?></th>
                  <th scope="row"><?php  echo $tahun ?></th>
                  <td scope="row">
                    <a haref="index.php?op=edit&id=<?php echo $id?>"><button type="button" class="btn btn-warning">Edit</button></a>
                    
                    <button type="button" class="btn btn-danger">Delet</button>

                  </td>
                </tr>
                <?php
                
              }
              ?>
            </tbody>
          </thead>
        </table>
        <form action="" method="post">
          
        </form>
      </div>
    </div>
   </div>
  </body>
</html>

