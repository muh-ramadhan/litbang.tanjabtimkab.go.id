<?php
$pdf = new PDF_MC_Table();





function ceknol($nilai){
  if($nilai=='0' or $nilai=='') {
    $nilai='-';
  }
  else {
    $nilai=$nilai;
  }
  return $nilai;
}




if ($ada!=0) {

//$tahun=$tahun;
//$tahundata=$tahun;
//$bulandata=$bulan;
  $idberita=$idberita;



  $namaBulan = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");


  $pdf->AliasNbPages();
  $pdf->SetMargins(18,15,10);
  $pdf->AddPage('P','A4');

  $pdf->Image(base_url()."style/images/logo.jpg",20,$x,160	,0,'JPG');
//$pdf->Image("../polres/style/images/logo.jpg",20,$x,160	,0,'JPG');

  $x=40;
$pdf->Line(20, $x, 190, $x); // garis atas orang tua

$tampil=mysql_query("SELECT * FROM berita where id_berita='$idberita'");
$raa=mysql_fetch_array($tampil);
$photopath = str_replace('-', '/', $raa[tanggal_modif]);

$tanggal=$raa[tanggal];
$hari = nama_hari($tanggal).', ';
$tgl =  tgl_indo($tanggal).' | ';
$jam =  $raa[jam].' WIB ';


//$pdf->SetFont('helvetica','b',12);
//$pdf->SetFont('arial','b',15);
//$pdf->Cell('','',$raa[judul].'','',1,'L',0);
$pdf->SetFont('helvetica','',10);
//$x=$pdf->GetY();

$x=$pdf->GetY();
$pdf->SetY($x+8);
//$pdf->SetX(18);
$pdf->SetWidths(array(170));
$pdf->SetAligns(array('L'));
$pdf->SetFont('helvetica','b',15);
$pdf->Judul(array($raa[judul].' '));

$x=$pdf->GetY();
$pdf->SetY($x+2);
$pdf->SetWidths(array(170));
$pdf->Judul(array(''));

$x=$pdf->GetY();
$pdf->SetY($x+3);
$pdf->SetWidths(array(170));
$pdf->SetAligns(array('L'));
$pdf->SetFont('helvetica','',8);
$pdf->Judul(array($hari.''.$tgl.''.$jam));

$x=$pdf->GetY()+4;

//$pdf->Image('http://localhost/polres/foto_berita/2015/09/29/15MASKER.jpg',22,11,22);
$pdf->Image(base_url()."foto_berita/".$photopath."/".$raa[gambar],20,$x,120,65,'jpg');
//$pdf->Image("../polres/foto_berita/".$photopath."/".$raa[gambar],20,$x,120,65,'JPG');

$x=$pdf->GetY()+4;
$pdf->SetY($x);
$pdf->SetX(145);
$pdf->SetWidths(array(40));
$pdf->SetAligns(array('L'));
$pdf->SetFont('helvetica','i',8);
$pdf->Rowpenduduk(array($raa[text_foto]));


function strip_word_html($text, $allowed_tags = '<b><i><sup><sub><em><strong><u><br>')
{
  mb_regex_encoding('UTF-8');
        //replace MS special characters first
  $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u', '/&ndash;/u');
  $replace = array('\'', '\'', '"', '"', '-');
  $text = preg_replace($search, $replace, $text);
        //make sure _all_ html entities are converted to the plain ascii equivalents - it appears
        //in some MS headers, some html entities are encoded and some aren't
  $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        //try to strip out any C style comments first, since these, embedded in html comments, seem to
        //prevent strip_tags from removing html comments (MS Word introduced combination)
  if(mb_stripos($text, '/*') !== FALSE){
    $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
  }
        //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be
        //'<1' becomes '< 1'(note: somewhat application specific)
  $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
  $text = strip_tags($text, $allowed_tags);
        //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one
       // $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
        //strip out inline css and simplify style tags
  $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
  $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
  $text = preg_replace($search, $replace, $text);
        //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears
        //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains
        //some MS Style Definitions - this last bit gets rid of any leftover comments */

/*	   $num_matches = preg_match_all("/\<!--/u", $text, $matches);
        if($num_matches){
              $text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
        }
		*/
        return $text;
      }

      $x=$pdf->GetY()+42;
      $pdf->SetY($x);
      $pdf->SetWidths(array(170));
      $pdf->SetAligns(array('L'));
      $pdf->SetFont('helvetica','',9);

      function strip_word_html2($text)
      {
//$cleanString = htmlentities($cleanString, ENT_QUOTES, "UTF-8");
        $text = html_entity_decode(htmlentities(filter_var($text, FILTER_SANITIZE_STRING)));
        $text=strip_word_html((htmlspecialchars_decode($text, ENT_COMPAT)));
        return $text;
      }
//$pdf->Rowpenduduk(array($raa[isi_berita].' '));

      $data = explode("</p>", $raa[isi_berita]);

      $pdf->Rowpenduduk(array(strip_word_html2($data[0]).' '));
      $pdf->SetY($pdf->GetY()-5);
      $pdf->Rowpenduduk(array(strip_word_html2($data[1]).' '));
      $pdf->SetY($pdf->GetY()-5);
      $pdf->Rowpenduduk(array(strip_word_html2($data[2]).' '));
      $pdf->SetY($pdf->GetY()-5);
      $pdf->Rowpenduduk(array(strip_word_html2($data[3]).' '));
      $pdf->SetY($pdf->GetY()-5);
      $pdf->Rowpenduduk(array(strip_word_html2($data[4]).' '));

      if ($data[5]!='') {
        $pdf->SetY($pdf->GetY()-5);
        $pdf->Rowpenduduk(array(strip_word_html2($data[5]).' '));
      }
      if ($data[6]!='') {
        $pdf->SetY($pdf->GetY()-5);
        $pdf->Rowpenduduk(array(strip_word_html2($data[6]).' '));
      }
      if ($data[7]!='') {
        $pdf->SetY($pdf->GetY()-5);
        $pdf->Rowpenduduk(array(strip_word_html2($data[7]).' '));
      }
      if ($data[8]!='') {
        $pdf->SetY($pdf->GetY()-5);
        $pdf->Rowpenduduk(array(strip_word_html2($data[8]).' '));
      }
      if ($data[9]!='') {
        $pdf->SetY($pdf->GetY()-5);
        $pdf->Rowpenduduk(array(strip_word_html2($data[9]).' '));
      }
      if ($data[10]!='') {
        $pdf->SetY($pdf->GetY()-5);
        $pdf->Rowpenduduk(array(strip_word_html2($data[10]).' '));
      }

//$pdf->Rowpenduduk(array($cleanString.' '));

      $x=$pdf->GetY()+2;
      $pdf->SetY($x);
      $pdf->SetWidths(array(170));
      $pdf->SetAligns(array('L'));
      $pdf->SetFont('helvetica','i',8);
      $pdf->Rowpenduduk(array("Sumber: ".$raa[sumber]));

//$pdf->centreImage("../polres/foto_berita/2015/09/29/15MASKER.jpg");

      $pdf->Output('Laporan-kependudukan.pdf','I');

    }
    else {

      ?>
      <br><br><br><br>
      <center><h1>!!! MAAF, DATA BELUM TERSEDIA</h1>
        <h3><a href="<?php echo base_url(); ?>">Kembali ke Home</h3>
        </center>
        <?php
      }
      ?>