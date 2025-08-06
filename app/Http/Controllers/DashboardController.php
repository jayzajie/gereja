<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Pastor;
use App\Models\Congregation;
use App\Models\Marriage;
use App\Models\Baptism;
use App\Models\Suggestion;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics for dashboard
        $stats = [
            'total_members' => Member::count(),
            'pending_members' => Member::where('status', 'pending')->count(),
            'approved_members' => Member::where('status', 'approved')->count(),
            'total_pastors' => Pastor::where('status', 'active')->count(),
            'total_congregations' => Congregation::where('status', 'active')->count(),
            'total_marriages' => Marriage::count(),
            'pending_marriages' => Marriage::where('status', 'pending')->count(),
        ];

        // Get recent members
        $recent_members = Member::latest()->take(8)->get();

        // Get member status distribution for pie chart
        $member_status_distribution = [
            'approved' => Member::where('status', 'approved')->count(),
            'pending' => Member::where('status', 'pending')->count(),
            'rejected' => Member::where('status', 'rejected')->count(),
        ];

        // Get monthly member registrations for the current year
        $monthly_registrations = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthly_registrations[] = Member::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $i)
                ->count();
        }

        return view('dashboard.index', [
            'total_members' => $stats['total_members'],
            'active_members' => $stats['approved_members'],
            'total_marriages' => $stats['total_marriages'],
            'total_baptisms' => Baptism::count(),
            'member_status_distribution' => $member_status_distribution,
            'recent_members' => $recent_members,
            'monthly_registrations' => $monthly_registrations
        ]);
    }

    public function memberPhotos()
    {
        // Get all members with photos for the grid view
        $members = Member::whereNotNull('foto')
            ->paginate(12);

        return view('dashboard.member-photos', compact('members'));
    }

    public function memberPhotoUpload(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'photo_type' => 'required|in:foto_diri,foto_ktp',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $member = Member::findOrFail($request->member_id);

        if ($request->hasFile('photo')) {
            $photoType = $request->photo_type;
            $fileName = time() . '_' . $photoType . '_' . $member->id . '.' . $request->photo->extension();
            $path = $request->photo->storeAs('member_photos', $fileName, 'public');

            $member->update([
                $photoType => $path
            ]);
        }

        return redirect()->back()->with('success', 'Photo uploaded successfully!');
    }

    public function contactData(Request $request)
    {
        // Clean and validate search input
        $search = $request->get('search');
        $search = $search ? trim($search) : null;
        $search = ($search && strlen($search) > 0) ? $search : null;

        $tab = $request->get('tab', 'marriages'); // Default tab

        // Build queries with search functionality
        $marriagesQuery = Marriage::query();
        $baptismsQuery = Baptism::query();
        $membersQuery = Member::query();
        $suggestionsQuery = Suggestion::query();

        // Apply search filters only if search term is not empty
        if ($search && strlen($search) > 0) {
            $marriagesQuery->where(function($q) use ($search) {
                $q->where('nama_calon_pria', 'like', "%{$search}%")
                  ->orWhere('nama_calon_wanita', 'like', "%{$search}%")
                  ->orWhere('no_telepon_pria', 'like', "%{$search}%")
                  ->orWhere('no_telepon_wanita', 'like', "%{$search}%")
                  ->orWhere('email_pria', 'like', "%{$search}%")
                  ->orWhere('email_wanita', 'like', "%{$search}%");
            });

            $baptismsQuery->where(function($q) use ($search) {
                $q->where('nama_jemaat', 'like', "%{$search}%")
                  ->orWhere('nama_ayah', 'like', "%{$search}%")
                  ->orWhere('nama_ibu', 'like', "%{$search}%")
                  ->orWhere('nomor_baptis', 'like', "%{$search}%")
                  ->orWhere('dibaptis_oleh', 'like', "%{$search}%");
            });

            $membersQuery->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('pekerjaan', 'like', "%{$search}%");
            });

            $suggestionsQuery->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nama_gmail', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('saran', 'like', "%{$search}%");
            });
        }

        // Get paginated results
        $marriages = $marriagesQuery->latest()->paginate(10, ['*'], 'marriages');
        $baptisms = $baptismsQuery->latest()->paginate(10, ['*'], 'baptisms');
        $members = $membersQuery->latest()->paginate(10, ['*'], 'members');
        $suggestions = $suggestionsQuery->latest()->paginate(10, ['*'], 'suggestions');

        // Append search parameter to pagination links (only if search is not empty)
        $appendParams = ['tab' => 'marriages'];
        if ($search) $appendParams['search'] = $search;
        $marriages->appends($appendParams);

        $appendParams = ['tab' => 'baptisms'];
        if ($search) $appendParams['search'] = $search;
        $baptisms->appends($appendParams);

        $appendParams = ['tab' => 'members'];
        if ($search) $appendParams['search'] = $search;
        $members->appends($appendParams);

        $appendParams = ['tab' => 'suggestions'];
        if ($search) $appendParams['search'] = $search;
        $suggestions->appends($appendParams);

        // Get statistics (total counts, not filtered)
        $stats = [
            'total_marriages' => Marriage::count(),
            'pending_marriages' => Marriage::where('status', 'pending')->count(),
            'total_baptisms' => Baptism::count(),
            'pending_baptisms' => Baptism::where('status', 'pending')->count(),
            'total_members' => Member::count(),
            'pending_members' => Member::where('status', 'pending')->count(),
            'total_suggestions' => Suggestion::count(),
        ];

        return view('dashboard.contact-data', compact('marriages', 'baptisms', 'members', 'suggestions', 'stats', 'search', 'tab'));
    }

    public function updateContactStatus(Request $request)
    {
        $request->validate([
            'type' => 'required|in:marriage,baptism,member,suggestion',
            'id' => 'required|integer',
            'status' => 'required|in:approved,rejected,pending'
        ]);

        $type = $request->type;
        $id = $request->id;
        $status = $request->status;

        try {
            switch ($type) {
                case 'marriage':
                    $item = Marriage::findOrFail($id);
                    $item->update(['status' => $status]);
                    $message = "Status pernikahan berhasil diubah menjadi " . ucfirst($status);
                    break;

                case 'baptism':
                    $item = Baptism::findOrFail($id);
                    $item->update(['status' => $status]);
                    $message = "Status baptisan berhasil diubah menjadi " . ucfirst($status);
                    break;

                case 'member':
                    $item = Member::findOrFail($id);
                    $item->update(['status' => $status]);
                    $message = "Status anggota berhasil diubah menjadi " . ucfirst($status);
                    break;

                case 'suggestion':
                    $item = Suggestion::findOrFail($id);
                    $item->update(['status' => $status]);
                    $message = "Status saran berhasil diubah menjadi " . ucfirst($status);
                    break;

                default:
                    return response()->json(['success' => false, 'message' => 'Tipe data tidak valid']);
            }

            return response()->json(['success' => true, 'message' => $message]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function pendetaJemaat()
    {
        // Redirect to pastors index for admin management
        return redirect()->route('pastors.index');
    }

    public function wartaMingguan()
    {
        return view('admin.warta-mingguan');
    }

    public function programKerja()
    {
        // Ambil data program kerja dari Information model dengan kategori 'program-kerja'
        $programKerja = \App\Models\Information::where('category', 'program-kerja')
            ->orderBy('priority', 'desc')
            ->orderBy('publish_date', 'desc')
            ->paginate(10);

        return view('admin.program-kerja', compact('programKerja'));
    }

    public function pkbgt()
    {
        return view('admin.oig.pkbgt');
    }

    public function pwgt()
    {
        return view('admin.oig.pwgt');
    }

    public function ppgt()
    {
        return view('admin.oig.ppgt');
    }

    public function smgt()
    {
        return view('admin.oig.smgt');
    }
}
