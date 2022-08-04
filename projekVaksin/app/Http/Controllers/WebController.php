<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->WebModel = new WebModel();
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Sistem Informasi Geografis Persebaran Vaksinasi Kabupaten Sukoharjo',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'jadwal' => $this->WebModel->Jadwal7hari(),
            'vaksin' => $this->WebModel->AllDataVaksin(),
        ];
        return view('v_web', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
        ];

        return view('v_about', $data);
    }

    public function send(Request $request)
    {
        Request()->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ],
            [
                'name.required' => 'Wajib diisi !!!',
                'email.required' => 'Wajib diisi !!!',
                'subject.required' => 'Wajib diisi !!!',
                'message.required' => 'Wajib diisi !!!',
            ]
        );
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        require 'PHPMailer/vendor/autoload.php';
        require 'PHPMailer/vendor/phpmailer/phpmailer/src/Exception.php';
        require 'PHPMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require 'PHPMailer/vendor/phpmailer/phpmailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'fositiv2020@gmail.com';
        $mail->Password   = 'hjuozpbivjudhgrs';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('fositiv2020@gmail.com');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Kritik dan Saran SIG Vaksinasi Sukoharjo mengenai ' . $subject;
        $mail->Body    = $message;

        $mail->send();
        return redirect()->route('about')->with('pesan', 'Berhasil mengirimkan Email');

        // $dt = $mail->send();
        // if ($dt) {
        //     return redirect()->route('about')->with('pesan', 'Berhasil mengirimkan Email');
        // } else {
        //     echo 'waduw';
        // }
    }

    public function cari()
    {
        Request()->validate(
            [
                'cari' => 'required',
            ],
            [
                'cari.required' => 'Tidak Boleh Kosong !!!',
            ]
        );

        $cari = Request()->cari;
        $data = [
            'title' => 'Cari Tempat Vaksin',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            // 'jenis' => $this->WebModel->DataJenis(),
            'cari' => $cari,
            'vaksin' => $this->WebModel->CariDataVaksin($cari),
        ];
        return view('v_cari', $data);
    }

    public function tempatvaksin()
    {
        $data = [
            'title' => 'Tempat Vaksinasi Di Kab.Sukoharjo ',
            'vaksin' => $this->WebModel->TempatVaksin(),
            'kecamatan' => $this->WebModel->DataKecamatan(),
        ];

        return view('v_tempatVaksin', $data);
    }

    public function detail($id_tempatVaksin)
    {
        $tvaksin = $this->WebModel->DataVaksinById($id_tempatVaksin);
        $data = [
            'title' => 'Detail Tempat Vaksin ' . $tvaksin->nama_tempatVaksin,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'jadwal' => $this->WebModel->JadwalByTempatVaksin($id_tempatVaksin),
            'vaksin' => $this->WebModel->DataVaksinById($id_tempatVaksin),
        ];

        return view('v_detail', $data);
    }
}
