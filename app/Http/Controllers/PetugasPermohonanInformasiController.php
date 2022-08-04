<?php

namespace App\Http\Controllers;

use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasPermohonanInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $datapis = PermohonanInformasi::orderBy('created_at', 'desc')->get();
    
            return view('be.permohonaninformasi.home', [
                'title' => 'Permohonan Informasi',
                'datapis' => $datapis
            ]);
        } else {
            $datapis = PermohonanInformasi::where('petugas_id', Auth::user()->id)
            ->orWhere('petugas_id', null)
            ->orderBy('created_at', 'desc')->get();

            return view('be.permohonaninformasi.home', [
                'title' => 'Permohonan Informasi',
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function proses($id)
    {
        $data = PermohonanInformasi::findorfail($id);

        $data->update([
            'status' => 1,
            'petugas_id' => Auth::user()->id,
        ]);

        return view('be.permohonaninformasi.show', [
            'title' => 'Detail Permohonan Informasi',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $data = PermohonanInformasi::findorfail($id);

        if (Auth::user()->hasRole('admin')) {
            return view('be.permohonaninformasi.show', [
                'title' => 'Detail Permohonan Informasi',
                'data' => $data
            ]);
        } else {
            if ($data->petugas_id == Auth::user()->id) {
                return view('be.permohonaninformasi.show', [
                    'title' => 'Detail Permohonan Informasi',
                    'data' => $data
                ]);
            } else {
                Alert::error('Maaf','Anda tidak mempunyai akses ke halaman ini.');
                return redirect()->route('petugas.permohonaninformasi');
            }
        }
    }

    public function tolak($id)
    {
        $data = PermohonanInformasi::findorfail($id);

        $data->update([
            'status' => 3,
        ]);

        return view('be.permohonaninformasi.show', [
            'title' => 'Form Pesan Permohonan Informasi',
            'data' => $data
        ]);
    }

    public function terima($id)
    {
        $data = PermohonanInformasi::findorfail($id);

        $data->update([
            'status' => 2,
        ]);

        return view('be.permohonaninformasi.show', [
            'title' => 'Form Pesan Permohonan Informasi',
            'data' => $data
        ]);
    }

    public function batalterima($id)
    {
        $data = PermohonanInformasi::findorfail($id);

        if (File::exists($data->file)) {
            File::delete($data->file);
        }

        $data->update([
            'status' => 1,
            'alasan_tolak' => null,
            'pesan' => null,
            'file' => null,
        ]);

        return view('be.permohonaninformasi.show', [
            'title' => 'Form Pesan Permohonan Informasi',
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

        $data = PermohonanInformasi::findorfail($id);

        $data->update([
            'pesan' => $request->pesan,
            'file' => 'uploads/foruser/'.$new_file,
        ]);

        return view('be.permohonaninformasi.show', [
            'title' => 'Detail Permohonan Informasi',
            'data' => $data
        ]);

    }

    public function sendtolak(Request $request, $id)
    {
        $request->validate([
            'alasan_tolak' => ['required'],
        ]);

        $data = PermohonanInformasi::findorfail($id);

        $data->update([
            'alasan_tolak' => $request->alasan_tolak,
        ]);

        return view('be.permohonaninformasi.show', [
            'title' => 'Detail Permohonan Informasi',
            'data' => $data
        ]);

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
