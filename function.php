<?php

session_start();

//Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stokbarang");

//Menambah barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $addtotable = mysqli_query($conn, "INSERT INTO stok (namabarang, deskripsi, stok) VALUES('$namabarang', '$deskripsi', '$stok')");
    if($addtotable){
        header('location:index.php');
    } else{
        echo'Gagal';
        header('location:index.php');
    }
};


//Menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahstoksekarangdenganquantity = $stoksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, keterangan, qty) VALUES('$barangnya', '$penerima', '$qty')");
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok SET stok='$tambahstoksekarangdenganquantity' WHERE idbarang='$barangnya'");
    if($addtomasuk&&$updatestokmasuk){
        header('location:masuk.php');
    } else{
        echo'Gagal';
        header('location:masuk.php');
    }
};


//Menambah barang keluar
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahstoksekarangdenganquantity = $stoksekarang-$qty;

    $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, penerima, qty) VALUES('$barangnya', '$penerima', '$qty')");
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok SET stok='$tambahstoksekarangdenganquantity' WHERE idbarang='$barangnya'");
    if($addtokeluar&&updatestokmasuk){
        header('location:keluar.php');
    } else{
        echo'Gagal';
        header('location:keluar.php');
    }
};
?>
