<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\Laporan;
use App\Models\RW;
use App\Models\User;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;
use TCPDF;

class PdfController extends Controller
{

    public function exportPDF(Request $request, $laporan_id, $detail_alamat_id, $alamat_id)
    {
        // try {
        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/pdf");
        $authorizationHeader = $request->header('Authorization');
        // $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iLCJpYXQiOjE3MDg0NzU1NDcsImV4cCI6MTcwODQ3OTE0NywibmJmIjoxNzA4NDc1NTQ3LCJqdGkiOiJBOElncXVQc2NUdlNOUmFCIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.zwnU9dPcAL5MgOVidrgDX4fDURfjzi3meo6o-XbdYjg';
        $token = str_replace('Bearer ', '', $authorizationHeader);
        $dataLaporan = Laporan::where('laporan_id', $laporan_id)->first();
        $data = User::where('remember_token', $token)->first();
        $dataRw = RW::first();
        if($data->nik===null||$data->pekerjaan===null||$data->no_kk ===null ){
            return response()->json([
                            'data' => null,
                            'message' => 'Data tidak lengkap',
                            'success' => false
                        ], 500);
        }
        // $data = User::where('remember_token', $token)->first();

        // dd($data);
        // $data->UserProvinsi;
        // $detailalamats = $data->DetailAlamats;
        //    unset($data->DetailAlamats);
        $wargaperalamats = [];
        $dataAlamatterpilih = Alamat::where('alamat_id', $alamat_id)->first();
        $dataDetailAlamatterpilih = DetailAlamat::where('alamat_id', $dataAlamatterpilih->alamat_id)->where('detail_alamat_id', $detail_alamat_id)->first();
        $tanggalnow =Carbon::now()->format('d-m-Y');
        // dd($dataDetailAlamatterpilih);
        // foreach ($data->DetailAlamats as $key => $dtdetail) {
        //     $dtdetail->Alamat->RT;
        //     $wargaperalamats[] = $dtdetail->Wargas;
        //     $dtdetail['jumlah_wargas'] = count($dtdetail->Wargas);
        // }
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set informasi dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('PDF Example');
        $pdf->SetSubject('Example PDF');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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
        $pdf->Cell(0, 15, 'Nomor:' . $dataRw->no . '/' .  $dataAlamatterpilih->RT->rt  . '/' .  $dataRw->tanggal, 0, false, 'C', false, '', 0, false, 'M', 'L');
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
        $pdf->Cell(0, 15, ': ' . $dataAlamatterpilih->nama . ', ' . $dataDetailAlamatterpilih->nama, 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Ln(10);
        $pdf->setCellHeightRatio(1.5);
        $pdf->MultiCell(0, 15, 'Adalah benar yang bersangkutan adalah Warga ' . $dataAlamatterpilih->RT->rt .' ' . $dataRw->nama . ' ' . $dataRw->alamat . ', dalam hal ini memerlukan Surat Pengantar Untuk Keperluan:   ', 0, 'L', false, 20);
        $pdf->Ln(5);
        $pdf->SetFont('times', 'U B', 12);
        $pdf->Cell(0, 15, $dataLaporan->keperluan, 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Ln(10);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 15, 'Keterangan lain', 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Ln(10);
        $pdf->Cell(0, 15, 'Demikian Surat Pengantar Dibuat untuk sebagaimana mestinya', 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Ln(10);
        $pdf->Cell(50, 15, 'NO', 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Cell(0, 15, ': Nomor:' . $dataRw->no . '/' . $dataAlamatterpilih->RT->rt  . '/' . $dataRw->tanggal, 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Ln(10);
        $pdf->Cell(50, 15, 'Tanggal', 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Cell(0, 15, ': '.$tanggalnow, 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Ln(10);
        $pdf->setCellHeightRatio(1.5);
        $pdf->Cell(0, 15, 'mengetahui', 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Cell(0, 15, $dataRw->kota, 0, false, 'R', 0, '', 0, false, 'M', 'L');
        $pdf->Ln(5);
        $pdf->Cell(0, 15, 'Ketua ' . $dataAlamatterpilih->RT->rt, 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Cell(0, 15, 'Ketua ' . $dataRw->nama, 0, false, 'R', 0, '', 0, false, 'M', 'L');
        $pdf->Ln(30);
        $pdf->Cell(0, 15, $dataAlamatterpilih->RT->ketua_rt, 0, false, 'L', 0, '', 0, false, 'M', 'L');
        $pdf->Cell(0, 15, $dataRw->ketua_rw, 0, false, 'R', 0, '', 0, false, 'M', 'L');

        setlocale(LC_TIME, 'id_ID');

        $carbon = Carbon::now();
        $fileName = $carbon->formatLocalized('%Y-%m-%d');
        $pdfname = 'data_namaorang' . $fileName;
        return  $pdf->Output($pdfname . '.pdf', 'D');

        //code...
        //         return response()->json([
        //             'data' => $data,
        //             'message' => 'data user login',
        //             'success' => true
        //         ], 201);
        //     } catch (\Throwable $th) {
        //         return response()->json([
        //             'data' => null,
        //             'message' => 'Terjadi kesalahan: ' . $th,
        //             'success' => false
        //         ], 500);
        //     }

        //     // Tampilkan atau unduh PDF

        //     // return $pdf->stream('document.pdf');
    }
}
