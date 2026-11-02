
<?php

class Penyewa_M068 extends Model
{
    // ==========================================
    // PEMERIKSAAN QUERY
    // ==========================================
    private function prepareQuery($query)
    {
        $sql = $this->db->prepare($query);

        if (!$sql) {
            die("Query SQL gagal: " . $this->db->error);
        }

        return $sql;
    }

    // ==========================================
    // MENAMPILKAN DATA PENYEWA
    // ==========================================
    public function datapenyewa()
    {
        $sql = $this->prepareQuery("
            SELECT
                user_plg068,
                sandi068,
                nik068,
                nm_lngkp068,
                no_hp068,
                almt_lngkp068,
                ft_ktp,
                ft_sim_a
            FROM penyewa
            ORDER BY user_plg068 ASC
        ");

        $sql->execute();

        $hasil = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $sql->close();

        return $hasil;
    }

    // ==========================================
    // CEK USERNAME
    // ==========================================
    public function cekusername($username)
    {
        $sql = $this->prepareQuery("
            SELECT user_plg068
            FROM penyewa
            WHERE user_plg068 = ?
        ");

        $sql->bind_param("s", $username);
        $sql->execute();

        $hasil = $sql->get_result()->num_rows > 0;

        $sql->close();

        return $hasil;
    }

    // ==========================================
    // SIMPAN DATA PENYEWA
    // ==========================================
    public function simpan($data)
    {
        $username = $data['user_plg068'] ?? '';
        $password = $data['sandi068'] ?? $data['Sandi068'] ?? '';
        $nik      = $data['nik068'] ?? $data['Nik068'] ?? '';
        $nama     = $data['nm_lngkp068'] ?? '';
        $hp       = $data['no_hp068'] ?? '';
        $alamat   = $data['almt_lngkp068'] ?? '';
        $ktp      = $data['ft_ktp'] ?? $data['ft_ktp068'] ?? '';
        $sim      = $data['ft_sim_a'] ?? $data['ft_sim_a068'] ?? '';

        $sql = $this->prepareQuery("
            INSERT INTO penyewa (
                user_plg068,
                sandi068,
                nik068,
                nm_lngkp068,
                no_hp068,
                almt_lngkp068,
                ft_ktp,
                ft_sim_a
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $sql->bind_param(
            "ssssssss",
            $username,
            $password,
            $nik,
            $nama,
            $hp,
            $alamat,
            $ktp,
            $sim
        );

        $hasil = $sql->execute();

        $sql->close();

        return $hasil;
    }

    // ==========================================
    // DETAIL DATA PENYEWA
    // ==========================================
    public function detailpenyewa($username)
    {
        $sql = $this->prepareQuery("
            SELECT *
            FROM penyewa
            WHERE user_plg068 = ?
        ");

        $sql->bind_param("s", $username);
        $sql->execute();

        $hasil = $sql->get_result()->fetch_assoc();

        $sql->close();

        return $hasil;
    }

    // ==========================================
    // UPDATE DATA PENYEWA
    // ==========================================
    public function ubahPenyewa($data)
    {
        $username = $data['user_plg068'] ?? '';
        $password = $data['sandi068'] ?? $data['Sandi068'] ?? '';
        $nik      = $data['nik068'] ?? $data['Nik068'] ?? '';
        $nama     = $data['nm_lngkp068'] ?? '';
        $hp       = $data['no_hp068'] ?? '';
        $alamat   = $data['almt_lngkp068'] ?? '';
        $ktp      = $data['ft_ktp'] ?? $data['ft_ktp068'] ?? '';
        $sim      = $data['ft_sim_a'] ?? $data['ft_sim_a068'] ?? '';
        $lama     = $data['username_lama068'] ?? '';

        $sql = $this->prepareQuery("
            UPDATE penyewa SET
                user_plg068 = ?,
                sandi068 = ?,
                nik068 = ?,
                nm_lngkp068 = ?,
                no_hp068 = ?,
                almt_lngkp068 = ?,
                ft_ktp = ?,
                ft_sim_a = ?
            WHERE user_plg068 = ?
        ");

        $sql->bind_param(
            "sssssssss",
            $username,
            $password,
            $nik,
            $nama,
            $hp,
            $alamat,
            $ktp,
            $sim,
            $lama
        );

        $hasil = $sql->execute();

        $sql->close();

        return $hasil;
    }

    // ==========================================
    // HAPUS DATA PENYEWA
    // ==========================================
    public function HapusDtPenyewa($username)
    {
        $sql = $this->prepareQuery("
            DELETE FROM penyewa
            WHERE user_plg068 = ?
        ");

        $sql->bind_param("s", $username);

        $hasil = $sql->execute();

        $sql->close();

        return $hasil;
    }
}
