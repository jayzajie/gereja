<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Status Baptis</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        
        .content {
            padding: 30px;
        }
        
        .status-approved {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .status-rejected {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            border: 2px solid #dc3545;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .status-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        
        .status-approved h2 {
            color: #155724;
            margin: 0;
            font-size: 20px;
        }
        
        .status-rejected h2 {
            color: #721c24;
            margin: 0;
            font-size: 20px;
        }
        
        .baptism-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .baptism-details h3 {
            margin-top: 0;
            color: #8B4513;
            border-bottom: 2px solid #8B4513;
            padding-bottom: 10px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #495057;
            flex: 1;
        }
        
        .detail-value {
            flex: 2;
            text-align: right;
            color: #212529;
        }
        
        .next-steps {
            background-color: #e7f3ff;
            border-left: 4px solid #007bff;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .next-steps h3 {
            margin-top: 0;
            color: #007bff;
        }
        
        .next-steps ul {
            margin: 15px 0;
            padding-left: 20px;
        }
        
        .next-steps li {
            margin-bottom: 8px;
        }
        
        .contact-info {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .contact-info h3 {
            margin-top: 0;
            color: #856404;
        }
        
        .contact-info p {
            margin: 5px 0;
        }
        
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
            transform: translateY(-2px);
        }
        
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        
        .footer p {
            margin: 5px 0;
            color: #6c757d;
            font-size: 14px;
        }
        
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .content {
                padding: 20px;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .detail-value {
                text-align: left;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>⛪ Gereja Toraja Eben-Haezer Selili</h1>
            <p>Notifikasi Status Pendaftaran Baptis</p>
        </div>

        <div class="content">
            <!-- Status Notification -->
            @if($status === 'approved')
                <div class="status-approved">
                    <div class="status-icon">✅</div>
                    <h2>Selamat! Pendaftaran Baptis Anda Telah Disetujui</h2>
                    <p style="margin: 10px 0 0 0;">
                        Pendaftaran baptis untuk <strong>{{ $baptism->nama_jemaat }}</strong> telah disetujui oleh pihak gereja.
                    </p>
                </div>
            @elseif($status === 'rejected')
                <div class="status-rejected">
                    <div class="status-icon">❌</div>
                    <h2>Pendaftaran Baptis Anda Ditolak</h2>
                    <p style="margin: 10px 0 0 0;">
                        Mohon maaf, pendaftaran baptis untuk <strong>{{ $baptism->nama_jemaat }}</strong> tidak dapat disetujui saat ini.
                    </p>
                </div>
            @endif

            <!-- Baptism Details -->
            <div class="baptism-details">
                <h3>📋 Detail Pendaftaran Baptis</h3>

                <div class="detail-row">
                    <span class="detail-label">Nomor Baptis:</span>
                    <span class="detail-value">{{ $baptism->nomor_baptis }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Nama Jemaat:</span>
                    <span class="detail-value">{{ $baptism->nama_jemaat }}</span>
                </div>

                @if($baptism->tempat_lahir)
                <div class="detail-row">
                    <span class="detail-label">Tempat Lahir:</span>
                    <span class="detail-value">{{ $baptism->tempat_lahir }}</span>
                </div>
                @endif

                @if($baptism->tanggal_lahir)
                <div class="detail-row">
                    <span class="detail-label">Tanggal Lahir:</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($baptism->tanggal_lahir)->format('d F Y') }}</span>
                </div>
                @endif

                <div class="detail-row">
                    <span class="detail-label">Tanggal Baptis:</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($baptism->tanggal_baptis)->format('d F Y') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Dibaptis Oleh:</span>
                    <span class="detail-value">{{ $baptism->dibaptis_oleh }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Nama Ayah:</span>
                    <span class="detail-value">{{ $baptism->nama_ayah }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Nama Ibu:</span>
                    <span class="detail-value">{{ $baptism->nama_ibu }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value">
                        @if($status === 'approved')
                            <strong style="color: #28a745;">✅ Disetujui</strong>
                        @elseif($status === 'rejected')
                            <strong style="color: #dc3545;">❌ Ditolak</strong>
                        @endif
                    </span>
                </div>
            </div>

            <!-- Next Steps -->
            @if($status === 'approved')
                <div class="next-steps">
                    <h3>📝 Langkah Selanjutnya</h3>
                    <ul>
                        <li>Silakan datang ke kantor gereja untuk melengkapi berkas administrasi</li>
                        <li>Bawa dokumen asli yang diperlukan (Akta Kelahiran, KK, dll.)</li>
                        <li>Koordinasi dengan pendeta untuk persiapan upacara baptis</li>
                        <li>Ikuti kelas persiapan baptis jika diperlukan</li>
                        <li>Konfirmasi tanggal dan waktu pelaksanaan baptis</li>
                    </ul>

                    <div style="text-align: center; margin-top: 20px;">
                        <a href="tel:+6281350097130" class="btn">📞 Hubungi Gereja</a>
                    </div>
                </div>
            @elseif($status === 'rejected')
                <div class="next-steps">
                    <h3 style="color: #dc3545;">📝 Informasi Lebih Lanjut</h3>
                    <p>Untuk mengetahui alasan penolakan dan kemungkinan pendaftaran ulang, silakan hubungi kantor gereja.</p>

                    <div style="text-align: center; margin-top: 20px;">
                        <a href="tel:+6281350097130" class="btn">📞 Hubungi Gereja</a>
                    </div>
                </div>
            @endif

            <!-- Contact Information -->
            <div class="contact-info">
                <h3>📞 Informasi Kontak</h3>
                <p><strong>Telepon:</strong> 08135009713</p>
                <p><strong>WhatsApp:</strong> +62 813-5009-713</p>
                <p><strong>Email:</strong> ebenhaezerSelili@gmail.com</p>
                <p><strong>Alamat:</strong> Jl. Lumba-Lumba, Selili, Kec. Samarinda Ilir, Kota Samarinda, Kalimantan Timur 75251</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Gereja Toraja Eben-Haezer Selili</strong></p>
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p>Jika Anda memiliki pertanyaan, silakan hubungi kami melalui kontak di atas.</p>
        </div>
    </div>
</body>
</html>
