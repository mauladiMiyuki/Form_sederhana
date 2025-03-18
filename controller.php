<?php
require_once "koneksi.php";

class Catatan {
    private $koneksi;

    public function __construct($db) {
        $this->koneksi = $db;
    }

    // sagan nampilakan tabel relasi nya (tampilan utama)
    public function getAllCatatan() {
        $query = "SELECT 
                    tabel_catatan.id, 
                    tabel_catatan.tanggal, 
                    tabel_catatan.keterangan, 
                    user.nama_user, 
                    category.nama_category, 
                    tabel_catatan.status 
                  FROM tabel_catatan
                  INNER JOIN user ON tabel_catatan.user_id = user.user_id
                  INNER JOIN category ON tabel_catatan.category_id = category.category_id";
        $result = mysqli_query($this->koneksi, $query);
        
        if (!$result) {
            die("Error pada query getAllCatatan(): " . mysqli_error($this->koneksi));
        }

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // sagan maambil data dalam database user
    public function getUsers() {
        $query = "SELECT user_id, nama_user FROM user";
        $result = mysqli_query($this->koneksi, $query);
        
        if (!$result) {
            die("Error pada query getUsers(): " . mysqli_error($this->koneksi));
        }

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // sagan maambil data dalam satabase category
    public function getCategories() {
        $query = "SELECT category_id, nama_category FROM category";
        $result = mysqli_query($this->koneksi, $query);
        
        if (!$result) {
            die("Error pada query getCategories(): " . mysqli_error($this->koneksi));
        }

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Tambah 
   public function tambahCatatan($tanggal, $keterangan, $pengguna, $kategori, $status) {
    $query = "INSERT INTO tabel_catatan (tanggal, keterangan, user_id, category_id, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($this->koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssiii", $tanggal, $keterangan, $pengguna, $kategori, $status);
    
    if (!mysqli_stmt_execute($stmt)) {
        die("Error pada query tambahCatatan(): " . mysqli_stmt_error($stmt)); 
    }

    return true;
}

    // Edit
   public function editCatatan($id, $tanggal, $keterangan, $pengguna, $kategori) {
    $query = "UPDATE tabel_catatan SET tanggal = ?, keterangan = ?, user_id = ?, category_id = ? WHERE id = ?";
    
    $stmt = mysqli_prepare($this->koneksi, $query);
    
    if (!$stmt) {
        die("Error dalam prepare statement: " . mysqli_error($this->koneksi));
    }

    mysqli_stmt_bind_param($stmt, "ssiii", $tanggal, $keterangan, $pengguna, $kategori, $id);
    
    if (!mysqli_stmt_execute($stmt)) {
        die("Error pada query editCatatan(): " . mysqli_stmt_error($stmt));
    }

    return true;
}



    // Hapus 
    public function hapusCatatan($id) {
        $query = "DELETE FROM tabel_catatan WHERE id=?";
        $stmt = mysqli_prepare($this->koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (!mysqli_stmt_execute($stmt)) {
            die("Error pada query hapusCatatan(): " . mysqli_error($this->koneksi));
        }

        return true;
    }

    // sagan status nya bila diklik bakal masuk kedalam database 
    public function Status($id, $status) {
    $query = "UPDATE tabel_catatan SET status=? WHERE id=?";
    $stmt = mysqli_prepare($this->koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    } else {
        return false; // Jika gagal
    }
}

// sagan menentukan belum selesai
public function getBelumSelesai() {
    $query = "SELECT 
    tabel_catatan.id, 
    tabel_catatan.tanggal, 
    tabel_catatan.keterangan, 
    user.nama_user, 
    category.nama_category
FROM tabel_catatan
INNER JOIN user ON tabel_catatan.user_id = user.user_id
INNER JOIN category ON tabel_catatan.category_id = category.category_id
WHERE tabel_catatan.status != 'selesai'";

    $result = mysqli_query($this->koneksi, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// sagan nentuakan sudah selesai
public function getSudahSelesai() {
   $query = "SELECT 
    tabel_catatan.id, 
    tabel_catatan.tanggal, 
    tabel_catatan.keterangan, 
    user.nama_user, 
    category.nama_category
FROM tabel_catatan
INNER JOIN user ON tabel_catatan.user_id = user.user_id
INNER JOIN category ON tabel_catatan.category_id = category.category_id
WHERE tabel_catatan.status = 'selesai'";
    $result = mysqli_query($this->koneksi, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

   
}

$catatan = new Catatan($koneksi);
?>