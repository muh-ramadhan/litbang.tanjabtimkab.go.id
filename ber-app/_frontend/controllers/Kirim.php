<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kirim extends CI_Controller {

	function __construct(){  
		parent::__construct();
		$this->load->helper(array('html','form','url','text'));  
	}
    
 public function kirimemail() {
		$this->load->library('email');
		$jenis='01';
		if ($jenis=='01') {
			$keterangan="Surat Keterangan Berkelakuan Baik";
		} 
		
		$email_config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => '465',
            'smtp_user' => 'tanjabtimkab@gmail.com',
            'smtp_pass' => '?jangkrik(2017).men',
            'mailtype'  => 'html',
            'starttls'  => true,
            'newline'   => "\r\n"
        );

        $this->load->library('email', $email_config);
		
		/*
		$this->email->to('alamat_tujuan@namadomain.com');
		$this->email->from('admin@jurnalweb.com','Jurnalweb');
		$this->email->subject('JUDUL EMAIL (Teks)');
		$this->email->message('Isi email ditulis disini');
		$this->email->send();
		*/
		//$email_body = $this->load->view('v_email', true);
		$htmlContent = '<!DOCTYPE html>
		<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Go Upsell Email</title> 
    <style type="text/css">
    /* Take care of image borders and formatting */

    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important; }
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass {width:100%;}
    .backgroundTable {margin:0 auto; padding:0; width:100%;!important;}
    table td {border-collapse: collapse;}
    .ExternalClass * {line-height: 115%;}


    /* General styling */

    td {
      font-family: Arial, sans-serif;
      color: #5e5e5e;
      font-size: 16px;
      text-align: left;
    }

    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #5e5e5e;
      font-weight: 400;
      font-size: 16px;
    }


    h1 {
      margin: 10px 0;
    }

    a {
      color: #2b934f;
      text-decoration: none;
    }


    .body-padding {
      padding: 0 75px;
    }


    .force-full-width {
      width: 100% !important;
    }

    .icons {
      text-align: right;
      padding-right: 30px;
    }

    .logo {
      text-align: left;
      padding-left: 30px;
    }

    .computer-image {
      padding-left: 30px;
    }

    .header-text {
      text-align: left;
      padding-right: 30px;
      padding-left: 20px;
    }

    .header {
      color: #232925;
      font-size: 24px;
    }

    .steps {
      width: 85px;
      height: 86px;
    }

    .steps-text {
      width: 85px;
      font-size: 14px;
      text-align: top;
    }

    .step-table {
      width: 340px;
    }



    </style>

    <style type="text/css" media="screen">
        @media screen {
          @import url(http://fonts.googleapis.com/css?family=PT+Sans:400,700);
          /* Thanks Outlook 2013! */
          * {
            font-family: PT Sans, Helvetica Neue, Arial, sans-serif !important;
          }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 599px)">
      /* Mobile styles */
      @media only screen and (max-width: 599px) {

        table[class*="w320"] {
          width: 320px !important;
        }

        td[class*="icons"] {
          display: block !important;
          text-align: center !important;
          padding: 0 !important;
        }

        td[class*="logo"] {
          display: block !important;
          text-align: center !important;
          padding: 0 !important;
        }

        td[class*="computer-image"] {
          display: block !important;
          width: 230px !important;
          padding: 0 45px !important;
          border-bottom: 1px solid #e3e3e3 !important;
        }


        td[class*="header-text"] {
          display: block !important;
          text-align: center !important;
          padding: 0 25px!important;
          padding-bottom: 25px !important;
        }

        *[class*="mobile-hide"] {
          display: none !important;
          width: 0 !important;
          height: 0 !important;
          line-height: 0 !important;
          font-size: 0 !important;
        }

        td[class="steps"] {
          width: 65px !important;
          height: 66px !important;
        }

        td[class="steps-text"] {
          width: 65px !important;
          text-align: top !important;
        }

        img[class*="steps"] {
          width: 65px !important;
          height: 66px !important;
        }

        table[class*="step-table"] {
        width: 250px !important;
        }

      }
    </style>
  </head>
  <body  offset="0" class="body" style="padding:0; margin:0; display:block; background:#fbfbfb; -webkit-text-size-adjust:none" bgcolor="#fbfbfb">
  <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
      <td align="center" valign="top" style="background-color:#fbfbfb" width="100%">

      <center>
        <table cellspacing="0" cellpadding="5" width="600" class="w320">
          <tr>
            <td align="center" valign="top">

              <table  style="width: 100% !important;"  cellpadding="10" cellspacing="0"  bgcolor="#fff">
                <tr>
                  <td style="background-color:#fff" align="center" style="text-align: center;">
                    <br>
                    <a href="#"><img src="http://bermultimedia.com/images/email2.png" alt="Logo"></a>
                  </td>
                  
                </tr>
              </table>

              <table cellspacing="0" cellpadding="0" class="force-full-width" bgcolor="#232925">
                <tr>
                  <td class="computer-image">
                     
                    <br class="mobile-hide" />
                    <img style="display:block;" width="224" height="213" src="https://www.filepicker.io/api/file/CoMxXSlVRDuRQWNwnMzV" alt="hello">
                  </td>
                 <td style="color: #ffffff;" class="header-text">
                    <br>
                    <br>
                    <span style="font-size: 24px;">Terima Kasih</span><br><br>
                     Telah Menggunakan e-Yankel Kelurahan Sungai Lakam Timur Timur, dengan menggunakan layanan ini diharapkan dapat memudahkan warga dalam pengurusan administrasi surat menyurat ke Kelurahan.
                    <br> 
                  </td>
                </tr>
              </table>

  <table class="force-full-width" cellspacing="0" cellpadding="30" bgcolor="#ebebeb">
                <tr>
                  <td class="mobile-block" style="width: 170px; vertical-align:top;">
                    <table cellspacing="0" cellpadding="0" width="100%">
                      <tr>
                        <td> 
                          Kami telah menerima surat yang Anda ajukan dengan rincian sebagai berikut: <br><br>
						  Alamat e-Mail<br>
						  <div style="margin-top:5px;color: #232925; font-size: 16px;font-weight:bold;">joni.trumanbe@gmail.com</div><br>  
						Dengan Menginput Email yang benar, Akun anda akan Otomatis Ter-Register pada Sistem Pelayanan Online.<br>
						  <div style="margin-top:5px;color: #232925; font-size: 16px;font-weight:bold;">Password Anda: #!jak </div><br> 
<div>
                                <a href="http://" style="background-color:#2b934f;color:#ffffff;display:inline-block;font-family:Helvetcia, sans-serif;font-size:16px;font-weight:light;line-height:40px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;">Activation Link</a>
                          </div><br>
 Untuk Mengaktifkan Akun Anda, silahkan <b>KLIK Activation Link</b> di atas.<br>						  
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td class="mobile-block" width="325">
                    <table cellspacing="0" cellpadding="0" width="100%">
                      <tr>
                        <td>
                          <table cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                              <td style="background-color: #dedede; padding: 5px; font-weight: bold;">
                                Jenis Surat
                              </td>
                            </tr>
                            <tr>
                              <td style="background:#fff;background-color:#fff; padding: 10px 5px;">
                               Surat Permohonan IMB
                              </td>
                            </tr>
                          </table>
                          &nbsp;
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                              <td  style="background-color: #dedede; padding: 5px; font-weight: bold;">
                                Tanggal Pengajuan
                              </td>
                            </tr>
                            <tr>
                              <td style="background:#fff;background-color:#fff; padding: 10px 5px;">
                               Jumat, 23 Agustus 2018
                              </td>
                            </tr>
                          </table>
                          &nbsp;
                        </td>
                      </tr>
					  <tr>
                        <td>
                          <table cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                              <td  style="background-color: #dedede; padding: 5px; font-weight: bold;">
                                Atas Nama
                              </td>
                            </tr>
                            <tr>
                              <td style="background:#fff;background-color:#fff; padding: 10px 5px;">
                               Joni Trimulya
                              </td>
                            </tr>
                          </table>
                          &nbsp;
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                              <td  style="background-color: #dedede; padding: 5px; font-weight: bold;">
                                No. HP
                              </td>
                            </tr>
                            <tr>
                              <td style="background:#fff;background-color:#fff; padding: 10px 5px;">
                               Joni Trimulya
                              </td>
                            </tr>
                          </table> 
						   &nbsp;
                        </td>
                      </tr>
					  
					   <tr>
                        <td>
                          <table cellspacing="0" cellpadding="0" width="100%"> 
                            <tr>
                              <td style="background:#fff;background-color:#fff; padding: 10px 5px;">
                               <b>Tracking ID:</b> <span style="color:#ff0000;font-size:18px;font-weight:bold;"> VPKDF125168</span>
                              </td>
                            </tr>
                          </table> 
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>


              <table cellspacing="0" cellpadding="0" class="force-full-width" bgcolor="#ebebeb">
                <tr>
                  <td style="padding: 0 30px; padding-bottom: 30px;">
                    Proses Selanjutnya akan kami notifikasikan melalui <b>Email </b>anda atau melalui <b>SMS ke No. HP</b> Anda, Terima Kasih<br><br>
                    Ttd,<br>
                    Kelurahan Sungai Lakam Timur
                  </td>
                </tr>
              </table>


              <table style="width: 100% !important;" cellspacing="0" cellpadding="20" bgcolor="#2b934f">
                <tr>
                  <td style="background-color:#2b934f; color:#ffffff; font-size: 14px; text-align: center;">
                    © 2018 All Rights Reserved, Kel. Sungai Lakam Timur<br>
					<span style="font-size:10px;">Developed by: <a style="color:#fff;" href="http://bermultimedia.com" target="_blank">Bermultimedia.com</a></span>
                  </td>
                </tr>
              </table>
			  
            </td>
          </tr>
        </table>

      </center>
      </td>
    </tr>
  </table>
  </body>
</html>';
			
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		//$recipientArr = array('bermultimedia@gmail.com');
		$this->email->to('bujangprint@gmail.com');
		$this->email->from('tanjabtimkab@gmail.com','Admin e-Yankel');
		//$this->email->to('joni.trumanbe@bermultimedia.com');
		//$this->email->cc('satu@example.com');
		//$this->email->bcc('alamat_email_lain@example.com');
		//$this->email->to('satu@example.com, dua@example.com, tiga@example.com');
		//$this->email->from('info@kecjambitimur.com','Admin e-Yankel');
		$this->email->subject(''.$keterangan.'');
		$this->email->message($htmlContent);
		//$this->email->attach('LOKASI_FOLDER_FILE/NAMA_FILE_attachment.pdf');
		$this->email->send();
	
	
	} 

	public function denied () {
		$data['vdata']='access-denied';  
		$data['judulapp']="Access Denied";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);
	}
	
	public function redirect () {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."kegiatan'>";
	} 
}

