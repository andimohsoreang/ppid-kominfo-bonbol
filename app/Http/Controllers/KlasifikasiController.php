<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $klasifikasis = Klasifikasi::orderBy('created_at', 'desc')->get();
        return view('be.klasifikasi.home', [
            'title' => 'Klasifkasi',
            'klasifikasis' => $klasifikasis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('be.klasifikasi.create',[
            'title' => 'Tambah Klasifikasi'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['klasifikasi' => ['required']]);

        $klasifikasi = new Klasifikasi([
            'klasifikasi' => $request->klasifikasi
        ]);
        $klasifikasi->save();

        if($klasifikasi){
            Alert::success('Berhasil','Klasifikasi berhasil di tambahkan');
            return redirect()->route('admin.klasifikasi');
        } else {
            Alert::error('Gagal','Klasifikasi gagal di tambahkan');
            return redirect()->route('admin.klasifikasi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Klasifikasi $klasifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $klasifikasi = Klasifikasi::findorfail($id);
        return view('be.klasifikasi.edit', [
            'title' => 'Edit Klasifikasi',
            'data' => $klasifikasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['klasifikasi' => ['required']]);

        $klasifikasi = Klasifikasi::findorfail($id);

        $data_klasifikasi = [
            'klasifikasi' => $request->klasifikasi
        ];

        $klasifikasi->update($data_klasifikasi);

        if($klasifikasi){
            Alert::success('Berhasil','Klasifikasi berhasil di perbarui');
            return redirect()->route('admin.klasifikasi');
        } else {
            Alert::error('Gagal','Klasifikasi gagal di perbarui');
            return redirect()->route('admin.klasifikasi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $klasifikasi_data = Klasifikasi::findorfail($id);
        $klasifikasi = Klasifikasi::where('id', $klasifikasi_data->id)->delete();

        if($klasifikasi){
            Alert::success('Berhasil','Klasifikasi berhasil di hapus');
            return redirect()->route('admin.klasifikasi');
        } else {
            Alert::error('Gagal','Klasifikasi gagal di hapus');
            return redirect()->route('admin.klasifikasi');
        }
    }
}
