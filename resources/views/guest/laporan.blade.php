<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan_Analisis_AegisVision</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #1f2937; padding: 40px; background: #fff; }
        .report-box { max-width: 700px; margin: 0 auto; border: 1px solid #e5e7eb; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .header { text-align: center; border-bottom: 2px solid #065f46; padding-bottom: 20px; margin-bottom: 25px; }
        .header h1 { color: #065f46; margin: 0; font-size: 20px; font-weight: bold; letter-spacing: 0.5px; }
        .header p { color: #6b7280; font-size: 11px; margin: 6px 0 0 0; }
        .section-title { font-weight: bold; font-size: 12px; color: #374151; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #f3f4f6; padding-bottom: 5px; }
        .info-table { width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 25px; }
        .info-table th, .info-table td { padding: 10px 12px; text-align: left; border-bottom: 1px solid #f3f4f6; }
        .info-table th { color: #6b7280; font-weight: 500; width: 35%; }
        .info-table td { color: #111827; font-weight: 600; }
        .badge-danger { background-color: #fee2e2; color: #dc2626; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #9ca3af; border-top: 1px solid #f3f4f6; padding-top: 15px; }

        .no-print { text-align: center; margin-top: 20px; }
        .btn-print { background-color: #065f46; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 12px; font-weight: bold; cursor: pointer; }

        @media print {
            .no-print { display: none; }
            body { padding: 0; background: none; }
            .report-box { border: none; box-shadow: none; padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="report-box">
        <div class="header">
            <h1>AEGIS VISION - LAPORAN HASIL ANALISIS KEAMANAN</h1>
            <p>Sistem Deteksi Anomali & Shoplifting Berbasis Kecerdasan Buatan</p>
        </div>

        <div class="section-title">Detail Informasi Insiden</div>
        <table class="info-table">
            <tr>
                <th>Kode Insiden</th>
                <td>{{ $analysis->incident_code ?? '#INC-8492' }}</td>
            </tr>
            <tr>
                <th>Waktu Deteksi</th>
                <td>14 Okt 2023, 23:42 WIB</td>
            </tr>
            <tr>
                <th>Lokasi & Kamera</th>
                <td>{{ $analysis->location ?? 'Area Utara - Lorong B' }} ({{ $analysis->camera_id ?? 'CAM-04-NTH' }})</td>
            </tr>
            <tr>
                <th>Prediksi Status AI</th>
                <td><span class="badge-danger">{{ $analysis->status ?? 'Shoplifting' }} ({{ $analysis->accuracy ?? 96 }}%)</span></td>
            </tr>
            <tr>
                <th>Total Frame Dianalisis</th>
                <td>{{ $analysis->total_frames ?? 16 }} Frames</td>
            </tr>
        </table>

        <div class="section-title">Catatan Sistem</div>
        <p style="font-size: 12px; color: #4b5563; line-height: 1.6;">
            Laporan ini digenerasi secara otomatis oleh platform Aegis Vision berdasarkan pemindaian neural network. Dokumen ini sah digunakan sebagai arsip peninjauan awal keamanan area komersial.
        </p>

        <div class="footer">
            <p>Dicetak pada: {{ date('d M Y, H:i:s') }} WIB | Aegis Vision AI Engine v2.4</p>
        </div>

        <div class="no-print">
            <button onclick="window.print()" class="btn-print">Cetak / Simpan sebagai PDF</button>
        </div>
    </div>
</body>
</html>
