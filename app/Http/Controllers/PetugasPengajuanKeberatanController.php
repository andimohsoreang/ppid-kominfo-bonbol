<?php

namespace App\Http\Controllers;

use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasPengajuanKeberatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $datapis = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
                ->orderBy('pengajuan_keberatans.created_at', 'desc')
                ->get(['pengajuan_keberatans.*']);

            return view('be.pengajuankeberatan.home', [
                'title' => 'Pengajuan Keberatan',
                'datapis' => $datapis
            ]);
        } else {
            $datapis = PengajuanKeberatan::join('permohonan_informasis', 'pengajuan_keberatans.permoinfo_id', '=', 'permohonan_informasis.id')
                ->where('permohonan_informasis.petugas_id', Auth::user()->id)
                ->orderBy('pengajuan_keberatans.created_at', 'desc')
                ->get(['pengajuan_keberatans.*']);
    
            return view('be.pengajuankeberatan.home', [
                'title' => 'Pengajuan Keberatan',
                'datapis' => $datapis
            ]);
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
        $pengkeb = PengajuanKeberatan::findorfail($id);

        $permoinfo = PermohonanInformasi::where('id', $pengkeb->permoinfo_id)->first(['petugas_id']);

        // dd($permoinfo->petugas_id);

        if (Auth::user()->hasRole('admin')) {
            return view('be.pengajuankeberatan.show', [
                'title' => 'Detail Pengajuan Keberatan',
                'data' => $pengkeb
            ]);
        } else {
            if ($permoinfo->petugas_id == Auth::user()->id) {
                return view('be.pengajuankeberatan.show', [
                    'title' => 'Detail Pengajuan Keberatan',
                    'data' => $pengkeb
                ]);
            } else {
                Alert::error('Maaf','Anda tidak mempunyai akses ke halaman ini.');
                return redirect()->route('petugas.pengajuankeberatan');
            }
        }


    }

    public function terima($id)
    {
        $data = PengajuanKeberatan::findorfail($id);
        $data2 = PermohonanInformasi::where('id',$data->permoinfo_id);

        $data->update([
            'status' => 1,
        ]);

        $data2->update([
            'status' => 4,
        ]);

        return view('be.pengajuankeberatan.show', [
            'title' => 'Form Pesan Pengajuan Keberatan',
            'data' => $data
        ]);
    }

    public function tolak($id)
    {
        $data = PengajuanKeberatan::findorfail($id);

        $data->update([
            'status' => 2,
        ]);

        return view('be.pengajuankeberatan.show', [
            'title' => 'Form Penolakan Pengajuan Keberatan',
            'data' => $data
        ]);
    }

    public function sendterima(Request $request, $id)
    {
        $request->validate([
            'pesan' => ['required'],
            'file' => ['required'],
        ]);

        $file = $request->file;
        $new_file = time().$file->getClientOriginalName();
        $file->move('uploads/foruser/', $new_file);

        $data2 = PermohonanInformasi::findorfail($id);

        // $data = PengajuanKeberatan::findorfail($data2->id);

        $data2->update([
            'pesan' => $request->pesan,
            'file' => 'uploads/foruser/'.$new_file,
            'status' => 2
        ]);

        if($data2){
            Alert::success('Success','Data berhasil di kirim');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.pengajuankeberatan');
            } else {
                return redirect()->route('petugas.pengajuankeberatan');
            }
        } else {
            Alert::error('Failed', 'Data gagal di kirim');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.pengajuankeberatan');
            } else {
                return redirect()->route('petugas.pengajuankeberatan');
            }
        }
    }

    public function sendtolak(Request $request, $id)
    {
        $request->validate([
            'alasan' => ['required'],
        ]);

        $data = PengajuanKeberatan::findorfail($id);

        $data->update([
            'alasan' => $request->alasan,
            'status' => 2
        ]);

        if($data){
            Alert::success('Success','Data berhasil di tolak');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.pengajuankeberatan');
            } else {
                return redirect()->route('petugas.pengajuankeberatan');
            }
        } else {
            Alert::error('Failed', 'Data gagal di tolak');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.pengajuankeberatan');
            } else {
                return redirect()->route('petugas.pengajuankeberatan');
            }
        }
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
