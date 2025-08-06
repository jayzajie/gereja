<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi {{ $formType }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        .header img {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 30px 20px;
        }
        .verification-code {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 5px;
            margin: 30px 0;
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 8px;
            color: #8B4513;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
        }
        .note {
            background-color: #fff8e1;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 14px;
            color: #856404;
        }
        h1 {
            color: #8B4513;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 15px;
        }
        .church-name {
            font-weight: bold;
            color: #8B4513;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Gereja Toraja Eben-Haezer Selili</h1>
        </div>
        
        <div class="content">
            <h2>Kode Verifikasi {{ $formType }}</h2>
            
            <p>Halo,</p>
            
            <p>Terima kasih telah menggunakan layanan {{ $formType }} di website Gereja Toraja Eben-Haezer Selili. Untuk melanjutkan proses, silakan gunakan kode verifikasi berikut:</p>
            
            <div class="verification-code">{{ $verificationCode }}</div>
            
            <div class="note">
                <strong>Catatan:</strong> Kode verifikasi ini hanya berlaku selama {{ $expiresIn }} dan hanya dapat digunakan sekali.
            </div>
            
            <p>Jika Anda tidak merasa melakukan pendaftaran atau permintaan ini, silakan abaikan email ini.</p>
            
            <p>Terima kasih,<br>
            <span class="church-name">Gereja Toraja Eben-Haezer Selili</span></p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Gereja Toraja Eben-Haezer Selili. Semua hak dilindungi.</p>
            <p>Jl. Lumba-Lumba No. 1, Selili, Samarinda, Kalimantan Timur</p>
        </div>
    </div>
</body>
</html>
