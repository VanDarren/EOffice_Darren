<?php

namespace App\Http\Controllers;

use App\Models\eoffice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard()
	{
        $id_level = session()->get('id_level');
        if (!$id_level) {
            return redirect()->route('login');
        }
    
        $model = new eoffice();
        $userId = session()->get('id_user');
        $username = session()->get('username');
        $data = [
            'username' => $username,
            'id_level' => $id_level
        ];
    
        // Log aktivitas
        $activityLog = [
            'id_user' => $userId,
            'activity' => 'Masuk Menu Dashboard',
            'time' => now()->toDateTimeString()
        ];
        $model->logActivity($activityLog);
        $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
		echo view('header',$data);
        echo view('menu',$data);
		echo view('dashboard',$data);
        echo view('footer');
	}

    public function login()
	{
        $model = new eoffice();
        $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
		echo view('header',$data);
		echo view('login',$data);
        echo view('footer');
	}

    public function aksi_login(Request $request)
    {
        // Mengakses input dari request
        $name = $request->input('username');
        $pw = $request->input('password');
        $captchaResponse = $request->input('g-recaptcha-response');
        $backupCaptcha = $request->input('backup_captcha');
        
        // Secret key untuk Google reCAPTCHA
        $secretKey = '6LdFhCAqAAAAAM1ktawzN-e2ebDnMnUQgne7cy53'; 
        $recaptchaSuccess = false;
        
        // Membuat instance model
        $model = new eoffice();  // Asumsi model Rental sudah di-import di bagian atas controller
        
        // Cek koneksi internet dari sisi server
        if ($this->isInternetAvailable()) {
            // Server terhubung ke internet, gunakan Google reCAPTCHA
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
            $responseKeys = json_decode($response, true);
            $recaptchaSuccess = $responseKeys["success"];
        }
        
        // Jika reCAPTCHA Google berhasil diverifikasi
        if ($recaptchaSuccess) {
            // Dapatkan pengguna berdasarkan username
            $user = $model->getWhere('user', ['username' => $name]);
            
            if ($user && $user->password === $pw) { // Verifikasi password tanpa hash
                // Set session
                session()->put('username', $user->username);
                session()->put('id_user', $user->id_user);
                session()->put('id_level', $user->id_level);
    
                return redirect()->to('dashboard');
            } else {
                return redirect()->to('login')->with('error', 'Invalid username or password.');
            }
        } else {
            $storedCaptcha = session()->get('captcha_code'); 
            
            if ($storedCaptcha !== null) {
                // Verifikasi backup CAPTCHA (offline)
                if ($storedCaptcha === $backupCaptcha) {
                    // CAPTCHA valid, lanjutkan login
                    $user = $model->getWhere('user', ['username' => $name]);
    
                    if ($user && $user->password === $pw) { // Verifikasi password tanpa hash
                        // Set session
                        session()->put('username', $user->username);
                        session()->put('id_user', $user->id_user);
                        session()->put('id_level', $user->id_level);
    
                        return redirect()->to('dashboard');
                    } else {
                        return redirect()->to('login')->with('error', 'Invalid username or password.');
                    }
                } else {
                    // CAPTCHA tidak valid
                    return redirect()->to('login')->with('error', 'Invalid CAPTCHA.');
                }
            } else {
                return redirect()->to('login')->with('error', 'CAPTCHA session is not set.');
            }
        }
    }
    
    private function isInternetAvailable()
    {

        $connected = @fsockopen("www.google.com", 80); 
        if ($connected){
            fclose($connected);
            return true;
        }
        return false;
    }
    

    public function generateCaptcha()
    {
        $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        session()->put('captcha_code', $code);
    
        $image = imagecreatetruecolor(120, 40);
        $bgColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);
    
        imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
        imagestring($image, 5, 10, 10, $code, $textColor);
    
        ob_start();
        imagepng($image);
        $imageData = ob_get_contents();
        ob_end_clean();
    
        imagedestroy($image);
    
        return response($imageData)
                    ->header('Content-Type', 'image/png'); 
    }
    
    public function logout()
    {
        $model = new eoffice();
        $id_user = session()->get('id_user');
        if ($id_user) {
            $activityLog = [
                'id_user' => $id_user,
                'activity' => 'Logout',
                'time' => now() 
            ];
            $model->logActivity($activityLog);
        }

        session()->flush();
        return redirect()->route('login'); 
    }

    public function setting()
    {
        $id_level = session()->get('id_level');	

        // Cek apakah pengguna sudah login
        if (!$id_level) {
            return redirect()->route('login'); // Redirect ke halaman login
        } elseif ($id_level != 1) {
            return redirect()->route('error404'); // Redirect ke halaman error
        } else {
            // Ambil data dari database
            $model = new eoffice();
            $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);

            // Log aktivitas pengguna
            $id_user = session()->get('id_user');
            $activityLog = [
                'id_user' => $id_user,
                'activity' => 'Masuk Menu Setting',
                'time' => now()->toDateTimeString()
            ];
            $model->logActivity($activityLog);

            $data['id_level'] = $id_level; 

            echo view('header', $data);
            echo view('menu', $data);
            echo view('setting', $data);
            echo view('footer');
        }
    }

    public function editsetting(Request $request)
    {
        // Initialize the model
        $model = new eoffice();
        $namawebsite = $request->input('namaweb');
    
        $data = ['namawebsite' => $namawebsite];
    
        // Process upload for tab icon
        if ($request->hasFile('tab') && $request->file('tab')->isValid()) {
            $tab = $request->file('tab');
            $tabName = time() . '_' . $tab->getClientOriginalName(); // Save file with unique name
            $tab->move(public_path('img'), $tabName);
            $data['icontab'] = $tabName; // Save file name to database
        }
    
        // Process upload for menu icon
        if ($request->hasFile('menu') && $request->file('menu')->isValid()) {
            $menu = $request->file('menu');
            $menuName = time() . '_' . $menu->getClientOriginalName();
            $menu->move(public_path('img'), $menuName);
            $data['iconmenu'] = $menuName;
        }
    
        // Process upload for login icon
        if ($request->hasFile('login') && $request->file('login')->isValid()) {
            $login = $request->file('login');
            $loginName = time() . '_' . $login->getClientOriginalName();
            $login->move(public_path('img'), $loginName);
            $data['iconlogin'] = $loginName;
        }
    
        $where = ['id_setting' => 1];
        $model->edit('setting',$where, $data ); 
    
       
        return redirect()->route('setting')->with('success', 'Settings updated successfully!'); // Adjust as necessary
    }

    public function error404()
	{
			$model = new eoffice();
			$where = array('id_setting' => 1);
			$data['darren2'] = $model->getwhere('setting', $where);
			echo view('header', $data);
			echo view('error404');
	}

    public function logactivity()
    {
        // Check user level from session
        $id_level = Session::get('id_level');
    
        // Redirect if the user is not logged in or not an admin
        if (!$id_level) {
            return redirect()->to('home/login');
        } elseif ($id_level != 1) {
            return redirect()->to('home/error404');
        }
    
        // Fetch settings data
        $model = new eoffice();
        $where = array('id_setting' => 1);
        $data['darren2'] = $model->getwhere('setting', $where);
        $data['logs'] = $model->getLogData();
    
        $data['id_level'] = $id_level; 
    
        
        echo view('header',$data);
        echo view('menu',$data);
        echo view('logactivity',$data);
        echo view('footer');
    }

    public function suratmasuk()
    {
        $id_level = session()->get('id_level');
    
        // Cek apakah pengguna sudah login
        if (!$id_level) {
            return redirect()->route('login'); 
        } else {
            $model = new eoffice();
            $data['nomor_surat'] = 'SM-' . date('Ymd') . '-' . rand(100, 999);
            $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
            $data['bagian'] = $model->tampil('level');  // Data level untuk akses berdasarkan Bagian
            $data['user'] = $model->tampil('user');  // Data user untuk akses pribadi
            $data['id_level'] = $id_level;
    
            echo view('header', $data);
            echo view('menu', $data);
            echo view('suratmasuk', $data);
            echo view('footer');
        }
    }
    
    
    public function aksiTambahSuratMasuk(Request $request)
    {
        $model = new eoffice();
    
    
        // Upload lampiran dengan nama asli ke folder 'public/dokumen'
        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran');
            $lampiranPath = $lampiran->getClientOriginalName();
            $lampiran->move(public_path('dokumen'), $lampiranPath);
        } else {
            return back()->withErrors(['Lampiran tidak boleh kosong']);
        }
    
        // Generate nomor surat secara otomatis (misalnya: SUR-YYYYMMDD-XXX)
        $tanggalSekarang = Carbon::now()->format('Ymd');
    
        $data = [
            'lampiran' => $lampiranPath,
            'nomor_surat' => $request->input('nomor_surat'),
            'tanggal_terima' => $request->input('tanggal_terima'),
            'perihal' => $request->input('perihal'),
            'pengirim' => $request->input('pengirim'),
            'created_at' =>  $tanggalSekarang,
            'id_jenis' => 1
        ];
    
        // Simpan data ke dalam tabel 'suratmasuk'
        $model->tambah('suratmasuk', $data);
    
        return redirect()->back()->with('success', 'Surat Masuk berhasil ditambahkan.');
    }
    

    public function document(Request $request)
    {
        $id_level = session()->get('id_level');
        $model = new eoffice();
    
        // Cek apakah pengguna sudah login
        if (!$id_level) {
            return redirect()->route('login');
        } else {
            $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
            $data['bagian'] = $model->tampil('level'); // Data level untuk akses berdasarkan Bagian
            $data['user'] = $model->tampil('user'); // Data user untuk akses pribadi
            $data['id_level'] = $id_level;
    
            // Default is to show Surat Masuk
            $tab = $request->get('tab', 'suratmasuk'); // default to suratmasuk
    
            // Fetch the data based on selected tab
            if ($tab == 'suratmasuk') {
                $data['suratmasuk'] = $model->tampil('suratmasuk');
            } elseif ($tab == 'suratkeluar') {
                $data['suratkeluar'] = $model->tampil('suratkeluar');
            } elseif ($tab == 'keterlambatan') {
                $data['keterlambatan'] = $model->tampil('keterlambatan');
            } elseif ($tab == 'pengajuancuti') {
                $data['pengajuancuti'] = $model->tampil('pengajuancuti');
            }
    
            // Menampilkan tampilan dengan data
            echo view('header', $data);
            echo view('menu', $data);
            echo view('document', $data); // View untuk dokumen
            echo view('footer');
        }
    }
    

    public function telathadir()
    {
        $id_level = session()->get('id_level');
    
        // Cek apakah pengguna sudah login
        if (!$id_level) {
            return redirect()->route('login'); 
        } else {
            $model = new eoffice();
    
            $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
            $data['bagian'] = $model->tampil('level');  // Data level untuk akses berdasarkan Bagian
            $data['user'] = $model->tampil('user');  // Data user untuk akses pribadi
            $data['id_level'] = $id_level;
    
            echo view('header', $data);
            echo view('menu', $data);
            echo view('telathadir', $data);
            echo view('footer');
        }
    }

    public function tambahKeterlambatan(Request $request)
{


    $data = [
        'nama' => $request->input('nama'),
        'nik' => $request->input('nik'),
        'id_level' => $request->input('bagian'),
        'tanggal' => $request->input('hari_tanggal'),
        'waktu' => $request->input('jam_kedatangan'),
        'waktu_telat' => $request->input('waktu_keterlambatan'),
        'alasan' => $request->input('alasan'),
        'id_jenis' => 4
    ];

    // Insert data using the model's tambah method
    $model = new eoffice();
    $model->tambah('keterlambatan', $data);

    return redirect()->back()->with('success', 'Data keterlambatan berhasil ditambahkan.');
}

