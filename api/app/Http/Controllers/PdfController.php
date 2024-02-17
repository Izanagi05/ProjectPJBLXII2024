<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use TCPDF;

class PdfController extends Controller
{
    public function exportPDF()
    {
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Set informasi dokumen
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('PDF Example');
    $pdf->SetSubject('Example PDF');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    //     // Set default header data
    $judulHeader = 'RT.002 / RW.007';
$stringHeader = 'KELURAHAN CIKETING UDIK - KECAMATAN BANTAR GEBANG';
// Tambahkan judul header dengan Cell

// $pdf->setHeaderFont(Array('times', '', 12));

//     $pdf->SetHeaderData(
//         PDF_HEADER_LOGO,  // Path ke logo
//         20,          // Lebar logo
//         $judulHeader, // Judul header
//         $stringHeader, // String header
//         true ,// Show header
//         'C',
//         12
//     );

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Set font
    $pdf->SetFont('times', '', 20);
    $pdf->SetPrintHeader(false);

    // Add a page
    $pdf->AddPage();
    $pdf->SetFont('times', 'B U', 14); // Mengatur font menjadi bold
    // $pdf->Ln(10);
    $pdf->Cell(0, 15, 'SURAT PENGANTAR:', 0, false, 'C', false, '', 0, false, 'M', 'L');
    $pdf->Ln(5);
    $pdf->SetFont('times', 'B', 10); // Mengatur font menjadi bold
    $pdf->Cell(0, 15, 'Nomor:006/RT002/01/2024', 0, false, 'C', false, '', 0, false, 'M', 'L');
    $pdf->Ln(10);

    $pdf->SetFont('times', '', 12);
    $pdf->Cell(0, 15, 'Dengan ini kami menerangkan bahwa:', 0, false, 'L', false, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->Cell(50, 15, 'Nama', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, ': ', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->Cell(50, 15, 'Tempat Tanggal Lahir', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, ': ', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->Cell(50, 15, 'Jenis Kelamin', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, ': ', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->Cell(50, 15, 'Pekerjaan', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, ': ', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->Cell(50, 15, 'NO. KTP / NIK', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, ': ', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->Cell(50, 15, 'No KK', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, ': ', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->Cell(50, 15, 'Alamat', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, ': ', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->setCellHeightRatio(1.5);
    $pdf->MultiCell(0, 15, 'Adalah benar yang bersangkutan adalah Warga Rt.002 Rw.007 Ciketing udik, dalam hal ini memerlukan Surat Pengantar Untuk Keperluan:   ', 0,'L', false, 20);
    $pdf->Ln(5);
    $pdf->SetFont('times', 'U B', 12);
    $pdf->Cell(0, 15, 'Test Pindah Rumah', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(0, 15, 'Keterangan lain', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->Cell(0, 15, 'Demikian Surat Pengantar Dibuat untuk sebagaimana mestinya', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->Cell(50, 15, 'NO', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, ':Nomor:006/RT002/01/2024', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->Cell(50, 15, 'Tanggal', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, ': 01-01-2024', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(10);
    $pdf->setCellHeightRatio(1.5);
    $pdf->Cell(0, 15, 'mengetahui', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, 'Kota Bekasi', 0, false, 'R', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(5);
    $pdf->Cell(0, 15, 'Ketua RT 002', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, 'Ketua RW 007', 0, false, 'R', 0, '', 0, false, 'M', 'L');
    $pdf->Ln(30);
    $pdf->Cell(0, 15, 'Suisis wiakiw', 0, false, 'L', 0, '', 0, false, 'M', 'L');
    $pdf->Cell(0, 15, 'Nama Rw 009', 0, false, 'R', 0, '', 0, false, 'M', 'L');

    setlocale(LC_TIME, 'id_ID');
    $carbon = Carbon::now();
    $fileName = $carbon->formatLocalized('%Y-%m-%d');
    $pdfname = 'data_namaorang' . $fileName;
    $pdf->Output($pdfname.'.pdf', 'I');


    // Tampilkan atau unduh PDF

    // return $pdf->stream('document.pdf');
}
}
