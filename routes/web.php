<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SejarahGerejaController;
use App\Http\Controllers\SejarahJemaatController;
use App\Http\Controllers\{InformationController, InventoryController, MarriageController, BaptismController, MemberController, SuggestionController, ProgramKerjaController, WartaMingguanController, CalendarEventController};
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PastorController;
use App\Http\Controllers\CongregationController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ExcelFileController;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/test', function () {
    return view('landing.test');
})->name('hosme');



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/dashboard/member-photos', [DashboardController::class, 'memberPhotos'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.member-photos');

Route::post('/dashboard/member-photo-upload', [DashboardController::class, 'memberPhotoUpload'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.member-photo-upload');

Route::get('/dashboard/contact-data', [DashboardController::class, 'contactData'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.contact-data');

Route::post('/dashboard/contact-data/update-status', [DashboardController::class, 'updateContactStatus'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.contact-data.update-status');



// Sejarah Gereja Management Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sejarah-gereja', SejarahGerejaController::class);
    Route::patch('sejarah-gereja/{sejarahGereja}/toggle-status', [SejarahGerejaController::class, 'toggleStatus'])
        ->name('sejarah-gereja.toggle-status');
});

// Sejarah Jemaat Management Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sejarah-jemaat', SejarahJemaatController::class);
    Route::patch('sejarah-jemaat/{sejarahJemaat}/toggle-status', [SejarahJemaatController::class, 'toggleStatus'])
        ->name('sejarah-jemaat.toggle-status');
});

// Members Management Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('members/export', [MemberController::class, 'export'])->name('members.export');
    Route::resource('members', MemberController::class);
});

