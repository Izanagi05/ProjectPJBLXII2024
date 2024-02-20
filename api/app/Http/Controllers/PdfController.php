<?php

namespace App\Http\Controllers;

use App\Models\RW;
use App\Models\User;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use TCPDF;

class PdfController extends Controller
{
    public function exportPDF(Request $request)
    {
        try {
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('user_id', 1)->first();
            $dataRw = RW::first();
            // $data = User::where('remember_token', $token)->first();
            $data->UserProvinsi;
            $detailalamats = $data->DetailAlamats;
            //    unset($data->DetailAlamats);
            $wargaperalamats = [];

            foreach ($detailalamats as $key => $dtdetail) {
                $dtdetail->Alamat->RT;
                $wargaperalamats[] = $dtdetail->Wargas;
                $dtdetail['jumlah_wargas'] = count($dtdetail->Wargas);
            }
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
            $pdf->Cell(0, 15, ': ' . $data->nama, 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(10);
            $pdf->Cell(50, 15, 'Tempat Tanggal Lahir', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Cell(0, 15, ': ' . $data->UserProvinsi->provinsi . ', ' . $data->tgl_lahir, 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(10);
            $pdf->Cell(50, 15, 'Jenis Kelamin', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Cell(0, 15, ': ' . $data->jenis_kelamin, 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(10);
            $pdf->Cell(50, 15, 'Pekerjaan', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Cell(0, 15, ': ' . $data->pekerjaan, 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(10);
            $pdf->Cell(50, 15, 'NO. KTP / NIK', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Cell(0, 15, ': ' . $data->nik, 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(10);
            $pdf->Cell(50, 15, 'No KK', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Cell(0, 15, ': ' . $data->no_kk, 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(10);
            $pdf->Cell(50, 15, 'Alamat', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Cell(0, 15, ': ', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(10);
            $pdf->setCellHeightRatio(1.5);
            $pdf->MultiCell(0, 15, 'Adalah benar yang bersangkutan adalah Warga Rt.002' . $dataRw->nama . ' ' . $dataRw->alamat . ', dalam hal ini memerlukan Surat Pengantar Untuk Keperluan:   ', 0, 'L', false, 20);
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
            $pdf->Cell(0, 15, ':Nomor:' . $dataRw->no . '/RT002/' . $dataRw->tanggal, 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(10);
            $pdf->Cell(50, 15, 'Tanggal', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Cell(0, 15, ': 01-01-2024', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(10);
            $pdf->setCellHeightRatio(1.5);
            $pdf->Cell(0, 15, 'mengetahui', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Cell(0, 15, $dataRw->kota, 0, false, 'R', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 15, 'Ketua RT 002', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Cell(0, 15, $dataRw->nama, 0, false, 'R', 0, '', 0, false, 'M', 'L');
            $pdf->Ln(30);
            $pdf->Cell(0, 15, 'Suisis wiakiw', 0, false, 'L', 0, '', 0, false, 'M', 'L');
            $pdf->Cell(0, 15, $dataRw->ketua_rw, 0, false, 'R', 0, '', 0, false, 'M', 'L');

            setlocale(LC_TIME, 'id_ID');
            $urlFotoKK =  public_path('storage/'.$data->foto_kk);
            $urlFotoKtp =  public_path('storage/'.$data->foto_ktp);
            // dd($urlFotoKK);

            // Tambahkan halaman
            $pdf->AddPage();
            $lebarHalaman = $pdf->getPageWidth();
            $tinggiHalaman = $pdf->getPageHeight();

            $lebarGambar = 0; // Lebar gambar dalam satuan mm
            $tinggiGambar = 0; // Tinggi gambar dalam satuan mm
            $x1 = 0; // Koordinat X gambar pertama
            $y1 =0; // Koordinat Y gambar pertama

            // Set posisi gambar kedua (bawah)
            $x2 = 0; // Koordinat X gambar kedua
            $y2 = 100; // Koordinat Y gambar kedua

            // Sisipkan gambar ke dalam dokumen PDF
            $pdf->Image($urlFotoKK, $x1, $y1, $lebarGambar, $tinggiGambar, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false);
            $pdf->Image($urlFotoKtp, $x2, $y2, $lebarGambar, $tinggiGambar, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false);

            $carbon = Carbon::now();
            $fileName = $carbon->formatLocalized('%Y-%m-%d');
            $pdfname = 'data_namaorang' . $fileName;
            $pdf->Output($pdfname . '.pdf', 'I');
            //code...
            return response()->json([
                'data' => $data,
                'message' => 'data user login',
                'success' => true
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th,
                'success' => false
            ], 500);
        }

        // Tampilkan atau unduh PDF

        // return $pdf->stream('document.pdf');
    }
}
