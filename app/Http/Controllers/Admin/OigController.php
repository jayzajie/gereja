<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OigPengurus;
use App\Models\OigProgramKerja;
use App\Models\OigKegiatan;
use Illuminate\Support\Facades\Storage;

class OigController extends Controller
{
    /**
     * Display PKBGT admin page
     */
    public function pkbgt()
    {
        $pengurus = OigPengurus::byOrganisasi('PKBGT')->active()->ordered()->get();
        $programKerja = OigProgramKerja::byOrganisasi('PKBGT')->byTahun(date('Y'))->ordered()->get();
        $kegiatan = OigKegiatan::byOrganisasi('PKBGT')->byTahun(date('Y'))->ordered()->get();
        
        return view('admin.oig.pkbgt', compact('pengurus', 'programKerja', 'kegiatan'));
    }

    /**
     * Display PWGT admin page
     */
    public function pwgt()
    {
        $pengurus = OigPengurus::byOrganisasi('PWGT')->active()->ordered()->get();
        $programKerja = OigProgramKerja::byOrganisasi('PWGT')->byTahun(date('Y'))->ordered()->get();
        $kegiatan = OigKegiatan::byOrganisasi('PWGT')->byTahun(date('Y'))->ordered()->get();
        
        return view('admin.oig.pwgt', compact('pengurus', 'programKerja', 'kegiatan'));
    }

    /**
     * Display PPGT admin page
     */
    public function ppgt()
    {
        $pengurus = OigPengurus::byOrganisasi('PPGT')->active()->ordered()->get();
        $programKerja = OigProgramKerja::byOrganisasi('PPGT')->byTahun(date('Y'))->ordered()->get();
        $kegiatan = OigKegiatan::byOrganisasi('PPGT')->byTahun(date('Y'))->ordered()->get();
        
        return view('admin.oig.ppgt', compact('pengurus', 'programKerja', 'kegiatan'));
    }

    /**
     * Display SMGT admin page
     */
    public function smgt()
    {
        $pengurus = OigPengurus::byOrganisasi('SMGT')->active()->ordered()->get();
        $programKerja = OigProgramKerja::byOrganisasi('SMGT')->byTahun(date('Y'))->ordered()->get();
        $kegiatan = OigKegiatan::byOrganisasi('SMGT')->byTahun(date('Y'))->ordered()->get();
        
        return view('admin.oig.smgt', compact('pengurus', 'programKerja', 'kegiatan'));
    }

    // PENGURUS METHODS
    public function storePengurus(Request $request)
    {
        $request->validate([
            'organisasi' => 'required|in:PKBGT,PWGT,PPGT,SMGT',
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'periode_mulai' => 'required|integer|min:2020|max:2030',
            'periode_selesai' => 'required|integer|min:2020|max:2030',
            'urutan' => 'nullable|integer|min:0'
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('oig/pengurus', 'public');
        }

        OigPengurus::create($data);

        return redirect()->back()->with('success', 'Data pengurus berhasil ditambahkan!');
    }

    public function updatePengurus(Request $request, $id)
    {
        $pengurus = OigPengurus::findOrFail($id);
        
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'periode_mulai' => 'required|integer|min:2020|max:2030',
            'periode_selesai' => 'required|integer|min:2020|max:2030',
            'urutan' => 'nullable|integer|min:0'
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')->store('oig/pengurus', 'public');
        }

        $pengurus->update($data);

        return redirect()->back()->with('success', 'Data pengurus berhasil diperbarui!');
    }

    public function deletePengurus($id)
    {
        $pengurus = OigPengurus::findOrFail($id);
        
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }
        
        $pengurus->delete();

        return redirect()->back()->with('success', 'Data pengurus berhasil dihapus!');
    }

    // PROGRAM KERJA METHODS
    public function storeProgramKerja(Request $request)
    {
        $request->validate([
            'organisasi' => 'required|in:PKBGT,PWGT,PPGT,SMGT',
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan' => 'nullable|string',
            'sasaran' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'penanggung_jawab' => 'nullable|string|max:255',
            'anggaran' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,aktif,selesai,dibatalkan',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tahun' => 'required|integer|min:2020|max:2030',
            'urutan' => 'nullable|integer|min:0'
        ]);

        $data = $request->except('gambar');
        
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('oig/program-kerja', 'public');
        }

        OigProgramKerja::create($data);

        return redirect()->back()->with('success', 'Program kerja berhasil ditambahkan!');
    }

    public function updateProgramKerja(Request $request, $id)
    {
        $program = OigProgramKerja::findOrFail($id);
        
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan' => 'nullable|string',
            'sasaran' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'penanggung_jawab' => 'nullable|string|max:255',
            'anggaran' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,aktif,selesai,dibatalkan',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tahun' => 'required|integer|min:2020|max:2030',
            'urutan' => 'nullable|integer|min:0'
        ]);

        $data = $request->except('gambar');
        
        if ($request->hasFile('gambar')) {
            if ($program->gambar) {
                Storage::disk('public')->delete($program->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('oig/program-kerja', 'public');
        }

        $program->update($data);

        return redirect()->back()->with('success', 'Program kerja berhasil diperbarui!');
    }

    public function deleteProgramKerja($id)
    {
        $program = OigProgramKerja::findOrFail($id);
        
        if ($program->gambar) {
            Storage::disk('public')->delete($program->gambar);
        }
        
        $program->delete();

        return redirect()->back()->with('success', 'Program kerja berhasil dihapus!');
    }

    // KEGIATAN METHODS
    public function storeKegiatan(Request $request)
    {
        $request->validate([
            'organisasi' => 'required|in:PKBGT,PWGT,PPGT,SMGT',
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'tempat' => 'nullable|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'jumlah_peserta' => 'nullable|integer|min:0',
            'anggaran' => 'nullable|numeric|min:0',
            'status' => 'required|in:rencana,berlangsung,selesai,dibatalkan',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
            'tahun' => 'required|integer|min:2020|max:2030',
            'urutan' => 'nullable|integer|min:0'
        ]);

        $data = $request->except('gambar');
        
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('oig/kegiatan', 'public');
        }

        OigKegiatan::create($data);

        return redirect()->back()->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function updateKegiatan(Request $request, $id)
    {
        $kegiatan = OigKegiatan::findOrFail($id);
        
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'tempat' => 'nullable|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'jumlah_peserta' => 'nullable|integer|min:0',
            'anggaran' => 'nullable|numeric|min:0',
            'status' => 'required|in:rencana,berlangsung,selesai,dibatalkan',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
            'tahun' => 'required|integer|min:2020|max:2030',
            'urutan' => 'nullable|integer|min:0'
        ]);

        $data = $request->except('gambar');
        
        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('oig/kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->back()->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function deleteKegiatan($id)
    {
        $kegiatan = OigKegiatan::findOrFail($id);
        
        if ($kegiatan->gambar) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }
        
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Kegiatan berhasil dihapus!');
    }
}
