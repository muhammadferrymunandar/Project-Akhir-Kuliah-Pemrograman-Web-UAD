<?php
    session_start();

    //membuat koneksi ke database

    $conn = mysqli_connect("localhost", "root","","stockbarang");
  
    //menambah barang baru
    if(isset($_POST['addnewbarang'])){
        $namabarang = $_POST['namabarang'];
        $stock = $_POST['stock'];
        $deskripsi = $_POST['deskripsi'];

        $addtotable = mysqli_query($conn,"insert into stock (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')"); 
        if($addtotable){
            header('location:index.php');
        } else{
            echo 'gagal';
            header('location:index.php');
        }
    };


    //Menambahkan barang masuk
    if(isset($_POST['barangmasuk'])){
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];
        
        $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstocksekarang);

        $stocksekarang = $ambildatanya['stock'];
        $tambahstocksekarangdenganqty = $stocksekarang+$qty;
        
        $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values ('$barangnya','$penerima','$qty')");
        $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahstocksekarangdenganqty' where idbarang='$barangnya'");
        
        if($addtomasuk&&$updatestockmasuk){
            header('location:masuk.php');
        } else{
            echo 'gagal';
            header('location:masuk.php');
        }
    }

    //Menambahkan barang keluar
    if(isset($_POST['addbarangkeluar'])){
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];
        
        $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstocksekarang);

        $stocksekarang = $ambildatanya['stock'];
        //stock cukup
        if($stocksekarang>=$qty){
            $kurangstocksekarangdenganqty = $stocksekarang-$qty;
        
            $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya','$penerima','$qty')");
            $updatestockkeluar = mysqli_query($conn,"update stock set stock='$kurangstocksekarangdenganqty' where idbarang='$barangnya'");
            
            if($addtokeluar&&$updatestockkeluar){
                header('location:keluar.php');
            } else{
                echo 'gagal';
                header('location:keluar.php');
            }
        } else{
            //tidak cukup;
            echo '
            <script>
                alert("Stock saat ini tidak mencukupi!! Cek stock");
                window.location.href="keluar.php;
            </script>';
        }
    };


    //update info barang
    if(isset($_POST['updatebarang'])){
        $idb = $_POST['idb'];
        $namabarang = $_POST['namabarang'];
        $stock = $_POST['stock'];
        $deskripsi = $_POST['deskripsi'];

        $updatebarang= mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi', stock='$stock' where idbarang='$idb'");

        if($updatebarang){
            header('location:index.php');
        } else{
            echo 'gagal';
            header('location:index.php');
        }
    };

    //menghapus barang di stock
    if(isset($_POST['hapusbarang'])){
        $idb = $_POST['idb'];

        $hapus = mysqli_query($conn, "DELETE FROM stock WHERE idbarang='$idb'");

        if($hapus){
            header('location:index.php');
        } else{
            echo 'gagal';
            header('location:index.php');
        }
    };

    //mengedit barang di masuk
    if(isset($_POST['updatebarangmasuk'])){
        $idb = $_POST['idb'];
        $idm = $_POST['idm'];
        $keterangan = $_POST['keterangan'];
        $qty = $_POST['qty'];

        $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
        $stocknya = mysqli_fetch_array($lihatstock);
        $stockskrg = $stocknya['stock'];

        $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
        $qtynya = mysqli_fetch_array($qtyskrg);
        $qtyskrg = $qtynya['qty'];

        if($qty>$qtyskrg){
            $selisih = $qty-$qtyskrg;
            $kurangin = $stockskrg + $selisih;
            $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn,"update masuk set qty='$qty', keterangan='$keterangan' where idmasuk='$idm'");
                if($kurangistocknya&&$updatenya){
                    header('location:masuk.php');
                } else{
                    echo 'gagal';
                    header('location:masuk.php');
                }
        }else {
            $selisih = $qtyskrg-$qty;
            $kurangin = $stockskrg - $selisih;
            $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn,"update masuk set qty='$qty', keterangan='$keterangan' where idmasuk='$idm'");
                if($kurangistocknya&&$updatenya){
                    header('location:masuk.php');
                } else{
                    echo 'gagal';
                    header('location:masuk.php');
                }
        }
    };

    //hapus barang masuk
    if(isset($_POST['hapusbarangmasuk'])){
        $idb = $_POST['idb'];
        $qty = $_POST['kty'];
        $idm = $_POST['idm'];

        $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
        $data = mysqli_fetch_array($getdatastock);
        $stok = $data['stock'];

        $selisih = $stok-$qty;

        $update = mysqli_query($conn,"update stock set stock='$selisih' where idbarang='$idb'");
        $hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");
        if($update&&$hapusdata){
            header('location:masuk.php');
        } else{
            echo 'gagal';
            header('location:masuk.php');
        }
    };

     //mengedit barang di keluar
     if(isset($_POST['updatebarangkeluar'])){
        $idb = $_POST['idb'];
        $idk = $_POST['idk'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];

        $lihatstockk = mysqli_query($conn,"select * from stock where idbarang='$idb'");
        $stocknyak = mysqli_fetch_array($lihatstockk);
        $stockskrgk = $stocknyak['stock'];

        $qtyskrgk = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
        $qtynyak = mysqli_fetch_array($qtyskrgk);
        $qtyskrgk = $qtynyak['qty'];

        if($qty>$qtyskrgk){
            $selisih = $qty-$qtyskrgk;
            if($stockskrgk>=$selisih){
            $kurangin = $stockskrgk-$selisih;
            
                
            $kurangistocknyak = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn,"update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
                if($kurangistocknyak&&$updatenya){
                    header('location:keluar.php');
                } else{
                    echo 'gagal';
                    header('location:keluar.php');
                }
            } else{
                //tidak cukup;
                echo '
                    <script>
                        alert("Stock saat ini tidak mencukupi!! Cek stock");
                        window.location.href="keluar.php;
                    </script>';
            }
        }else {
            $selisih = $qtyskrgk-$qty;
            
            $kurangin = $stockskrgk+$selisih;
                $kurangistocknyak = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
                $updatenya = mysqli_query($conn,"update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
                    if($kurangistocknyak&&$updatenya){
                        header('location:keluar.php');
                    } else{
                        echo 'gagal';
                        header('location:keluar.php');
                    }
        }
    };

    //hapus barang keluar
    if(isset($_POST['hapusbarangkeluar'])){
        $idb = $_POST['idb'];
        $qty = $_POST['kty'];
        $idk = $_POST['idk'];

        $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
        $data = mysqli_fetch_array($getdatastock);
        $stokk = $data['stock'];

        $selisihk = $stokk+$qty;

        $updatek = mysqli_query($conn,"update stock set stock='$selisihk' where idbarang='$idb'");
        $hapusdatak = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");
        if($updatek&&$hapusdatak){
            header('location:keluar.php');
        } else{
            echo 'gagal';
            header('location:keluar.php');
        }
    };


?>