public function suratkeluar()
{
    $id_level = session()->get('id_level');

    // Cek apakah pengguna sudah login
    if (!$id_level) {
        return redirect()->route('login'); 
    } else {
        $model = new eoffice();
        $data['nomor_surat'] = 'SK-' . date('Ymd') . '-' . rand(100, 999); // Kode untuk Surat Keluar
        $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
        $data['bagian'] = $model->tampil('level');  // Data level untuk akses berdasarkan Bagian
        $data['user'] = $model->tampil('user');  // Data user untuk akses pribadi
        $data['id_level'] = $id_level;

        echo view('header', $data);
        echo view('menu', $data);
        echo view('suratkeluar', $data);
        echo view('footer');
    }
}

public function aksiTambahSuratKeluar(Request $request)
{
    $model = new eoffice();

    // Validasi input file lampiran
    $request->validate([
        'lampiran' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        'tanggal_terima' => 'required|date',
        'perihal' => 'required|string',
        'pengirim' => 'required|string',
    ]);

    // Upload lampiran
    if ($request->hasFile('lampiran')) {
        $lampiran = $request->file('lampiran');
        $lampiranPath = $lampiran->getClientOriginalName();
        $lampiran->move(public_path('dokumen'), $lampiranPath);
    } else {
        return back()->withErrors(['Lampiran tidak boleh kosong']);
    }

    // Data yang akan disimpan
    $data = [
        'lampiran' => $lampiranPath,
        'nomor_surat' => $request->input('nomor_surat'),
        'tanggal_terima' => $request->input('tanggal_terima'),
        'perihal' => $request->input('perihal'),
        'pengirim' => $request->input('pengirim'),
        'created_at' => Carbon::now(),
        'id_jenis' => 2 // Set id_jenis = 2 untuk Surat Keluar
    ];

    // Simpan data ke tabel 'suratkeluar'
    $model->tambah('suratkeluar', $data);

    return redirect()->back()->with('success', 'Surat Keluar berhasil ditambahkan.');
}

