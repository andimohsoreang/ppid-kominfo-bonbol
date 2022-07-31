<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformasiPublikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('be.informasipublik', [
            "title" => "Informasi Publik"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('be.informasipublik.create', [
            "title" => "Informasi Publik"
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
     
        $request->validate([
            'klasifikasi' => ['required'],
            'judul'=>['required'],
            'ringkasan'=>['required'],
            'file'=>['required']
        ]);

        $file =  $request->file;
        $newfile = time().$file->getClientOriginalName();
        $ukuranfile = $file->getSize();
        
        

        InformasiPublik::create([
            'user_id' => Auth::user()->id,
            'klasifikasi' => $request->klasifikasi,
            'judul'=> $request->judul,
            'ringkasan'=> $request->ringkasan,
            'file'=> 'uploads/infopub/'.$newfile,
            'filesize' => $ukuranfile
        ]);

        $file->move('uploads/infopub/',$newfile);

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InformasiPublik  $informasiPublik
     * @return \Illuminate\Http\Response
     */
    public function show(InformasiPublik $informasiPublik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InformasiPublik  $informasiPublik
     * @return \Illuminate\Http\Response
     */
    public function edit(InformasiPublik $informasiPublik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InformasiPublik  $informasiPublik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InformasiPublik $informasiPublik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InformasiPublik  $informasiPublik
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformasiPublik $informasiPublik)
    {
        //
    }
}
