<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\InformasiPublik;
use App\Models\KontakKami;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\ProfilKantor;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infopub_total = InformasiPublik::count(); 
        $permoinfo_total = PermohonanInformasi::count(); 
        $pengkeb_total = PengajuanKeberatan::count(); 

        $profilkantor = ProfilKantor::first();

        return view('home', compact('infopub_total','permoinfo_total','pengkeb_total', 'profilkantor'));
    }

    public function statistik()
    {
        $infopub_total = InformasiPublik::count(); 
        $permoinfo_total = PermohonanInformasi::count(); 
        $pengkeb_total = PengajuanKeberatan::count(); 
        $permoinfo_selesai_total = PermohonanInformasi::where('status', 2)->count(); 

        $infopub = InformasiPublik::join('klasifikasis', 'informasi_publiks.klasifikasi_id', '=', 'klasifikasis.id')->select(DB::raw('COUNT(*) as count, klasifikasis.klasifikasi'))
            ->groupBy('klasifikasis.klasifikasi')->get();

            // dd($infopub);

        $permoinfo_belum = PermohonanInformasi::where('status', 0)->count();
        $permoinfo_diproses = PermohonanInformasi::where('status', 1)->count();
        $permoinfo_diberikan = PermohonanInformasi::where('status', 2)->count();
        $permoinfo_ditolak = PermohonanInformasi::where('status', 3)->count();

        $permoinfo = PermohonanInformasi::join('users', 'permohonan_informasis.user_id', '=', 'users.id')
            ->whereMonth('permohonan_informasis.created_at', Carbon::now()->month)
            ->select(DB::raw('COUNT(*) as count, users.name'))
            ->groupBy('users.name')
            ->take(10)
            ->get();

        $pengkeb = PengajuanKeberatan::join('users', 'pengajuan_keberatans.user_id', '=', 'users.id')
            ->whereMonth('pengajuan_keberatans.created_at', Carbon::now()->month)
            ->select(DB::raw('COUNT(*) as count, users.name'))
            ->groupBy('users.name')
            ->take(10)
            ->get();

            // dd($pengkeb);

        $profilkantor = ProfilKantor::first();

        return view('statistik', compact('profilkantor', 'infopub', 'permoinfo', 'pengkeb', 'infopub_total', 'permoinfo_total', 'pengkeb_total', 'permoinfo_selesai_total', 'permoinfo_belum', 'permoinfo_diproses', 'permoinfo_diberikan', 'permoinfo_ditolak'));
    }

    public function indexlogin()
    {
        $permoinfo = PermohonanInformasi::where('user_id', Auth::user()->id)->count();
        $permoinfo_diproses = PermohonanInformasi::where('user_id', Auth::user()->id)->where('status', 1)->count();
        $permoinfo_diterima = PermohonanInformasi::where('user_id', Auth::user()->id)->where('status', 2)->count();
        $permoinfo_ditolak = PermohonanInformasi::where('user_id', Auth::user()->id)->where('status', 3)->count();
        $permoinfo_keberatan = PermohonanInformasi::where('user_id', Auth::user()->id)->where('status', 4)->count();

        $pengkeb = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
            ->where('permohonan_informasis.user_id', Auth::user()->id)
            ->count();
        $pengkeb_diterima = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
            ->where('permohonan_informasis.user_id', Auth::user()->id)
            ->where('pengajuan_keberatans.status', '=', 1)
            ->count();
        $pengkeb_ditolak = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
            ->where('permohonan_informasis.user_id', Auth::user()->id)
            ->where('pengajuan_keberatans.status', '=', 2)
            ->count();
            
        return view('be.dashboard', [
            'title' => 'Dashboard',
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

    public function indexpengajuankeberatan(){
        return view('be.pengajuankeberatan.home', [
            'title' => 'Pengajuan Keberatan'
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
            'alamat' => ['required'],
            'no_telp' => ['required'],
            'pekerjaan' => ['required'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$id],
            'no_identitas' => ['required'],
            'name' => ['required'],
            'file' => ['mimes:png,jpg,jpeg', 'max:2080'],
        ]);

        $user = User::findorfail($id);
        $biodata = Biodata::where('user_id', $user->id)->first();

        if ($request->has('file')) {
            if (File::exists($request->file_lama)) {
                File::delete($request->file_lama);
            }

            $file =  $request->file;
            $newfile = time().$file->getClientOriginalName();

            if ($request->kategori == 1) {
                $file->move('uploads/user/lembaga/', $newfile);
                $biodata_punya = [
                    'no_identitas' => $request->no_identitas,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
                    'pekerjaan' => $request->pekerjaan,
                    'file_path' => 'uploads/user/lembaga/'.$newfile,
                ];
            } else {
                $file->move('uploads/user/perorangan/', $newfile);
                $biodata_punya = [
                    'no_identitas' => $request->no_identitas,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
                    'pekerjaan' => $request->pekerjaan,
                    'file_path' => 'uploads/user/perorangan/'.$newfile,
                ];
            }

            $user_punya = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            $user->update($user_punya);
            $biodata->update($biodata_punya);
        } else {
            $biodata_punya = [
                'no_identitas' => $request->no_identitas,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'pekerjaan' => $request->pekerjaan,
            ];

            $user_punya = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            $user->update($user_punya);
            $biodata->update($biodata_punya);
        }

        Alert::success('Berhasil', 'Data anda berhasil diperbarui');
        return redirect()->route('user.akun');
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
        return redirect()->route('user.password');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kontakkami(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email'],
            'pesan' => ['required']
        ]);

        $kontakkami = KontakKami::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan
        ]);

        if ($kontakkami) {
            Alert::success('Berhasil', 'Pesan anda berhasil dikirim');
            return redirect()->route('home');
        } else {
            Alert::success('Berhasil', 'PPesan anda gagal dikirim');
            return redirect()->route('home');
        }
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
