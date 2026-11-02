
<?php

class Penyewa_C068 extends Controller
{
    // ==========================================
    // MENAMPILKAN DATA PENYEWA
    // ==========================================
    public function index()
    {
        $cekdata = $this->load->model('m_master/Penyewa_M068');

        $dt['dtpenyewa'] = $cekdata->datapenyewa();

        $email = $this->session->userdata('emailuser');
        $info['nm_user'] = $email ? explode('@', $email)[0] : 'Admin';

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/penyewaview068', $dt);
        $this->load->view('layout/footer');
    }


    // ==========================================
    // FORM TAMBAH DATA PENYEWA
    // ==========================================
    public function create_penyewa()
    {
        $email = $this->session->userdata('emailuser');
        $info['nm_user'] = $email ? explode('@', $email)[0] : 'Admin';

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/create_penyewaview068');
        $this->load->view('layout/footer');
    }


    // ==========================================
    // FUNGSI UPLOAD FOTO
    // ==========================================
    private function uploadFoto($field, $prefix, $foto_lama = '')
    {
        if (!isset($_FILES[$field]) ||
            $_FILES[$field]['error'] == UPLOAD_ERR_NO_FILE) {
            return $foto_lama;
        }

        if ($_FILES[$field]['error'] != UPLOAD_ERR_OK) {
            return false;
        }

        $ekstensi = strtolower(
            pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION)
        );

        $format = ['jpg', 'jpeg', 'png'];

        if (!in_array($ekstensi, $format)) {
            return false;
        }

        $nama_file = $prefix . '_' . date('YmdHis') . '_' .
                     uniqid() . '.' . $ekstensi;

        $folder = dirname(__DIR__, 2) . '/img/';

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (move_uploaded_file(
            $_FILES[$field]['tmp_name'],
            $folder . $nama_file
        )) {
            return $nama_file;
        }

