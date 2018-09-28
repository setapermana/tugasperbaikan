<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "test";
$con = mysqli_connect($server, $username, $password) or
die("<h1>Koneksi Mysqli Error : </h1>" . mysqli_connect_error());
mysqli_select_db($con, $database) or die("<h1>Koneksi Kedatabase Error : </h1>" . mysqli_error($con));
@$operasi = $_GET['operasi'];
Switch ($operasi) {
case "get":
$query_get = mysqli_query($con,"SELECT * FROM user") or die (mysqli_error($con));
$data_array = array();
while ($data = mysqli_fetch_assoc($query_get)) {
$data_array[]=$data;
}

echo json_encode($data_array);
break;
case "post":
@$nama = $_GET['nama'];
@$alamat = $_GET['alamat'];
@$pekerjaan = $_GET['pekerjaan'];
$query_post = mysqli_query($con, "INSERT INTO user (nama,alamat,pekerjaan) VALUES('$nama','$alamat','$pekerjaan')");
if ($query_post) {
echo "Data Berhasil Disimpan";
}
else {
echo "Maaf Insert Ke Dalam Database Error" . mysqli_error($con);
}
break;

case "put":
@$nama = $_GET['nama'];
@$alamat = $_GET['alamat'];
@$pekerjaan = $_GET['pekerjaan'];
@$id = $_GET['id'];
$query_put = mysqli_query($con, "UPDATE user SET nama='$nama', alamat='$alamat', pekerjaan='$pekerjaan' WHERE id='$id'");
if ($query_put) {
echo "Update Data Berhasil";
}
else {
echo mysqli_error($con);
}
break;

case "delete":
@$id = $_GET['id'];
$query_delete = mysqli_query($con, "DELETE FROM user WHERE id='$id'");
if ($query_delete) {
echo "Data Berhasil Dihapus";
}
else {
echo mysqli_error($con);
}
break;
default:
break;
}
?>