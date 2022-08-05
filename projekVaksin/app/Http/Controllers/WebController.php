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
            'title' => 'SISTEM INFORMASI GEOGRAFIS PERSEBARAN VAKSINASI KAB.SUKOHARJO',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'jadwal' => $this->WebModel->Jadwal7hari(),
            'vaksin' => $this->WebModel->AllDataVaksin(),
        ];
        return view('v_web', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'ABOUT',
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
        $mail->Host       = 'sigvaksinsukoharjo.my.id';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'vaksinskh@sigvaksinsukoharjo.my.id';
        $mail->Password   = 'Sukoharjomakmur11';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('vaksinsukoharjo@gmail.com');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Kritik dan Saran SIG Vaksinasi Sukoharjo mengenai ' . $subject;
        $mail->Body    = $message;

        $mail->send();
        return redirect()->route('about')->with('pesan', 'Berhasil mengirimkan Email');
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
            'cari' => $cari,
            'vaksin' => $this->WebModel->CariDataVaksin($cari),
        ];
        return view('v_cari', $data);
    }

    public function tempatvaksin()
    {
        $data = [
            'title' => 'TEMPAT VAKSINASI KAB.SUKOHARJO',
            'vaksin' => $this->WebModel->TempatVaksin(),
            'kecamatan' => $this->WebModel->DataKecamatan(),
        ];

        return view('v_tempatVaksin', $data);
    }

    public function kecamatan()
    {
        Request()->validate(
            [
                'kecamatan' => 'required',
            ],
            [
                'kecamatan.required' => 'Pilih Kecamatan !!!',
            ]
        );
        $id_kecamatan = Request()->kecamatan;
        $kec = $this->WebModel->KecamatanById($id_kecamatan);
        $data = [
            'title' => 'TEMPAT VAKSINASI DI KECAMATAN ' . $kec->nama_kecamatan,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'kec' => $kec,
            'vaksin' => $this->WebModel->DataVaksinbyKecamatan($id_kecamatan),
        ];

        return view('v_kecamatan', $data);
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
