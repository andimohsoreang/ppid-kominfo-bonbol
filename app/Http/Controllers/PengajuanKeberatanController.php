<?php

namespace App\Http\Controllers;

use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanKeberatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datapis = PengajuanKeberatan::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('be.pengajuankeberatan.home', [
            'title' => 'Pengajuan Keberatan',
            'datapis' => $datapis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permoinfo = PermohonanInformasi::where('status', 3)->select('*')->whereNotIn('id',function($query) {

            $query->select('permoinfo_id')->from('pengajuan_keberatans');
         
         })->get();
        // dd($permoinfo);

        // $datas = PermohonanInformasi::where('user_id', Auth::user()->id)
        //     ->where('status', 3)
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        return view('be.pengajuankeberatan.create', [
            'title' => 'Buat Pengajuan Keberatan',
            'datas' => $permoinfo
        ]);
    }

    public function getPermohonanInformasi($id)
    {   
        $perins = PermohonanInformasi::where('id', $id)->orderBy('created_at', 'desc')->get();

        return response()->json($perins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'permoinfo_id' => ['required'],
            'pesan' => ['required'],
        ]);

        $pengkeb = new PengajuanKeberatan([
            'user_id' => Auth::user()->id,
            'pesan' => $request->pesan,
            'permoinfo_id' => $request->permoinfo_id,
            'status' => 0,
        ]);
        $pengkeb->save();

        if ($pengkeb) {
            Alert::success('Berhasil','Pengajuan keberatan berhasil dibuat.');
            return redirect()->route('user.pengajuankeberatan');
        } else {
            Alert::error('Gagal','Pengajuan keberatan gagal dibuat.');
            return redirect()->route('user.pengajuankeberatan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengajuanKeberatan  $pengajuanKeberatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengkeb = PengajuanKeberatan::findorfail($id);

        if ($pengkeb->user_id == Auth::user()->id) {
            return view('be.pengajuankeberatan.show', [
                'title' => 'Detail Pengajuan Keberatan',
                'data' => $pengkeb
            ]);
        } else {
            Alert::error('Maaf','Anda tidak mempunyai akses ke halaman ini.');
            return redirect()->route('user.pengajuankeberatan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengajuanKeberatan  $pengajuanKeberatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengkeb = PengajuanKeberatan::findorfail($id);
        // $pengkeb2 = PengajuanKeberatan::where('user_id', Auth::user()->id);
        if (Auth::user()->hasRole('admin')) {
            $datas = PermohonanInformasi::where('status', 3)
                ->where('id', '!=', $pengkeb->permoinfo_id)
                ->orderBy('created_at', 'desc')
                ->get();
    
            return view('be.pengajuankeberatan.edit', [
                'title' => 'Edit Pengajuan Keberatan',
                'pengkeb' => $pengkeb,
                'datas' => $datas
            ]);
        } else {
            if ($pengkeb->status == 0) {
                $datas = PermohonanInformasi::where('user_id', Auth::user()->id)
                ->where('status', 3)
                ->where('id', '!=', $pengkeb->permoinfo_id)
                ->orderBy('created_at', 'desc')
                ->get();
        
                return view('be.pengajuankeberatan.edit', [
                    'title' => 'Edit Pengajuan Keberatan',
                    'pengkeb' => $pengkeb,
                    'datas' => $datas
                ]);
            } else {
                Alert::error('Maaf','Anda tidak mempunyai akses ke halaman ini.');
                return redirect()->route('user.pengajuankeberatan');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengajuanKeberatan  $pengajuanKeberatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'permoinfo_id' => ['required'],
            'pesan' => ['required'],
        ]);

        $pengkeb = PengajuanKeberatan::findorfail($id);
        
        $pengkeb->update([
            'pesan' => $request->pesan,
            'permoinfo_id' => $request->permoinfo_id,
        ]);

        if ($pengkeb) {
            Alert::success('Berhasil','Pengajuan keberatan berhasil diperbaruhi.');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.pengajuankeberatan');
            } else {
                return redirect()->route('user.pengajuankeberatan');
            }
        } else {
            Alert::error('Gagal','Pengajuan keberatan gagal diperbaruhi.');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.pengajuankeberatan');
            } else {
                return redirect()->route('user.pengajuankeberatan');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengajuanKeberatan  $pengajuanKeberatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengkeb = PengajuanKeberatan::findorfail($id);
        $pengkeb = PengajuanKeberatan::where('id', $pengkeb->id);
        $pengkeb->delete();

        if ($pengkeb) {
            Alert::success('Berhasil','Data pengajuan keberatan berhasil dihapus.');
            return redirect()->route('user.pengajuankeberatan');
        } else {
            Alert::error('Gagal','Data pengajuan keberatan gagal dihapus.');
            return redirect()->route('user.pengajuankeberatan');
        }
    }
}
