<?php

namespace App\Http\Controllers;

use App\Models\ProfilKantor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilKantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profilkantor = ProfilKantor::first();
        return view('be.profilkantor',[
            'title' => 'Profil Kantor',
            'data' => $profilkantor
        ]);
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
     * @param  \App\Models\ProfilKantor  $profilKantor
     * @return \Illuminate\Http\Response
     */
    public function show(ProfilKantor $profilKantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfilKantor  $profilKantor
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
     * @param  \App\Models\ProfilKantor  $profilKantor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tentang' => ['required'],
            'alamat' => ['required'],
            'telepon' => ['required'],
            'email' => ['required', 'email'],
            'fb' => ['required'],
            'tw' => ['required'],
            'ig' => ['required']
        ]);

        $profilkantor = ProfilKantor::findorfail($id);
        $profilkantor->update([
            'tentang' => $request->tentang,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'fb' => $request->fb,
            'tw' => $request->tw,
            'ig' => $request->ig
        ]);

        if ($profilkantor) {
            Alert::success('Berhasil', 'Profil berhasil diperbarui!');
            return redirect()->route('admin.profilkantor');
        } else {
            Alert::error('Gagal', 'Profil gagal diperbarui!');
            return redirect()->route('admin.profilkantor');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfilKantor  $profilKantor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfilKantor $profilKantor)
    {
        //
    }
}