public function pengajuancuti()
    {
        $id_level = session()->get('id_level');
    
        // Cek apakah pengguna sudah login
        if (!$id_level) {
            return redirect()->route('login'); 
        } else {
            $model = new eoffice();
    
            $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
            $data['bagian'] = $model->tampil('level');  // Data level untuk akses berdasarkan Bagian
            $data['user'] = $model->tampil('user');  // Data user untuk akses pribadi
            $data['id_level'] = $id_level;
    
            echo view('header', $data);
            echo view('menu', $data);
            echo view('pengajuancuti', $data);
            echo view('footer');
        }
    }


public function aksiTambahCuti(Request $request)
{
    
    // Menghitung total hari
    $tanggalMulai = Carbon::parse($request->tanggal_mulai);
    $tanggalAkhir = Carbon::parse($request->tanggal_akhir);
    $totalHari = $tanggalMulai->diffInDays($tanggalAkhir) + 1; // Ditambah 1 hari untuk menghitung hari pertama

    // Data yang akan disimpan
    $data = [
        'nama' => $request->nama,
        'nik' => $request->nik,
        'id_level' => $request->jabatan,
        'tanggal' => $request->tanggal,
        'jenis_cuti' => $request->jenis_cuti,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_akhir' => $request->tanggal_akhir,
        'total_hari' => $totalHari,
        'tanggal_kembali' => $tanggalAkhir->copy()->addDay(),
        'diambil_alih' => $request->diambil_alih,
        'alamat' => $request->alamat,
        'keterangan' => $request->keterangan,
        'id_jenis' => 3
    ];

    // Simpan data ke dalam tabel 'pengajuancuti'
    $pengajuanCutiModel = new eoffice();
    $pengajuanCutiModel->tambah('pengajuancuti', $data);

    // Redirect atau kirim respon sesuai kebutuhan
    return redirect()->back()->with('success', 'Pengajuan cuti berhasil ditambahkan.');
}

