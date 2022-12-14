<?php

namespace App\Http\Controllers;

use App\Models\KontakKami;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KontakKamiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kontakkamis = KontakKami::orderBy('created_at', 'desc')->get();
        return view('be.kotakpesan',[
            'title' => 'Kotak Pesan',
            'datas' => $kontakkamis
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
     * @param  \App\Models\KontakKami  $kontakKami
     * @return \Illuminate\Http\Response
     */
    public function show(KontakKami $kontakKami)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KontakKami  $kontakKami
     * @return \Illuminate\Http\Response
     */
    public function edit(KontakKami $kontakKami)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KontakKami  $kontakKami
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KontakKami $kontakKami)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KontakKami  $kontakKami
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kontakkami = KontakKami::where('id', $id);
        $kontakkami->delete();

        Alert::success('Berhasil', 'Pesan ini berhasil di hapus');
        return redirect()->route('admin.kotakpesan');
    }
}
