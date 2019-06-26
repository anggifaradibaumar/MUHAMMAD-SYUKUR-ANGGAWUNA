<?php
$koneksi=mysqli_connect("localhost","root","","db_tentara")
?>
<!DOCTYPE html>
<html>
<head>
    <title>SISTEM BASIS DATA</title>
</head>
<body background="1.jpg">


<center>
<h1 style="color: yellow; padding-top: 10px;">BIODATA KECIL ANGGOTA TENTARA</h1>

<?php
    $dataEdit[0]="";
    $dataEdit[1]="";
    $dataEdit[2]="";
    $dataEdit[3]="";
    $tombol="registrasi";
    if(isset($_GET['aksi'])) {
        if($_GET['aksi']=='edit') {
            $edit="SELECT * FROM data_tentara WHERE no_induk='$_GET[id]'";
            $cekEdit= mysqli_query($koneksi,$edit);
            $dataEdit=mysqli_fetch_array($cekEdit);

            $tombol="edit";
        }
    }
?>
<form action="" method="post">
    <table bgcolor="darkolivegreen">
        <tr style="color: white;">
            <td>No Induk</td>
            <td>:</td> 
            <td><input type="int" name="no_induk" value="<?=$dataEdit[0]?>"></td>
        </tr>
        <tr style="color: white;">
            <td>NAMA</td>
            <td>:</td> 
            <td><input type="text" name="nama" value="<?=$dataEdit[1]?>"></td>
        </tr>
        <tr style="color: white;">
            <td>ALAMAT</td>
            <td>:</td> 
            <td><input type="varchar" name="alamat" value="<?=$dataEdit[2]?>"></td>
        </tr>
        <tr style="color: white;">
            <td>TELEPON</td>
            <td>:</td> 
            <td><input type="int" name="telepon" value="<?=$dataEdit[3]?>"></td>
        </tr>
    </table>
    <input type="submit" value="<?=$tombol?>" name="<?=$tombol?>">
</form>

<br><br>
<table border="1" bgcolor="darkolivegreen">
<thead style="color: white;">
    <th>NO INDUK</th>
    <th>NAMA</th>
    <th>ALAMAT</th>
    <th>TELEPON</th>
    <th>AKSI</th>
</thead>
</body>

<?php
    $sqlView = "SELECT * FROM `data_tentara`";
    $cekView = mysqli_query($koneksi, $sqlView);
        
    $nomor = 1;
    while ($data = mysqli_fetch_array($cekView)) {
?>
    <tr>
        <td><?=$nomor?></td>
        <td><?=$data[1]?></td>
        <td><?=$data[2]?></td>
        <td><?=$data[3]?></td>
        <td>
            <a href="simbadaangga.php?id=<?=$data[0]?>&aksi=edit">Edit</a>
        </td>
    </tr>

<?php
    $nomor=$nomor+1;
    }
?>

</tbody>
</table>
</center>
</body>
</html>

<?php
    if(isset($_POST['registrasi'])) 
    {
        $sql = "INSERT INTO `data_tentara` (`no_induk`,`nama`,`alamat`,`telepon`) VALUES ('$_POST[no_induk]','$_POST[nama]', '$_POST[alamat]', '$_POST[telepon]')";
        $cekInput = mysqli_query($koneksi, $sql);
        // var_dump($sql);
        // die;
        if($cekInput) {
            echo "<script> window.location = 'simbadaangga.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }
    else if (isset($_POST['edit']))
    {
        $edit = "UPDATE `data_tentara` SET `no_induk` = '$_POST[no_induk]',`nama` = '$_POST[nama]',`alamat` = '$_POST[alamat]', `telepon` = '$_POST[telepon]'  WHERE `data_tentara`.`no_induk` = '$_GET[id]';";
        $cekEdit = mysqli_query($koneksi, $edit);  

        if($cekEdit) {
            echo "<script> window.location = 'simbadaangga.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }
?>