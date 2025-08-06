<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marriage;
use App\Models\Baptism;
use App\Models\Member;
use App\Models\Suggestion;
use App\Models\EmailVerificationCode;
use App\Models\WorshipSchedule;

use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    public function index()
    {
        // Get upcoming events from calendar_events table
        $upcomingEvents = \App\Models\CalendarEvent::getUpcomingEvents(3);
        
        // Get worship schedules from database
        $worshipSchedules = WorshipSchedule::active()->ordered()->get();

        return view('landing.index', compact('upcomingEvents', 'worshipSchedules'));
    }

    // Profil Gereja methods
    public function sejarahGereja()
    {
        return view('landing.profil-gereja.sejarah');
    }

    public function visiMisi()
    {
        return view('landing.profil-gereja.visi-misi');
    }

    public function strukturOrganisasi()
    {
        return view('landing.profil-gereja.struktur-organisasi');
    }

    // Informasi methods
    public function pendetaJemaat()
    {
        $pastors = \App\Models\Pastor::orderBy('ordination_date')->get();
        return view('landing.informasi.pendeta-jemaat', compact('pastors'));
    }

    public function kegiatanGereja()
    {
        // Ambil data kegiatan jemaat dari Information model dengan berbagai kategori kegiatan
        $activities = \App\Models\Information::whereIn('category', [
                'event', 'kegiatan', 'acara', 'activity', 'service', 'ibadah'
            ])
            ->where('status', 'published')
            ->orderByRaw("CASE
                WHEN priority = 'high' THEN 3
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 1
                ELSE 0 END DESC")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('landing.informasi.kegiatan-jemaat', compact('activities'));
    }

    public function wartaJemaat()
    {
        // Ambil data warta mingguan dari database
        $wartaMingguan = \App\Models\WartaMingguan::orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Group warta berdasarkan tahun untuk tampilan yang lebih terorganisir
        $wartaByYear = $wartaMingguan->groupBy('tahun');

        return view('landing.informasi.warta-jemaat', compact('wartaMingguan', 'wartaByYear'));
    }

    public function programKerja()
    {
        // Ambil data program kerja dari Information model dengan kategori 'program-kerja'
        $programKerja = \App\Models\Information::where('category', 'program-kerja')
            ->where('status', 'published')
            ->orderByRaw("CASE
                WHEN priority = 'high' THEN 3
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 1
                ELSE 0 END DESC")
            ->orderBy('publish_date', 'desc')
            ->get();

        return view('landing.informasi.program-kerja', compact('programKerja'));
    }

    // OIG methods
    public function pkbgt()
    {
        return view('landing.oig.pkbgt');
    }

    public function programKerjaPkbgt()
    {
        // Ambil data program kerja PKBGT dari Information model
        $programKerja = \App\Models\Information::where('category', 'program-kerja')
            ->where('status', 'published')
            ->where(function($query) {
                $query->where('content', 'LIKE', '%PKBGT%')
                      ->orWhere('content', 'LIKE', '%Persekutuan Kaum Bapak%');
            })
            ->orderByRaw("CASE
                WHEN priority = 'high' THEN 3
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 1
                ELSE 0 END DESC")
            ->orderBy('publish_date', 'desc')
            ->get();

        return view('landing.oig.program-kerja-pkbgt', compact('programKerja'));
    }

    public function pwgt()
    {
        return view('landing.oig.pwgt');
    }

    public function programKerjaPwgt()
    {
        // Ambil data program kerja PWGT dari Information model
        $programKerja = \App\Models\Information::where('category', 'program-kerja')
            ->where('status', 'published')
            ->where(function($query) {
                $query->where('content', 'LIKE', '%PWGT%')
                      ->orWhere('content', 'LIKE', '%Persekutuan Wanita%');
            })
            ->orderByRaw("CASE
                WHEN priority = 'high' THEN 3
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 1
                ELSE 0 END DESC")
            ->orderBy('publish_date', 'desc')
            ->get();

        return view('landing.oig.program-kerja-pwgt', compact('programKerja'));
    }

    public function ppgt()
    {
        return view('landing.oig.ppgt');
    }

    public function programKerjaPpgt()
    {
        // Ambil data program kerja PPGT dari Information model
        $programKerja = \App\Models\Information::where('category', 'program-kerja')
            ->where('status', 'published')
            ->where(function($query) {
                $query->where('content', 'LIKE', '%PPGT%')
                      ->orWhere('content', 'LIKE', '%Persekutuan Pemuda%');
            })
            ->orderByRaw("CASE
                WHEN priority = 'high' THEN 3
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 1
                ELSE 0 END DESC")
            ->orderBy('publish_date', 'desc')
            ->get();

        return view('landing.oig.program-kerja-ppgt', compact('programKerja'));
    }

    public function smgt()
    {
        return view('landing.oig.smgt');
    }

    public function programKerjaSmgt()
    {
        // Ambil data program kerja SMGT dari Information model
        $programKerja = \App\Models\Information::where('category', 'program-kerja')
            ->where('status', 'published')
            ->where(function($query) {
                $query->where('content', 'LIKE', '%SMGT%')
                      ->orWhere('content', 'LIKE', '%Sekolah Minggu%');
            })
            ->orderByRaw("CASE
                WHEN priority = 'high' THEN 3
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 1
                ELSE 0 END DESC")
            ->orderBy('publish_date', 'desc')
            ->get();

        return view('landing.oig.program-kerja-smgt', compact('programKerja'));
    }

    // Contact methods
    public function pengelolaanSuratNikah()
    {
        return view('landing.contact.pengelolaan-surat-nikah');
    }

    public function pengelolaanBaptis()
    {
        return view('landing.contact.pengelolaan-baptis');
    }

    public function daftarAnggota()
    {
        return view('landing.contact.daftar-anggota');
    }

    public function saran()
    {
        return view('landing.contact.saran');
    }

    // Form submission methods
    public function submitSuratNikah(Request $request)
    {
        $validated = $request->validate([
            'nama_calon_pria' => 'required|string|max:255',
            'tanggal_lahir_pria' => 'required|date',
            'tempat_lahir_pria' => 'nullable|string|max:255',
            'alamat_pria' => 'required|string',
            'pekerjaan_pria' => 'required|string',
            'no_telepon_pria' => 'nullable|string|max:15',
            'email_pria' => 'nullable|email|max:255',
            'nama_ayah_pria' => 'required|string',
            'nama_ibu_pria' => 'required|string',
            'nama_calon_wanita' => 'required|string|max:255',
            'tanggal_lahir_wanita' => 'required|date',
            'tempat_lahir_wanita' => 'nullable|string|max:255',
            'alamat_wanita' => 'required|string',
            'pekerjaan_wanita' => 'required|string',
            'no_telepon_wanita' => 'nullable|string|max:15',
            'email_wanita' => 'nullable|email|max:255',
            'nama_ayah_wanita' => 'required|string',
            'nama_ibu_wanita' => 'required|string',
            'tanggal_pernikahan' => 'required|date',
            'tempat_pernikahan' => 'required|string',
            'saksi1' => 'required|string',
            'saksi2' => 'required|string',
        ]);

        // Gabungkan saksi1 dan saksi2 menjadi saksi
        $validated['saksi'] = $validated['saksi1'] . ', ' . $validated['saksi2'];

        // Hapus saksi1 dan saksi2 dari array validated
        unset($validated['saksi1']);
        unset($validated['saksi2']);

        // Set default status as pending
        $validated['status'] = 'pending';

        Marriage::create($validated);

        return back()->with('success', 'Data pernikahan berhasil disimpan.');
    }

    public function submitBaptis(Request $request)
    {
        $validated = $request->validate([
            // I. KETERANGAN ANAK
            'nama_jemaat' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat_anak' => 'required|string',
            'tanggal_baptis' => 'required|date',

            // II. KETERANGAN ORANG TUA (AYAH)
            'nama_ayah' => 'required|string|max:255',
            'umur_ayah' => 'required|integer|min:1|max:150',
            'gereja_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'alamat_ayah' => 'required|string',

            // III. KETERANGAN ORANG TUA (IBU)
            'nama_ibu' => 'required|string|max:255',
            'umur_ibu' => 'required|integer|min:1|max:150',
            'gereja_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'alamat_ibu' => 'required|string',

            // IV. LAMPIRAN
            'foto' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'no_telepon' => 'required|string|max:20',
            'dibaptis_oleh' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Check if email is verified
        if (!EmailVerificationCode::isEmailVerified($request->email, 'baptism')) {
            return back()->withErrors(['email' => 'Email belum diverifikasi. Silakan verifikasi email terlebih dahulu.'])
                        ->withInput();
        }

        // Generate automatic baptism number
        $year = date('Y');
        $lastBaptism = Baptism::whereYear('created_at', $year)
                             ->orderBy('id', 'desc')
                             ->first();

        if ($lastBaptism) {
            // Extract number from last baptism number (format: BAPT-YYYY-XXX)
            $lastNumber = (int) substr($lastBaptism->nomor_baptis, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $validated['nomor_baptis'] = 'BAPT-' . $year . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('baptism-photos', 'public');
            $validated['foto'] = $path;
        }

        // Set default status as pending
        $validated['status'] = 'pending';

        Baptism::create($validated);

        return back()->with('success', 'Data baptis berhasil disimpan dengan nomor baptis: ' . $validated['nomor_baptis']);
    }

    public function submitAnggota(Request $request)
    {
        // Debug: Log incoming request data
        \Log::info('Anggota form submission data:', $request->all());

        // Validate the family members data
        $validated = $request->validate([
            'anggota' => 'required|array|min:1',
            'anggota.*.nama_lengkap' => 'required|string|max:255',
            'anggota.*.jenis_kelamin' => 'required|in:Lk,Pr',
            'anggota.*.tempat_lahir' => 'required|string|max:255',
            'anggota.*.tanggal_lahir' => 'required|date',
            'anggota.*.status_baptis' => 'required|in:S,B',
            'anggota.*.status_sidi' => 'required|in:S,B',
            'anggota.*.tempat_nikah' => 'nullable|string|max:255',
            'anggota.*.tanggal_nikah' => 'nullable|date',
            'anggota.*.hubungan_keluarga' => 'required|string|max:255',
            'anggota.*.pendidikan' => 'required|string|max:255',
            'anggota.*.pekerjaan' => 'required|string|max:255',
            'anggota.*.status' => 'required|in:K,B,J,D',
            'email' => 'required|email|max:255',
        ]);

        // Debug: Check email verification status
        \Log::info('Email verification check:', [
            'anggota_email_verified' => session('anggota_email_verified'),
            'anggota_verified_email' => session('anggota_verified_email'),
            'submitted_email' => $validated['email']
        ]);

        // Check if email is verified
        if (!session('anggota_email_verified') || session('anggota_verified_email') !== $validated['email']) {
            \Log::warning('Email verification failed for anggota submission');
            return back()->withErrors(['email' => 'Email belum diverifikasi. Silakan verifikasi email terlebih dahulu.'])
                        ->withInput();
        }

        $savedMembers = [];

        // Process each family member
        foreach ($validated['anggota'] as $index => $anggotaData) {
            // Debug: Log raw anggota data
            \Log::info('Processing anggota data at index ' . $index . ':', $anggotaData);
            
            // Generate member number (index starts from 1 for KK, then 2, 3, etc for Ang)
            $memberNumber = $index == 1 ? 'KK-001' : 'Ang-' . str_pad($index, 3, '0', STR_PAD_LEFT);

            // Debug: Log jenis_kelamin mapping
            \Log::info('Mapping jenis_kelamin:', [
                'original' => $anggotaData['jenis_kelamin'],
                'mapped' => $this->mapJenisKelamin($anggotaData['jenis_kelamin'])
            ]);

            // Prepare member data for database (using existing columns only)
            $memberData = [
                'nama_lengkap' => $anggotaData['nama_lengkap'],
                'jenis_kelamin' => $this->mapJenisKelamin($anggotaData['jenis_kelamin']),
                'tempat_lahir' => $anggotaData['tempat_lahir'],
                'tanggal_lahir' => $anggotaData['tanggal_lahir'],
                'alamat' => 'Data keluarga - ' . $anggotaData['hubungan_keluarga'],
                'pekerjaan' => $anggotaData['pekerjaan'],
                'status_pernikahan' => $this->mapStatusPernikahan($anggotaData['status']),
                'email' => $validated['email'],
                'status' => 'active', // Use 'active' instead of 'pending' since enum only has active/inactive
                // Store additional data in existing fields temporarily
                'nama_ayah' => 'Baptis: ' . $anggotaData['status_baptis'] . ', Sidi: ' . $anggotaData['status_sidi'],
                'nama_ibu' => 'Pendidikan: ' . $anggotaData['pendidikan'],
                'nama_pasangan' => $anggotaData['tempat_nikah'] ?? 'Belum menikah',
            ];

            // Debug: Log member data before create
            \Log::info('Creating member with data:', $memberData);

            // Create member record
            try {
                $member = Member::create($memberData);
                $savedMembers[] = $member;
                \Log::info('Member created successfully with ID: ' . $member->id);
            } catch (\Illuminate\Database\QueryException $e) {
                \Log::error('Database error when creating member:', [
                    'error' => $e->getMessage(),
                    'errorCode' => $e->getCode(),
                    'memberData' => $memberData,
                    'sqlState' => $e->errorInfo[0] ?? 'Unknown',
                    'errorNumber' => $e->errorInfo[1] ?? 'Unknown'
                ]);
                
                // If any member fails, we should rollback all saved members
                foreach ($savedMembers as $savedMember) {
                    $savedMember->delete();
                }
                
                // Provide more specific error message
                $errorMessage = 'Gagal menyimpan data anggota. ';
                if (strpos($e->getMessage(), 'Data truncated') !== false) {
                    $errorMessage .= 'Data terlalu panjang untuk salah satu field. Silakan periksa kembali data yang dimasukkan.';
                } else {
                    $errorMessage .= 'Error: ' . $e->getMessage();
                }
                
                return back()->withErrors(['anggota' => $errorMessage])
                            ->withInput();
            } catch (\Exception $e) {
                \Log::error('General error when creating member:', [
                    'error' => $e->getMessage(),
                    'memberData' => $memberData
                ]);
                
                // If any member fails, we should rollback all saved members
                foreach ($savedMembers as $savedMember) {
                    $savedMember->delete();
                }
                
                return back()->withErrors(['anggota' => 'Gagal menyimpan data anggota: ' . $e->getMessage()])
                            ->withInput();
            }
        }

        // Clear email verification session
        session()->forget(['anggota_email_verified', 'anggota_verified_email']);

        return back()->with('success', 'Data keluarga berhasil disimpan! Total ' . count($savedMembers) . ' anggota keluarga telah terdaftar.');
    }

    private function mapStatusPernikahan($status)
    {
        // Database enum expects: 'K', 'B', 'J', 'D'
        $mapping = [
            'K' => 'K',
            'B' => 'B',
            'J' => 'J',
            'D' => 'D',
            'Menikah' => 'K',
            'Belum Menikah' => 'B',
            'Janda' => 'J',
            'Duda' => 'D'
        ];

        return $mapping[$status] ?? 'B';
    }

    private function mapJenisKelamin($jenisKelamin)
    {
        // Handle various possible values and ensure only valid enum values are returned
        // Database enum expects: 'Lk' or 'Pr'
        $mapping = [
            'Lk' => 'Lk',
            'Pr' => 'Pr',
            'L' => 'Lk',
            'P' => 'Pr',
            'Laki-laki' => 'Lk',
            'Perempuan' => 'Pr',
            'Male' => 'Lk',
            'Female' => 'Pr',
            'M' => 'Lk',
            'F' => 'Pr'
        ];

        // Convert to string and trim whitespace
        $jenisKelamin = trim(strval($jenisKelamin));
        
        // Return mapped value or default to 'Lk' if not found
        return $mapping[$jenisKelamin] ?? 'Lk';
    }

    public function submitSaran(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'saran' => 'required|string',
        ]);

        // Check if email is verified
        if (!session('saran_email_verified') || session('saran_verified_email') !== $validated['email']) {
            return back()->withErrors(['email' => 'Email belum diverifikasi. Silakan verifikasi email terlebih dahulu.'])
                        ->withInput();
        }

        // Map email to nama_gmail for database compatibility
        $validated['nama_gmail'] = $validated['email'];
        unset($validated['email']);

        Suggestion::create($validated);

        // Clear email verification session
        session()->forget(['saran_email_verified', 'saran_verified_email']);

        return back()->with('success', 'Terima kasih atas saran dan masukan Anda.');
    }

    // Email verification methods for Marriage form
    public function sendVerificationNikah(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store verification code in session
        session([
            'nikah_verification_code' => $verificationCode,
            'nikah_verification_email' => $email,
            'nikah_verification_expires' => now()->addMinutes(10)
        ]);

        // Send email using Brevo
        $this->sendVerificationEmail($email, $verificationCode, 'Pendaftaran Surat Nikah');

        return response()->json([
            'success' => true,
            'message' => 'Kode verifikasi telah dikirim ke email Anda'
        ]);
    }

    public function verifyEmailNikah(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:6',
        ]);

        $storedCode = session('nikah_verification_code');
        $storedEmail = session('nikah_verification_email');
        $expiresAt = session('nikah_verification_expires');

        if (!$storedCode || !$storedEmail || !$expiresAt) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak ditemukan. Silakan kirim ulang kode.'
            ]);
        }

        if (now()->gt($expiresAt)) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi telah kedaluwarsa. Silakan kirim ulang kode.'
            ]);
        }

        if ($request->verification_code !== $storedCode) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak valid.'
            ]);
        }

        // Clear verification data from session
        session()->forget(['nikah_verification_code', 'nikah_verification_email', 'nikah_verification_expires']);

        return response()->json([
            'success' => true,
            'message' => 'Email berhasil diverifikasi!'
        ]);
    }

    // Email verification methods for Member form
    public function sendVerificationAnggota(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store verification code in session
        session([
            'anggota_verification_code' => $verificationCode,
            'anggota_verification_email' => $email,
            'anggota_verification_expires' => now()->addMinutes(10)
        ]);

        // Send email using Brevo
        $this->sendVerificationEmail($email, $verificationCode, 'Pendaftaran Anggota Jemaat');

        return response()->json([
            'success' => true,
            'message' => 'Kode verifikasi telah dikirim ke email Anda'
        ]);
    }

    public function verifyEmailAnggota(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:6',
        ]);

        $storedCode = session('anggota_verification_code');
        $storedEmail = session('anggota_verification_email');
        $expiresAt = session('anggota_verification_expires');

        if (!$storedCode || !$storedEmail || !$expiresAt) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak ditemukan. Silakan kirim ulang kode.'
            ]);
        }

        if (now()->gt($expiresAt)) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi telah kedaluwarsa. Silakan kirim ulang kode.'
            ]);
        }

        if ($request->verification_code !== $storedCode) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak valid.'
            ]);
        }

        // Mark email as verified in session
        session([
            'anggota_email_verified' => true,
            'anggota_verified_email' => $storedEmail
        ]);

        // Clear verification data from session
        session()->forget(['anggota_verification_code', 'anggota_verification_email', 'anggota_verification_expires']);

        return response()->json([
            'success' => true,
            'message' => 'Email berhasil diverifikasi!'
        ]);
    }

    // Email verification methods for Suggestion form
    public function sendVerificationSaran(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store verification code in session
        session([
            'saran_verification_code' => $verificationCode,
            'saran_verification_email' => $email,
            'saran_verification_expires' => now()->addMinutes(10)
        ]);

        // Send email using Brevo
        $this->sendVerificationEmail($email, $verificationCode, 'Saran dan Masukan');

        return response()->json([
            'success' => true,
            'message' => 'Kode verifikasi telah dikirim ke email Anda'
        ]);
    }

    public function verifyEmailSaran(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:6',
        ]);

        $storedCode = session('saran_verification_code');
        $storedEmail = session('saran_verification_email');
        $expiresAt = session('saran_verification_expires');

        if (!$storedCode || !$storedEmail || !$expiresAt) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak ditemukan. Silakan kirim ulang kode.'
            ]);
        }

        if (now()->gt($expiresAt)) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi telah kedaluwarsa. Silakan kirim ulang kode.'
            ]);
        }

        if ($request->verification_code !== $storedCode) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak valid.'
            ]);
        }

        // Mark email as verified in session
        session([
            'saran_email_verified' => true,
            'saran_verified_email' => $storedEmail
        ]);

        // Clear verification data from session
        session()->forget(['saran_verification_code', 'saran_verification_email', 'saran_verification_expires']);

        return response()->json([
            'success' => true,
            'message' => 'Email berhasil diverifikasi!'
        ]);
    }

    // Helper method to send verification email using Brevo
    private function sendVerificationEmail($email, $verificationCode, $formType)
    {
        $config = [
            'api_key' => env('BREVO_API_KEY'),
            'sender' => [
                'name' => 'Gereja Toraja Eben-Haezer Selili',
                'email' => env('BREVO_SENDER_EMAIL', 'suryawijaya1141@gmail.com')
            ],
            'to' => [
                [
                    'email' => $email,
                    'name' => 'Calon Anggota'
                ]
            ],
            'subject' => 'Kode Verifikasi ' . $formType,
            'htmlContent' => view('emails.verification', [
                'verificationCode' => $verificationCode,
                'formType' => $formType,
                'expiresIn' => '10 menit'
            ])->render()
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.brevo.com/v3/smtp/email',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($config),
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'api-key: ' . env('BREVO_API_KEY'),
                'content-type: application/json'
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            \Log::error('Brevo API Error: ' . $err);
            return false;
        }

        return true;
    }

    public function anggotaJemaat()
    {
        // Hitung jumlah anggota berdasarkan kategori menggunakan model Member yang baru
        $totalLakiLaki = \App\Models\Member::lakiLaki()->where('status', 'active')->count();
        $totalPerempuan = \App\Models\Member::perempuan()->where('status', 'active')->count();
        $totalKeluarga = \App\Models\Member::menikah()->where('status', 'active')->count() / 2; // Asumsi pasangan suami istri
        $totalPernikahan = 0; // Bisa ditambahkan logic untuk menghitung pernikahan
        $totalAnggota = \App\Models\Member::where('status', 'active')->count();

        // Data untuk grafik (contoh data, sesuaikan dengan kebutuhan)
        $persentaseLakiLaki = $totalAnggota > 0 ? round(($totalLakiLaki / $totalAnggota) * 100) : 0;
        $persentasePerempuan = $totalAnggota > 0 ? round(($totalPerempuan / $totalAnggota) * 100) : 0;

        // Data untuk grafik batang (contoh data untuk 3 tahun terakhir)
        $tahunIni = date('Y');
        $dataGrafik = [
            'tahun' => [$tahunIni-2, $tahunIni-1, $tahunIni],
            'laki_laki' => [45, 50, $totalLakiLaki],
            'perempuan' => [40, 45, $totalPerempuan],
            'anak_anak' => [20, 25, 30]
        ];

        return view('profil-gereja.anggota-jemaat', compact(
            'totalLakiLaki',
            'totalPerempuan',
            'totalKeluarga',
            'totalPernikahan',
            'totalAnggota',
            'persentaseLakiLaki',
            'dataGrafik'
        ));
    }

    public function kegiatanDetail($id)
    {
        $activity = \App\Models\Information::findOrFail($id);
        return view('landing.informasi.kegiatan-detail', compact('activity'));
    }
}
