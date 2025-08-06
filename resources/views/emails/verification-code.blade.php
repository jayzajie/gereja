<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #D4A574;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #8B4513;
            margin-bottom: 10px;
        }
        .church-name {
            color: #666;
            font-size: 16px;
        }
        .content {
            margin-bottom: 30px;
        }
        .verification-code {
            background: linear-gradient(135deg, #D4A574 0%, #C8956D 100%);
            color: white;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            letter-spacing: 5px;
            margin: 20px 0;
            box-shadow: 0 4px 15px rgba(212, 165, 116, 0.3);
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #D4A574;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 5px 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            background: #8B4513;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">⛪ Gereja Toraja</div>
            <div class="church-name">Eben-Haezer Selili</div>
        </div>

        <div class="content">
            <h2>Kode Verifikasi Email</h2>
            
            <p>Halo,</p>
            
            <p>Anda telah meminta kode verifikasi untuk 
                @if($type === 'baptism')
                    <strong>pendaftaran baptis</strong>
                @elseif($type === 'marriage')
                    <strong>pendaftaran pernikahan</strong>
                @else
                    <strong>verifikasi akun</strong>
                @endif
                di Gereja Toraja Eben-Haezer Selili.
            </p>

            <p>Gunakan kode verifikasi berikut untuk melanjutkan proses pendaftaran:</p>

            <div class="verification-code">
                {{ $code }}
            </div>

            <div class="info-box">
                <strong>📋 Informasi Penting:</strong>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Kode ini berlaku selama <strong>10 menit</strong></li>
                    <li>Jangan bagikan kode ini kepada siapa pun</li>
                    <li>Masukkan kode tepat seperti yang tertera</li>
                </ul>
            </div>

            <div class="warning">
                <strong>⚠️ Peringatan Keamanan:</strong><br>
                Jika Anda tidak meminta kode verifikasi ini, abaikan email ini. 
                Kode akan otomatis kedaluwarsa dalam 10 menit.
            </div>

            <p>Jika Anda mengalami kesulitan, silakan hubungi kami melalui:</p>
            <ul>
                <li>📞 Telepon: (0423) 21234</li>
                <li>📧 Email: info@gerejatoraja-selili.com</li>
                <li>📍 Alamat: Jl. Gereja No. 123, Selili, Toraja Utara</li>
            </ul>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Gereja Toraja Eben-Haezer Selili. Semua hak dilindungi.</p>
            <p style="margin-top: 15px;">
                <em>"Karena itu pergilah, jadikanlah semua bangsa murid-Ku dan baptislah mereka dalam nama Bapa dan Anak dan Roh Kudus" - Matius 28:19</em>
            </p>
        </div>
    </div>
</body>
</html>
