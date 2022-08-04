<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infopub = InformasiPublik::where('user_id', Auth::user()->id)->count();

        $permoinfo = PermohonanInformasi::where('petugas_id', Auth::user()->id)->count();
        $permoinfo_diproses = PermohonanInformasi::where('petugas_id', Auth::user()->id)->where('status', 1)->count();
        $permoinfo_diterima = PermohonanInformasi::where('petugas_id', Auth::user()->id)->where('status', 2)->count();
        $permoinfo_ditolak = PermohonanInformasi::where('petugas_id', Auth::user()->id)->where('status', 3)->count();
        $permoinfo_keberatan = PermohonanInformasi::where('petugas_id', Auth::user()->id)->where('status', 4)->count();

        $pengkeb = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
            ->where('permohonan_informasis.petugas_id', Auth::user()->id)
            ->count();
        $pengkeb_diterima = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
            ->where('permohonan_informasis.petugas_id', Auth::user()->id)
            ->where('pengajuan_keberatans.status', '=', 1)
            ->count();
        $pengkeb_ditolak = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
            ->where('permohonan_informasis.petugas_id', Auth::user()->id)
            ->where('pengajuan_keberatans.status', '=', 2)
            ->count();

            // dd($pengkeb);

        return view('be.dashboard', [
            "title" => "Dashboard",
            "infopub" => $infopub,
            "permoinfo" => $permoinfo,
            "pengkeb" => $pengkeb,
            "permoinfo_diproses" => $permoinfo_diproses,
            "permoinfo_diterima" => $permoinfo_diterima,
            "permoinfo_ditolak" => $permoinfo_ditolak,
            "permoinfo_keberatan" => $permoinfo_keberatan,
            "pengkeb_diterima" => $pengkeb_diterima,
            "pengkeb_ditolak" => $pengkeb_ditolak
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
        return redirect()->route('petugas.akun');
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
        return redirect()->route('petugas.password');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
