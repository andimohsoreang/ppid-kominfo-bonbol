<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

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
            "title" => "Informasi Publik",
            "informasis" => InformasiPublik::orderBy('created_at','desc')->get()
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
        
        

        $create = InformasiPublik::create([
            'user_id' => Auth::user()->id,
            'klasifikasi' => $request->klasifikasi,
            'judul'=> $request->judul,
            'ringkasan'=> $request->ringkasan,
            'file'=> 'uploads/infopub/'.$newfile,
            'filesize' => $ukuranfile
        ]);

        $file->move('uploads/infopub/',$newfile);

        if($create){
            Alert::success('Success','Informasi Berhasil di Upload');
            return redirect()->route('petugas.informasipublik');
        } else {
            Alert::error('Failed', 'Informasi Gagal di Upload');
            return redirect()->route('petugas.informasipublik');
            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InformasiPublik  $informasiPublik
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = InformasiPublik::findorfail($id);
        // return dd($data);

        return view('be.informasipublik.view',[
            "title" => "Informasi Publik",
            "data" => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InformasiPublik  $informasiPublik
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = InformasiPublik::findorfail($id);

        return view('be.informasipublik.edit', [
            "title" => "Ubah Data Informasi Publik",
            "data" => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InformasiPublik  $informasiPublik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'klasifikasi' => ['required'],
            'judul'=>['required'],
            'ringkasan'=>['required'],
            
        ]);

        $data = InformasiPublik::findorfail($id);
        
                
        if($request->has('file')){
            if(File::exists($request->filelama)){
                File::delete($request->filelama);
            }
            
            $file =  $request->file;
            $newfile = time().$file->getClientOriginalName();
            $ukuranfile = $file->getSize();

            $file->move('uploads/infopub/',$newfile);

            
            $data_array = [
                'klasifikasi'=> $request->klasifikasi,
                'judul'=>$request->judul,
                'ringkasan'=>$request->ringkasan,
                'file'=> 'uploads/infopub/'.$newfile,
                'filesize' => $ukuranfile
            ];
        } else {
            $data_array = [
                'klasifikasi'=> $request->klasifikasi,
                'judul'=>$request->judul,
                'ringkasan'=>$request->ringkasan,
                
            ];
            }

            $data->update($data_array);

            if($data){
                Alert::success('Sukses','Informasi Berhasil di Update');
                return redirect()->route('petugas.informasipublik');
            } else {
                Alert::error('Gagal', 'Informasi Gagal di Update');
                return redirect()->route('petugas.informasipublik');
                
            }

            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InformasiPublik  $informasiPublik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = InformasiPublik::findorfail($id);
        $file = $data->file;
        if(File::exists($file)){
            File::delete($file);
        }

        $data = InformasiPublik::where('id',$data->id)->delete();

        if($data){
            Alert::success('Success','Informasi Berhasil di Hapus');
            return redirect()->route('petugas.informasipublik');
        } else {
            Alert::error('Failed', 'Informasi Gagal di Hapus');
            return redirect()->route('petugas.informasipublik');
        }
    }
}
