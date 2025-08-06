<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::orderBy('nama_lengkap')->get();

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Lk,Pr',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_pernikahan' => 'required|in:K,B,J,D',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'nama_pasangan' => 'nullable|string|max:255',
            'tanggal_baptis' => 'nullable|date',
            'tempat_baptis' => 'nullable|string|max:255',
            'tanggal_sidi' => 'nullable|date',
            'tempat_sidi' => 'nullable|string|max:255',
            'status' => 'required|in:pending,active,inactive',
        ]);

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_pernikahan' => 'required|in:Belum Menikah,Menikah,Duda,Janda',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'nama_pasangan' => 'nullable|string|max:255',
            'tanggal_baptis' => 'nullable|date',
            'tempat_baptis' => 'nullable|string|max:255',
            'tanggal_sidi' => 'nullable|date',
            'tempat_sidi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($member->foto) {
                Storage::disk('public')->delete($member->foto);
            }
            $validated['foto'] = $request->file('foto')->store('members', 'public');
        }

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        // Hapus foto jika ada
        if ($member->foto) {
            Storage::disk('public')->delete($member->foto);
        }

        $member->delete();

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil dihapus!');
    }

    /**
     * Export members to Excel
     */
    public function export()
    {
        $members = Member::orderBy('nama_lengkap')->get();

        $filename = 'daftar_anggota_jemaat_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($members) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, [
                'No',
                'Nama Lengkap',
                'Jenis Kelamin',
                'Tanggal Lahir',
                'Tempat Lahir',
                'Umur',
                'Alamat',
                'No HP',
                'Email',
                'Pekerjaan',
                'Status Pernikahan',
                'Nama Ayah',
                'Nama Ibu',
                'Nama Pasangan',
                'Tanggal Baptis',
                'Tempat Baptis',
                'Tanggal Sidi',
                'Tempat Sidi',
                'Status'
            ]);

            // Data CSV
            foreach ($members as $index => $member) {
                fputcsv($file, [
                    $index + 1,
                    $member->nama_lengkap,
                    $member->jenis_kelamin == 'Lk' ? 'Laki-laki' : 'Perempuan',
                    $member->tanggal_lahir->format('d/m/Y'),
                    $member->tempat_lahir,
                    $member->umur . ' tahun',
                    $member->alamat,
                    $member->no_hp ?? '-',
                    $member->email ?? '-',
                    $member->pekerjaan ?? '-',
                    $this->getStatusPernikahanText($member->status_pernikahan),
                    $member->nama_ayah ?? '-',
                    $member->nama_ibu ?? '-',
                    $member->nama_pasangan ?? '-',
                    $member->tanggal_baptis ? $member->tanggal_baptis->format('d/m/Y') : '-',
                    $member->tempat_baptis ?? '-',
                    $member->tanggal_sidi ? $member->tanggal_sidi->format('d/m/Y') : '-',
                    $member->tempat_sidi ?? '-',
                    $this->getStatusText($member->status)
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }



    /**
     * Helper method to get status pernikahan text
     */
    private function getStatusPernikahanText($status)
    {
        switch ($status) {
            case 'K': return 'Menikah';
            case 'B': return 'Belum Menikah';
            case 'J': return 'Janda';
            case 'D': return 'Duda';
            default: return '-';
        }
    }

    /**
     * Helper method to get status text
     */
    private function getStatusText($status)
    {
        switch ($status) {
            case 'active': return 'Aktif';
            case 'pending': return 'Pending';
            case 'inactive': return 'Tidak Aktif';
            default: return '-';
        }
    }
}