public function datasuratmasuk()
{
    $id_level = session()->get('id_level');

    // Cek apakah pengguna sudah login
    if (!$id_level) {
        return redirect()->route('login'); 
    } else {
        $model = new eoffice();
        $data['suratmasuk'] = $model->join2('suratmasuk', 'jenis_surat', 'suratmasuk.id_jenis','jenis_surat.id_jenis');
        $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
        $data['bagian'] = $model->tampil('level');  // Data level untuk akses berdasarkan Bagian
        $data['user'] = $model->tampil('user');  // Data user untuk akses pribadi
        $data['id_level'] = $id_level;

        echo view('header', $data);
        echo view('menu', $data);
        echo view('datasuratmasuk', $data);
        echo view('footer');
    }
}

public function datasuratkeluar()
{
    $id_level = session()->get('id_level');

    // Cek apakah pengguna sudah login
    if (!$id_level) {
        return redirect()->route('login'); 
    } else {
        $model = new eoffice();
        $data['suratkeluar'] = $model->join2('suratkeluar', 'jenis_surat', 'suratkeluar.id_jenis','jenis_surat.id_jenis');
        $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
        $data['bagian'] = $model->tampil('level');  // Data level untuk akses berdasarkan Bagian
        $data['user'] = $model->tampil('user');  // Data user untuk akses pribadi
        $data['id_level'] = $id_level;

        echo view('header', $data);
        echo view('menu', $data);
        echo view('datasuratkeluar', $data);
        echo view('footer');
    }
}