        return false;
    }


    // ==========================================
    // SIMPAN DATA PENYEWA
    // ==========================================
    public function simpan()
    {
        $penyewa = $this->load->model('m_master/Penyewa_M068');

        $ft_ktp = $this->uploadFoto(
            'ft_ktp068',
            'KTP'
        );

        $ft_sim_a = $this->uploadFoto(
            'ft_sim_a068',
            'SIM_A'
        );

        if ($ft_ktp === false || $ft_sim_a === false) {
            echo "<script>
                alert('Upload foto gagal! Gunakan format JPG, JPEG, atau PNG.');
                window.history.back();
            </script>";
            exit;
        }

        $data = [
            'user_plg068'  => $this->load->post('user_plg068'),
            'Sandi068'     => $this->load->post('Sandi068'),
            'Nik068'       => $this->load->post('Nik068'),
            'nm_lngkp068'  => $this->load->post('nm_lngkp068'),
            'no_hp068'     => $this->load->post('no_hp068'),
            'almt_lngkp068'=> $this->load->post('almt_lngkp068'),
            'ft_ktp068'    => $ft_ktp,
            'ft_sim_a068'  => $ft_sim_a
        ];

        $simpan = $penyewa->simpan($data);

        if ($simpan) {
            echo "<script>
                alert('Data penyewa berhasil disimpan!');
                window.location.href = '" .
                base_url('?url=c_master/Penyewa_C068/index') . "';
            </script>";
        } else {
            echo "<script>
                alert('Data penyewa gagal disimpan!');
                window.history.back();
            </script>";
        }
    }


    // ==========================================
    // EDIT DATA PENYEWA
    // ==========================================
    public function edit($username)
    {
        $email = $this->session->userdata('emailuser');
        $info['nm_user'] = $email ? explode('@', $email)[0] : 'Admin';

        $penyewa = $this->load->model('m_master/Penyewa_M068');

        $dt['penyewa'] = $penyewa->detailpenyewa($username);

        if (empty($dt['penyewa'])) {
            die('Data penyewa tidak ditemukan!');
        }

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/update_penyewaview068', $dt);
        $this->load->view('layout/footer');
    }


    // ==========================================
    // UPDATE DATA PENYEWA
    // ==========================================
    public function UpdatePenyewa()
    {
        $penyewa = $this->load->model('m_master/Penyewa_M068');

        $username_lama = $this->load->post('username_lama068');

        $ft_ktp_lama = $this->load->post('ft_ktp_asli068');
        $ft_sim_lama = $this->load->post('ft_sim_a_asli068');

        $ft_ktp = $this->uploadFoto(
            'ft_ktp068',
            'KTP',
            $ft_ktp_lama
        );

        $ft_sim_a = $this->uploadFoto(
            'ft_sim_a068',
            'SIM_A',
            $ft_sim_lama
        );

        if ($ft_ktp === false || $ft_sim_a === false) {
            echo "<script>
                alert('Upload foto gagal! Gunakan format JPG, JPEG, atau PNG.');
                window.history.back();
            </script>";
            exit;
        }

        $data = [
            'username_lama068' => $username_lama,
            'user_plg068'      => $this->load->post('user_plg068'),
            'Sandi068'         => $this->load->post('Sandi068'),
            'Nik068'           => $this->load->post('Nik068'),
            'nm_lngkp068'      => $this->load->post('nm_lngkp068'),
            'no_hp068'         => $this->load->post('no_hp068'),
            'almt_lngkp068'    => $this->load->post('almt_lngkp068'),
            'ft_ktp068'        => $ft_ktp,
            'ft_sim_a068'      => $ft_sim_a
        ];

        $simpan = $penyewa->ubahPenyewa($data);

        if ($simpan) {

            // Hapus foto lama jika sudah diganti
            $folder = dirname(__DIR__, 2) . '/img/';

            if ($ft_ktp != $ft_ktp_lama &&
                !empty($ft_ktp_lama) &&
                file_exists($folder . $ft_ktp_lama)) {
                unlink($folder . $ft_ktp_lama);
            }

            if ($ft_sim_a != $ft_sim_lama &&
                !empty($ft_sim_lama) &&
                file_exists($folder . $ft_sim_lama)) {
                unlink($folder . $ft_sim_lama);
            }

            echo "<script>
                alert('Data penyewa berhasil diubah!');
                window.location.href = '" .
                base_url('?url=c_master/Penyewa_C068/index') . "';
            </script>";

        } else {
            echo "<script>
                alert('Data penyewa gagal diubah!');
                window.history.back();
            </script>";
        }
    }


    // ==========================================
    // HAPUS DATA PENYEWA
    // ==========================================
    public function hapus($username)
    {
        $penyewa = $this->load->model('m_master/Penyewa_M068');

        $dt = $penyewa->detailpenyewa($username);

        if (empty($dt)) {
            die('Data penyewa tidak ditemukan!');
        }

        $hapus = $penyewa->HapusDtPenyewa($username);

        if ($hapus) {

            $folder = dirname(__DIR__, 2) . '/img/';

            $ft_ktp = $dt['ft_ktp068'];
            $ft_sim_a = $dt['ft_sim_a068'];

            if (!empty($ft_ktp) &&
                file_exists($folder . $ft_ktp)) {
                unlink($folder . $ft_ktp);
            }

            if (!empty($ft_sim_a) &&
                file_exists($folder . $ft_sim_a)) {
                unlink($folder . $ft_sim_a);
            }

            echo "<script>
                alert('Data penyewa berhasil dihapus!');
                window.location.href = '" .
                base_url('?url=c_master/Penyewa_C068/index') . "';
            </script>";

        } else {
            echo "<script>
                alert('Data penyewa gagal dihapus!');
                window.history.back();
            </script>";
        }
    }


    // ==========================================
    // LOGOUT
    // ==========================================
    public function keluar()
    {
        $this->session->unset_userdata('emailuser');
        $this->session->set_flashdata('pesan', 'Berhasil Logout');

        redirect('Login_C/index');
        exit;
    }

}
