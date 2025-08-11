<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Status Keanggotaan</title>
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
        
        .status-approved, .status-active {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .status-rejected, .status-inactive {
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
        
        .status-approved h2, .status-active h2 {
            color: #155724;
            margin: 0;
            font-size: 20px;
        }
        
        .status-rejected h2, .status-inactive h2 {
            color: #721c24;
            margin: 0;
            font-size: 20px;
        }
        
        .member-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .member-details h3 {
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
            <p>Notifikasi Status Keanggotaan Jemaat</p>
        </div>

        <div class="content">
            <!-- Status Notification -->
            @if($status === 'approved' || $status === 'active')
                <div class="status-approved">
                    <div class="status-icon">✅</div>
                    <h2>
                        @if($status === 'approved')
                            Selamat! Pendaftaran Keanggotaan Anda Telah Disetujui
                        @else
                            Keanggotaan Anda Telah Diaktifkan
                        @endif
                    </h2>
                    <p style="margin: 10px 0 0 0;">
                        Keanggotaan untuk <strong>{{ $member->nama_lengkap }}</strong> telah disetujui oleh pihak gereja.
                    </p>
                </div>
            @else
                <div class="status-rejected">
                    <div class="status-icon">❌</div>
                    <h2>
                        @if($status === 'rejected')
                            Pendaftaran Keanggotaan Anda Ditolak
                        @else
                            Keanggotaan Anda Dinonaktifkan
                        @endif
                    </h2>
                    <p style="margin: 10px 0 0 0;">
                        Keanggotaan untuk <strong>{{ $member->nama_lengkap }}</strong> telah dinonaktifkan.
                    </p>
                </div>
            @endif

            <!-- Member Details -->
            <div class="member-details">
                <h3>👤 Detail Keanggotaan</h3>

                <div class="detail-row">
                    <span class="detail-label">Nama Lengkap:</span>
                    <span class="detail-value">{{ $member->nama_lengkap }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Jenis Kelamin:</span>
                    <span class="detail-value">{{ $member->jenis_kelamin == 'Lk' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>

                @if($member->tempat_lahir)
                <div class="detail-row">
                    <span class="detail-label">Tempat Lahir:</span>
                    <span class="detail-value">{{ $member->tempat_lahir }}</span>
                </div>
                @endif

                @if($member->tanggal_lahir)
                <div class="detail-row">
                    <span class="detail-label">Tanggal Lahir:</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($member->tanggal_lahir)->format('d F Y') }}</span>
                </div>
                @endif

                @if($member->alamat)
                <div class="detail-row">
                    <span class="detail-label">Alamat:</span>
                    <span class="detail-value">{{ $member->alamat }}</span>
                </div>
                @endif

                @if($member->no_hp)
                <div class="detail-row">
                    <span class="detail-label">No. HP:</span>
                    <span class="detail-value">{{ $member->no_hp }}</span>
                </div>
                @endif

                @if($member->pekerjaan)
                <div class="detail-row">
                    <span class="detail-label">Pekerjaan:</span>
                    <span class="detail-value">{{ $member->pekerjaan }}</span>
                </div>
                @endif

                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value">
                        @if($status === 'approved' || $status === 'active')
                            <strong style="color: #28a745;">✅ Aktif</strong>
                        @else
                            <strong style="color: #dc3545;">❌ Nonaktif</strong>
                        @endif
                    </span>
                </div>
            </div>

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