public function dataketerlambatan()
{
    $id_level = session()->get('id_level');

    // Cek apakah pengguna sudah login
    if (!$id_level) {
        return redirect()->route('login'); 
    } else {
        $model = new eoffice();
        $data['keterlambatan'] = $model->join3('keterlambatan', 'jenis_surat','level', 'keterlambatan.id_jenis','jenis_surat.id_jenis','keterlambatan.id_level','level.id_level');
        $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
        $data['bagian'] = $model->tampil('level');  // Data level untuk akses berdasarkan Bagian
        $data['user'] = $model->tampil('user');  // Data user untuk akses pribadi
        $data['id_level'] = $id_level;

        echo view('header', $data);
        echo view('menu', $data);
        echo view('dataketerlambatan', $data);
        echo view('footer');
    }
}

public function datapengajuancuti()
{
    $id_level = session()->get('id_level');

    // Cek apakah pengguna sudah login
    if (!$id_level) {
        return redirect()->route('login'); 
    } else {
        $model = new eoffice();
        $data['pengajuancuti'] = $model->join3('pengajuancuti', 'jenis_surat','level', 'pengajuancuti.id_jenis','jenis_surat.id_jenis','pengajuancuti.id_level','level.id_level');
        $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);
        $data['bagian'] = $model->tampil('level');  // Data level untuk akses berdasarkan Bagian
        $data['user'] = $model->tampil('user');  // Data user untuk akses pribadi
        $data['id_level'] = $id_level;

        echo view('header', $data);
        echo view('menu', $data);
        echo view('datapengajuancuti', $data);
        echo view('footer');
    }
}

public function deletesuratmasuk($id)
{
    $model = new eoffice();

    $data = [
        'deleted_at' => date('Y-m-d H:i:s')
    ];

    $model->edit('suratmasuk', ['id_suratmasuk' => $id], $data);

    return redirect('datasuratmasuk');
}

public function restoredeletesuratmasuk()
{
$id_level = session()->get('id_level');

if (!$id_level) {
    return redirect()->route('login');
} elseif ($id_level != 1) {
    return redirect()->route('error404');
} else {
    $model = new eoffice();

    // Ambil pengaturan dari tabel setting
    $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);

    // Ambil mobil yang memiliki deleted_at IS NOT NULL
    $data['deletesuratmasuk'] = DB::table('suratmasuk')
                        ->whereNotNull('deleted_at')
                        ->get(); // Menggunakan query builder Laravel

$data['id_level'] = $id_level; 
    echo view('header', $data);
    echo view('menu', $data);
    echo view('restoredeletesuratmasuk', $data);
    echo view('footer');
}
}

public function restoreSuratMasuk($id)
{
    $model = new eoffice();

    // Mengembalikan suratmasuk dengan mengubah deleted_at menjadi NULL
    $data = [
        'deleted_at' => NULL
    ];

    // Update suratmasuk berdasarkan ID yang dipilih
    $model->edit('suratmasuk', ['id_suratmasuk' => $id], $data);

    // Redirect ke halaman restore suratmasuk
    return redirect('restoredeletesuratmasuk');
}

public function deletesuratkeluar($id)
{
    $model = new eoffice();

    $data = [
        'deleted_at' => date('Y-m-d H:i:s')
    ];

    $model->edit('suratkeluar', ['id_suratkeluar' => $id], $data);

    return redirect('datasuratkeluar');
}

public function restoredeletesuratkeluar()
{
$id_level = session()->get('id_level');

if (!$id_level) {
    return redirect()->route('login');
} elseif ($id_level != 1) {
    return redirect()->route('error404');
} else {
    $model = new eoffice();

    // Ambil pengaturan dari tabel setting
    $data['darren2'] = $model->getWhere('setting', ['id_setting' => 1]);

    // Ambil mobil yang memiliki deleted_at IS NOT NULL
    $data['deletesuratkeluar'] = DB::table('suratkeluar')
                        ->whereNotNull('deleted_at')
                        ->get(); // Menggunakan query builder Laravel

$data['id_level'] = $id_level; 
    echo view('header', $data);
    echo view('menu', $data);
    echo view('restoredeletesuratkeluar', $data);
    echo view('footer');
}
}

public function restoreSuratKeluar($id)
{
    $model = new eoffice();

    // Mengembalikan suratmasuk dengan mengubah deleted_at menjadi NULL
    $data = [
        'deleted_at' => NULL
    ];

    // Update suratmasuk berdasarkan ID yang dipilih
    $model->edit('suratkeluar', ['id_suratkeluar' => $id], $data);

    // Redirect ke halaman restore suratmasuk
    return redirect('restoredeletesuratkeluar');
}

}




