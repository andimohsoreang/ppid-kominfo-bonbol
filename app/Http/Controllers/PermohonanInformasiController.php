<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\ProfilKantor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class PermohonanInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profilkantor = ProfilKantor::first();
        $total_user = User::whereHas('roles', function($q){
            $q->where('name', 'user');
        })->count();
        $total_lembaga= Biodata::where('kategori_pemohon', 1)->count();
        $total_perorangan= Biodata::where('kategori_pemohon', 0)->count();
        // dd($total_perorangan);

        return view('pemohon-register', compact('profilkantor', 'total_user', 'total_lembaga', 'total_perorangan'));
    }

    public function indexlembaga()
    {
        $profilkantor = ProfilKantor::first();
        return view('lembaga-register', compact('profilkantor'));
    }

    public function indexperorangan()
    {
        $profilkantor = ProfilKantor::first();
        return view('perorangan-register', compact('profilkantor'));
    }

    public function userpermohonaninformasi()
    {
        $datapis = PermohonanInformasi::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('be.permohonaninformasi.home', [
            'title' => 'Permohonan Informasi',
            'datapis' => $datapis
        ]);
    }

    public function usercreatepermohonaninformasi()
    {
        return view('be.permohonaninformasi.create', [
            'title' => 'Buat Permohonan Informasi'
        ]);
    }

    public function userstorepermohonaninformasi(Request $request)
    {
        $request->validate([
            'rincian' => ['required'],
            'tujuan' => ['required'],
            'mendapat' => ['required'],
        ]);

        if ($request->mendapat == "Soft Copy") {
            $cara = "Online By System";
        } else if ($request->mendapat == "Hard Copy") {
            $cara = "Mengambil Langsung";
        }

        $data = new PermohonanInformasi([
            'user_id' => Auth::user()->id,
            'rincian' => $request->rincian,
            'tujuan' => $request->tujuan,
            'mendapat' => $request->mendapat,
            'cara' => $cara,
            'status' => 0
        ]);
        $data->save();

        if ($data) {
            Alert::success('Berhasil','Permohonan berhasil dibuat.');
            return redirect()->route('user.permohonaninformasi');
        } else {
            Alert::error('Gagal','Permohonan gagal dibuat.');
            return redirect()->route('user.permohonaninformasi');
        }
    }

    public function usershowpermohonaninformasi($id)
    {
        $data = PermohonanInformasi::findorfail($id);

        if (Auth::user()->hasRole('user')) {
            if ($data->user_id == Auth::user()->id) {
                return view('be.permohonaninformasi.show', [
                    'title' => 'Detail Permohonan Informasi',
                    'data' => $data
                ]);
            } else {
                Alert::error('Maaf','Anda tidak mempunyai akses ke halaman ini.');
                return redirect()->route('user.permohonaninformasi');
            }
        } else {
            return view('be.permohonaninformasi.show', [
                'title' => 'Detail Permohonan Informasi',
                'data' => $data
            ]);
        }
    }

    public function usereditpermohonaninformasi($id)
    {
        $data = PermohonanInformasi::findorfail($id);

        if (Auth::user()->hasRole('user')) {
            if ($data->user_id == Auth::user()->id) {
                return view('be.permohonaninformasi.edit', [
                    'title' => 'Edit Permohonan Informasi',
                    'data' => $data
                ]);
            } else {
                Alert::error('Maaf','Anda tidak mempunyai akses ke halaman ini.');
                return redirect()->route('user.permohonaninformasi');
            }
        } else {
            return view('be.permohonaninformasi.edit', [
                'title' => 'Edit Permohonan Informasi',
                'data' => $data
            ]);
        }
    }

    public function userupdatepermohonaninformasi(Request $request, $id)
    {
        $request->validate([
            'rincian' => ['required'],
            'tujuan' => ['required'],
            'mendapat' => ['required'],
            'cara' => ['required']
        ]);

        $perin = PermohonanInformasi::findorfail($id);

        $perin->update([
            'rincian' => $request->rincian,
            'tujuan' => $request->tujuan,
            'mendapat' => $request->mendapat,
            'cara' => $request->cara
        ]);

        if ($perin) {
            Alert::success('Berhasil','Permohonan berhasil diperbaruhi.');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.permohonaninformasi');
            } else {
                return redirect()->route('user.permohonaninformasi');
            }
        } else {
            Alert::error('Gagal','Permohonan gagal diperbaruhi.');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.permohonaninformasi');
            } else {
                return redirect()->route('user.permohonaninformasi');
            }
        }
    }

    public function userdestroypermohonaninformasi($id)
    {
        $perin_check = PermohonanInformasi::findorfail($id);
        if (File::exists($perin_check->file)) {
            File::delete($perin_check->file);
        }
        $pengkeb = PengajuanKeberatan::where('permoinfo_id', $perin_check->id)->delete();
        $perin = PermohonanInformasi::where('id', $perin_check->id);
        $perin->delete();

        if ($perin) {
            Alert::success('Berhasil','Permohonan berhasil dihapus.');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.permohonaninformasi');
            } else {
                return redirect()->route('user.permohonaninformasi');
            }
        } else {
            Alert::error('Gagal','Permohonan gagal dihapus.');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.permohonaninformasi');
            } else {
                return redirect()->route('user.permohonaninformasi');
            }
        }
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
    public function storelembaga(Request $request)
    {   
        $request->validate([
            'alamat' => ['required'],
            'no_telp' => ['required'],
            'pekerjaan' => ['required'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'same:konfirmasi_password'],
            'no_identitas' => ['required'],
            'name' => ['required'],
            'file_path' => ['required', 'mimes:png,jpg,jpeg', 'max:2080'],
        ]);

        $inifile = $request->file_path;
        $new_inifile = time().$inifile->getClientOriginalName();

        $data_user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = new User($data_user);
        $user->save();

        $user->assignRole('user');

        $data_biodata = [
            'user_id' => $user->id,
            'kategori_pemohon' => 1,
            'no_identitas' => $request->no_identitas,
            'file_path' => 'uploads/user/lembaga/'.$new_inifile,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'pekerjaan' => $request->pekerjaan,
        ];

        $biodata = Biodata::create($data_biodata);

        $inifile->move('uploads/user/lembaga/', $new_inifile);

        if($biodata){
            Alert::success('Berhasil Registrasi','Registrasi Permohonan berhasil. Silahkan login!');
            return redirect()->route('lembaga.register');
        } else {
            Alert::error('Gagal Registrasi', 'Registrasi Permohonan gagal. Silahkan isi kembali form dengan benar!');
            return redirect()->route('lembaga.register');
        }
    }

    public function storeperorangan(Request $request)
    {   
        $request->validate([
            'alamat' => ['required'],
            'no_telp' => ['required'],
            'pekerjaan' => ['required'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'same:konfirmasi_password'],
            'no_identitas' => ['required'],
            'name' => ['required'],
            'file_path' => ['required', 'mimes:png,jpg,jpeg', 'max:2080'],
        ]);

        $inifile = $request->file_path;
        $new_inifile = time().$inifile->getClientOriginalName();

        $data_user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = new User($data_user);
        $user->save();

        $user->assignRole('user');

        $data_biodata = [
            'user_id' => $user->id,
            'kategori_pemohon' => 0,
            'no_identitas' => $request->no_identitas,
            'file_path' => 'uploads/user/perorangan/'.$new_inifile,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'pekerjaan' => $request->pekerjaan,
        ];

        $biodata = Biodata::create($data_biodata);

        $inifile->move('uploads/user/perorangan/', $new_inifile);

        if($biodata){
            Alert::success('Berhasil Registrasi','Registrasi Permohonan berhasil. Silahkan login!');
            return redirect()->route('perorangan.register');
        } else {
            Alert::error('Gagal Registrasi', 'Registrasi Permohonan gagal. Silahkan isi kembali form dengan benar!');
            return redirect()->route('perorangan.register');
        }
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
