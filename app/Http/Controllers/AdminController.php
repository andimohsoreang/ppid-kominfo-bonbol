<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        $infopub = InformasiPublik::count();

        $permoinfo = PermohonanInformasi::count();
        $permoinfo_belum = PermohonanInformasi::where('status', 0)->count();
        $permoinfo_diproses = PermohonanInformasi::where('status', 1)->count();
        $permoinfo_diterima = PermohonanInformasi::where('status', 2)->count();
        $permoinfo_ditolak = PermohonanInformasi::where('status', 3)->count();
        $permoinfo_keberatan = PermohonanInformasi::where('status', 4)->count();

        $pengkeb = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
            ->count();
        $pengkeb_diterima = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
            ->where('pengajuan_keberatans.status', '=', 1)
            ->count();
        $pengkeb_ditolak = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
            ->where('pengajuan_keberatans.status', '=', 2)
            ->count();
        $pengkeb_belum = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
            ->where('pengajuan_keberatans.status', '=', 0)
            ->count();

            // dd($pengkeb);

        return view('be.dashboard', [
            "title" => "Dashboard",
            "infopub" => $infopub,
            "permoinfo" => $permoinfo,
            "pengkeb" => $pengkeb,
            "permoinfo_belum" => $permoinfo_belum,
            "permoinfo_diproses" => $permoinfo_diproses,
            "permoinfo_diterima" => $permoinfo_diterima,
            "permoinfo_ditolak" => $permoinfo_ditolak,
            "permoinfo_keberatan" => $permoinfo_keberatan,
            "pengkeb_diterima" => $pengkeb_diterima,
            "pengkeb_ditolak" => $pengkeb_ditolak,
            "pengkeb_belum" => $pengkeb_belum
        ]);
    }

    public function akun()
    {
        return view('be.account', [
            'title' => 'Pengaturan Akun'
        ]);
    }

    public function akunUpdate(Request $request, $id)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$id],
            'name' => ['required'],
        ]);

        $user = User::findorfail($id);

        $user_punya = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        $user->update($user_punya);
        
        Alert::success('Berhasil', 'Data anda berhasil diperbarui');
        return redirect()->route('admin.akun');
    }

    public function akunpassword()
    {
        return view('be.password',[
            'title' => 'Pengaturan Password'
        ]);
    }

    public function akunpasswordupdate(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'password_baru' => ['required'],
            'konfirmasi_password_baru' => ['same:password_baru']
        ]);

        $user = User::findorfail($id);
        $user->update([
            'password' => Hash::make($request->password_baru),
        ]);

        Alert::success('Berhasil', 'Password anda berhasil diperbarui');
        return redirect()->route('admin.password');
    }
}