// Excel Files Management Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('excel-files/{excelFile}/download', [ExcelFileController::class, 'download'])->name('excel-files.download');
    Route::resource('excel-files', ExcelFileController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Sejarah Routes
Route::prefix('sejarah')->group(function () {
    // Default route redirects to sejarah.gereja
    Route::get('/', function () {
        return redirect()->route('sejarah.gereja');
    })->name('sejarah');

    Route::get('/gereja', [App\Http\Controllers\SejarahController::class, 'gereja'])->name('sejarah.gereja');
    Route::get('/jemaat', [App\Http\Controllers\SejarahController::class, 'jemaat'])->name('sejarah.jemaat');
    Route::get('/profil-gereja', [App\Http\Controllers\SejarahController::class, 'profiles'])->name('sejarah.profiles');
    Route::get('/profil-gereja/{id}', [App\Http\Controllers\SejarahController::class, 'profileDetail'])->name('sejarah.profile-detail');
});

// Profil Gereja Routes
Route::prefix('profil-gereja')->group(function () {
    // Remove the sejarah-gereja route as it's now handled by the sejarah routes
    Route::get('/', function () {
        return view('profil-gereja.index');
    })->name('profil-gereja');

    Route::get('/struktur-organisasi', [App\Http\Controllers\LandingController::class, 'strukturOrganisasi'])->name('struktur-organisasi');

    // Tambahkan route untuk anggota-jemaat
    Route::get('/anggota-jemaat', [App\Http\Controllers\LandingController::class, 'anggotaJemaat'])->name('anggota-jemaat');
});

// Informasi Routes
Route::prefix('informasi')->group(function () {
    Route::get('/pendeta-jemaat', [App\Http\Controllers\LandingController::class, 'pendetaJemaat'])->name('pendeta-jemaat');
    Route::get('/kegiatan-jemaat', [App\Http\Controllers\LandingController::class, 'kegiatanGereja'])->name('kegiatan-jemaat');
    Route::get('/kegiatan-jemaat/{id}', [App\Http\Controllers\LandingController::class, 'kegiatanDetail'])->name('kegiatan-detail');
    Route::get('/warta-jemaat', [App\Http\Controllers\LandingController::class, 'wartaJemaat'])->name('warta-jemaat');
    Route::get('/program-kerja', [App\Http\Controllers\LandingController::class, 'programKerja'])->name('program-kerja');
});

// Public Warta Routes (tanpa auth untuk akses publik)
Route::get('warta-mingguan/{id}/download', [WartaMingguanController::class, 'download'])->name('warta-mingguan.download');
Route::get('warta-mingguan/{id}/view', [WartaMingguanController::class, 'view'])->name('warta-mingguan.view');

// OIG Routes
Route::prefix('oig')->name('oig.')->group(function () {
    Route::get('/pkbgt', [App\Http\Controllers\LandingController::class, 'pkbgt'])->name('pkbgt');
    Route::get('/pwgt', [App\Http\Controllers\LandingController::class, 'pwgt'])->name('pwgt');
    Route::get('/ppgt', [App\Http\Controllers\LandingController::class, 'ppgt'])->name('ppgt');
    Route::get('/smgt', [App\Http\Controllers\LandingController::class, 'smgt'])->name('smgt');

    // PKBGT sub-routes
    Route::get('/pkbgt/program-kerja', [App\Http\Controllers\LandingController::class, 'programKerjaPkbgt'])->name('pkbgt.program-kerja');
    Route::get('/pkbgt/pengurus', function () {
        return view('landing.oig.pengurus-pkbgt');
    })->name('pkbgt.pengurus');
    Route::get('/pkbgt/kegiatan', function () {
        return view('landing.oig.kegiatan-pkbgt');
    })->name('pkbgt.kegiatan');

    // PWGT sub-routes
    Route::get('/pwgt/program-kerja', [App\Http\Controllers\LandingController::class, 'programKerjaPwgt'])->name('pwgt.program-kerja');
    Route::get('/pwgt/pengurus', function () {
        return view('landing.oig.pengurus-pwgt');
    })->name('pwgt.pengurus');
    Route::get('/pwgt/kegiatan', function () {
        return view('landing.oig.kegiatan-pwgt');
    })->name('pwgt.kegiatan');

    // PPGT sub-routes
    Route::get('/ppgt/program-kerja', [App\Http\Controllers\LandingController::class, 'programKerjaPpgt'])->name('ppgt.program-kerja');
    Route::get('/ppgt/pengurus', function () {
        return view('landing.oig.pengurus-ppgt');
    })->name('ppgt.pengurus');
    Route::get('/ppgt/kegiatan', function () {
        return view('landing.oig.kegiatan-ppgt');
    })->name('ppgt.kegiatan');

    // SMGT sub-routes
    Route::get('/smgt/program-kerja', [App\Http\Controllers\LandingController::class, 'programKerjaSmgt'])->name('smgt.program-kerja');
    Route::get('/smgt/pengurus', function () {
        return view('landing.oig.pengurus-smgt');
    })->name('smgt.pengurus');
    Route::get('/smgt/kegiatan', function () {
        return view('landing.oig.kegiatan-smgt');
    })->name('smgt.kegiatan');
});

// Backward compatibility routes (without oig prefix for landing pages)
Route::get('/pkbgt', [App\Http\Controllers\LandingController::class, 'pkbgt'])->name('pkbgt');
Route::get('/pwgt', [App\Http\Controllers\LandingController::class, 'pwgt'])->name('pwgt');
Route::get('/ppgt', [App\Http\Controllers\LandingController::class, 'ppgt'])->name('ppgt');
Route::get('/smgt', [App\Http\Controllers\LandingController::class, 'smgt'])->name('smgt');

// Backward compatibility for sub-routes
Route::get('/pkbgt/program-kerja', [App\Http\Controllers\LandingController::class, 'programKerjaPkbgt'])->name('program-kerja-pkbgt');
Route::get('/pkbgt/pengurus', function () {
    return view('landing.oig.pengurus-pkbgt');
})->name('pengurus-pkbgt');
Route::get('/pkbgt/kegiatan', function () {
    return view('landing.oig.kegiatan-pkbgt');
})->name('kegiatan-pkbgt');

Route::get('/pwgt/program-kerja', [App\Http\Controllers\LandingController::class, 'programKerjaPwgt'])->name('program-kerja-pwgt');
Route::get('/pwgt/pengurus', function () {
    return view('landing.oig.pengurus-pwgt');
})->name('pengurus-pwgt');
Route::get('/pwgt/kegiatan', function () {
    return view('landing.oig.kegiatan-pwgt');
})->name('kegiatan-pwgt');

Route::get('/ppgt/program-kerja', [App\Http\Controllers\LandingController::class, 'programKerjaPpgt'])->name('program-kerja-ppgt');
Route::get('/ppgt/pengurus', function () {
    return view('landing.oig.pengurus-ppgt');
})->name('pengurus-ppgt');
Route::get('/ppgt/kegiatan', function () {
    return view('landing.oig.kegiatan-ppgt');
})->name('kegiatan-ppgt');

Route::get('/smgt/program-kerja', [App\Http\Controllers\LandingController::class, 'programKerjaSmgt'])->name('program-kerja-smgt');
Route::get('/smgt/pengurus', function () {
    return view('landing.oig.pengurus-smgt');
})->name('pengurus-smgt');
Route::get('/smgt/kegiatan', function () {
    return view('landing.oig.kegiatan-smgt');
})->name('kegiatan-smgt');

// Contact Routes
Route::prefix('contact')->group(function () {
    Route::get('/pengelolaan-surat-nikah', [App\Http\Controllers\LandingController::class, 'pengelolaanSuratNikah'])->name('pengelolaan-surat-nikah');
    Route::get('/pengelolaan-baptis', [App\Http\Controllers\LandingController::class, 'pengelolaanBaptis'])->name('pengelolaan-baptis');
    Route::get('/daftar-anggota', [App\Http\Controllers\LandingController::class, 'daftarAnggota'])->name('daftar-anggota');
    Route::get('/saran', [App\Http\Controllers\LandingController::class, 'saran'])->name('saran');
});

// Form submission routes
Route::post('/submit-surat-nikah', [App\Http\Controllers\LandingController::class, 'submitSuratNikah'])->name('submit-surat-nikah');
Route::post('/submit-baptis', [App\Http\Controllers\LandingController::class, 'submitBaptis'])->name('submit-baptis');
Route::post('/submit-anggota', [App\Http\Controllers\LandingController::class, 'submitAnggota'])->name('submit-anggota');
Route::post('/submit-saran', [App\Http\Controllers\LandingController::class, 'submitSaran'])->name('submit-saran');

// Email verification routes
Route::post('/send-verification-nikah', [App\Http\Controllers\LandingController::class, 'sendVerificationNikah'])->name('send-verification-nikah');
Route::post('/verify-email-nikah', [App\Http\Controllers\LandingController::class, 'verifyEmailNikah'])->name('verify-email-nikah');
Route::post('/send-verification-anggota', [App\Http\Controllers\LandingController::class, 'sendVerificationAnggota'])->name('send-verification-anggota');
Route::post('/verify-email-anggota', [App\Http\Controllers\LandingController::class, 'verifyEmailAnggota'])->name('verify-email-anggota');
Route::post('/send-verification-saran', [App\Http\Controllers\LandingController::class, 'sendVerificationSaran'])->name('send-verification-saran');
Route::post('/verify-email-saran', [App\Http\Controllers\LandingController::class, 'verifyEmailSaran'])->name('verify-email-saran');

// Additional routes for JavaScript compatibility
Route::post('/send-verification-code', [App\Http\Controllers\LandingController::class, 'sendVerificationSaran']);
Route::post('/verify-email-code', [App\Http\Controllers\LandingController::class, 'verifyEmailSaran']);

Route::middleware(['auth'])->group(function () {
    Route::resource('pastors', PastorController::class);
    Route::resource('congregations', CongregationController::class);
});

// Management routes
Route::middleware(['auth'])->group(function () {
    Route::resource('marriages', MarriageController::class);
    Route::put('marriages/{marriage}/status', [MarriageController::class, 'updateStatus'])->name('marriages.update-status');

    Route::resource('baptisms', BaptismController::class);
    Route::put('baptisms/{baptism}/status', [BaptismController::class, 'updateStatus'])->name('baptisms.update-status');

    Route::resource('members', MemberController::class);
    Route::put('members/{member}/status', [MemberController::class, 'updateStatus'])->name('members.update-status');

    Route::resource('suggestions', SuggestionController::class);
    Route::put('suggestions/{suggestion}/status', [SuggestionController::class, 'updateStatus'])->name('suggestions.update-status');

    Route::resource('inventory', InventoryController::class);
    Route::put('inventory/{inventory}/stock', [InventoryController::class, 'updateStock'])->name('inventory.update-stock');
    Route::get('inventory/export/excel', [InventoryController::class, 'exportExcel'])->name('inventory.export.excel');

    Route::get('information-dashboard', [InformationController::class, 'dashboard'])->name('information.dashboard');
    Route::resource('information', InformationController::class);



    // Pendeta Jemaat Route - now handled by pastors resource route

    // Warta Mingguan Routes
    Route::resource('warta-mingguan', WartaMingguanController::class);
    Route::get('warta-mingguan/{id}/download', [WartaMingguanController::class, 'download'])->name('warta-mingguan.download');
    Route::get('warta-mingguan/{id}/view', [WartaMingguanController::class, 'view'])->name('warta-mingguan.view');

    // Program Kerja Routes (excluding show)
    Route::resource('program-kerja', ProgramKerjaController::class)->except(['show']);

    // Program Kerja Jemaat Selili Routes (Admin) - Menu terpisah dengan controller terpisah
    Route::get('program-kerja-jemaat', [App\Http\Controllers\ProgramKerjaJemaatController::class, 'index'])->name('program-kerja-jemaat.index');
    Route::get('program-kerja-jemaat/create', [App\Http\Controllers\ProgramKerjaJemaatController::class, 'create'])->name('program-kerja-jemaat.create');
    Route::post('program-kerja-jemaat', [App\Http\Controllers\ProgramKerjaJemaatController::class, 'store'])->name('program-kerja-jemaat.store');
    Route::get('program-kerja-jemaat/{id}', [App\Http\Controllers\ProgramKerjaJemaatController::class, 'show'])->name('program-kerja-jemaat.show');
    Route::get('program-kerja-jemaat/{id}/edit', [App\Http\Controllers\ProgramKerjaJemaatController::class, 'edit'])->name('program-kerja-jemaat.edit');
    Route::put('program-kerja-jemaat/{id}', [App\Http\Controllers\ProgramKerjaJemaatController::class, 'update'])->name('program-kerja-jemaat.update');
    Route::delete('program-kerja-jemaat/{id}', [App\Http\Controllers\ProgramKerjaJemaatController::class, 'destroy'])->name('program-kerja-jemaat.destroy');

    // Setting Home Routes (Admin)
    Route::get('setting-home', [App\Http\Controllers\SettingHomeController::class, 'index'])->name('setting-home.index');
    Route::get('setting-home/create', [App\Http\Controllers\SettingHomeController::class, 'create'])->name('setting-home.create');
    Route::post('setting-home', [App\Http\Controllers\SettingHomeController::class, 'store'])->name('setting-home.store');
    Route::get('setting-home/{id}', [App\Http\Controllers\SettingHomeController::class, 'show'])->name('setting-home.show');
    Route::get('setting-home/{id}/edit', [App\Http\Controllers\SettingHomeController::class, 'edit'])->name('setting-home.edit');
    Route::put('setting-home/{id}', [App\Http\Controllers\SettingHomeController::class, 'update'])->name('setting-home.update');
    Route::delete('setting-home/{id}', [App\Http\Controllers\SettingHomeController::class, 'destroy'])->name('setting-home.destroy');

    // Worship Schedule Routes
    Route::resource('worship-schedules', App\Http\Controllers\WorshipScheduleController::class);

    // Admin OIG Routes
    Route::prefix('admin/oig')->name('admin.oig.')->group(function () {
        Route::get('/pkbgt', [App\Http\Controllers\Admin\OigController::class, 'pkbgt'])->name('pkbgt');
        Route::get('/pwgt', [App\Http\Controllers\Admin\OigController::class, 'pwgt'])->name('pwgt');
        Route::get('/ppgt', [App\Http\Controllers\Admin\OigController::class, 'ppgt'])->name('ppgt');
        Route::get('/smgt', [App\Http\Controllers\Admin\OigController::class, 'smgt'])->name('smgt');
    });

});









// Calendar Events API Routes
Route::middleware(['auth', 'verified'])->prefix('api/calendar')->group(function () {
    Route::get('/events', [CalendarEventController::class, 'getEvents'])->name('calendar.events');
    Route::post('/events', [CalendarEventController::class, 'store'])->name('calendar.store');
    Route::put('/events/{event}', [CalendarEventController::class, 'update'])->name('calendar.update');
    Route::delete('/events/{event}', [CalendarEventController::class, 'destroy'])->name('calendar.destroy');
    Route::get('/events/date', [CalendarEventController::class, 'getEventsForDate'])->name('calendar.events.date');
    Route::patch('/events/{event}/toggle', [CalendarEventController::class, 'toggleActive'])->name('calendar.toggle');
});

// Public Calendar Events API Routes (for dashboard access)
Route::prefix('api/public/calendar')->group(function () {
    Route::get('/events', [CalendarEventController::class, 'getPublicEvents'])->name('calendar.public.events');
});

// Email Verification Routes
Route::prefix('api/email-verification')->group(function () {
    Route::post('/send-code', [App\Http\Controllers\EmailVerificationController::class, 'sendCode'])->name('email.send-code');
    Route::post('/verify-code', [App\Http\Controllers\EmailVerificationController::class, 'verifyCode'])->name('email.verify-code');
    Route::post('/check-verification', [App\Http\Controllers\EmailVerificationController::class, 'checkVerification'])->name('email.check-verification');
});

require __DIR__.'/auth.php';
