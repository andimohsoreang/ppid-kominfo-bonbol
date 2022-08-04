<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use Illuminate\Http\Request;

class InformasiPublikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = InformasiPublik::orderBy('created_at', 'desc')->get();
        // dd($datas);
        return view('infopub', [
            'title' => 'Informasi Publik',
            'datas' => $datas
        ]);
    }

    public function download($id)
    {
        $data = InformasiPublik::findorfail($id);
        $mypath = public_path().'/'.$data->file;
        // dd($mypath);

        $encrypt_name = time().$data->judul;
        return response()->download($mypath, $encrypt_name);
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
