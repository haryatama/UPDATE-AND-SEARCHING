<?php

    //membuat koneksi
    $conn=mysqli_connect("localhost", "root", "", "percobaan1");

    //ambil data dari tabel mahasiswa/query data mahasiswa
    $result=mysqli_query($conn,"SELECT * FROM phpdatabase");

    //function query akan menerima isi parameter dari string query yang ada pada index2.php (line 3)
    function query($query_kedua){
        //dikarena $conn diluar function query maka dibutuhkan scope global $$conn

        global $conn;
        $result = mysqli_query($conn, $query_kedua);

        //wadah kosong untuk menampung isi array pada saat looping line 16

        $rows = [];
        while ($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah ($data)
    {
        global $conn;
        $nama = $data["Nama"];
        $nim = $data["Nim"];
        $email = $data["Email"];
        $jurusan = $data["Jurusan"];
        $gambar = $data["Gambar"];

        $query = " INSERT INTO phpdatabase  
                    VALUES 
                    ('','$nama','$nim','$email','$jurusan','$gambar')";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }

    function hapus ($id)
    {
        global $conn;
        mysqli_query($conn," DELETE FROM phpdatabase WHERE id = $id ");
        return mysqli_affected_rows($conn); 
    }

    function edit ($data)
    {
        global $conn;
        
        $id=$data["id"];
        $nama=htmlspecialchars($data["Nama"]);
        $nim=htmlspecialchars($data["Nim"]);
        $email=htmlspecialchars($data["Email"]);
        $jurusan=htmlspecialchars($data["Jurusan"]);
        $gambar=htmlspecialchars($data["Gambar"]);

        $query = " UPDATE phpdatabase SET 
                    Nama = '$nama' ,
                    Nim = '$nim' ,
                    Email = '$email' ,
                    Jurusan = '$jurusan' ,
                    Gambar = '$gambar' 
                    WHERE id = $id ";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }

    function cari ($keyword)
    {
        $sql = "SELECT * FROM phpdatabase
                WHERE 
                Nama LIKE '%$keyword%' OR
                Nim LIKE '%$keyword%' OR
                Email LIKE '%$keyword%' OR
                Jurusan LIKE '%$keyword%' ";

        return query($sql);
    }

?>
