<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasInformasiPublikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            return view('be.informasipublik.home', [
                "title" => "Informasi Publik",
                "informasis" => InformasiPublik::orderBy('created_at','desc')->get(),
            ]);
        } else {
            return view('be.informasipublik.home', [
                "title" => "Informasi Publik",
                "informasis" => InformasiPublik::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get(),
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
        return view('be.informasipublik.create', [
            "title" => "Informasi Publik",
            "klasifikasis" => Klasifikasi::get()
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
            'klasifikasi_id' => ['required'],
            'judul'=>['required'],
            'ringkasan'=>['required'],
            'file'=>['required']
        ]);

        $file =  $request->file;
        $newfile = time().$file->getClientOriginalName();
        $ukuranfile = $file->getSize();
        // $filesize = convertUploadedFileToHumanReadable($ukuranfile);

        $create = InformasiPublik::create([
            'user_id' => Auth::user()->id,
            'klasifikasi_id' => $request->klasifikasi_id,
            'judul'=> $request->judul,
            'ringkasan'=> $request->ringkasan,
            'file'=> 'uploads/infopub/'.$newfile,
            'filesize' => $ukuranfile
        ]);

        $file->move('uploads/infopub/',$newfile);

        if($create){
            Alert::success('Success','Informasi Berhasil di Upload');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.informasipublik');
            } else {
                return redirect()->route('petugas.informasipublik');
            }
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
        if (Auth::user()->hasRole('admin')) {
            return view('be.informasipublik.view',[
                "title" => "Informasi Publik",
                "data" => $data
            ]);
        } else {
            if ($data->user_id == Auth::user()->id) {
                return view('be.informasipublik.view',[
                    "title" => "Informasi Publik",
                    "data" => $data
                ]);
            } else {
                Alert::error('Maaf','Anda tidak mempunyai akses ke halaman ini.');
                    return redirect()->route('petugas.informasipublik');
            }
        }
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
        if (Auth::user()->hasRole('admin')) {
            return view('be.informasipublik.edit', [
                "title" => "Ubah Data Informasi Publik",
                "data" => $data,
                "klasifikasis" => Klasifikasi::get()
            ]);
        } else {
            if ($data->user_id == Auth::user()->id) {
                return view('be.informasipublik.edit', [
                    "title" => "Ubah Data Informasi Publik",
                    "data" => $data,
                    "klasifikasis" => Klasifikasi::get()
                ]);
            } else {
                Alert::error('Maaf','Anda tidak mempunyai akses ke halaman ini.');
                return redirect()->route('petugas.informasipublik');
            }
        }
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
            'klasifikasi_id' => ['required'],
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
            // $filesize = convertUploadedFileToHumanReadable($ukuranfile);

            $file->move('uploads/infopub/',$newfile);

            
            $data_array = [
                'klasifikasi_id'=> $request->klasifikasi_id,
                'judul'=>$request->judul,
                'ringkasan'=>$request->ringkasan,
                'file'=> 'uploads/infopub/'.$newfile,
                'filesize' => $ukuranfile
            ];
        } else {
            $data_array = [
                'klasifikasi_id'=> $request->klasifikasi_id,
                'judul'=>$request->judul,
                'ringkasan'=>$request->ringkasan,
                
            ];
        }

        $data->update($data_array);

        if($data){
            Alert::success('Sukses','Informasi Berhasil di Update');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.informasipublik');
            } else {
                return redirect()->route('petugas.informasipublik');
            }
        } else {
            Alert::error('Gagal', 'Informasi Gagal di Update');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.informasipublik');
            } else {
                return redirect()->route('petugas.informasipublik');
            }
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
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.informasipublik');
            } else {
                return redirect()->route('petugas.informasipublik');
            }
        } else {
            Alert::error('Failed', 'Informasi Gagal di Hapus');
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.informasipublik');
            } else {
                return redirect()->route('petugas.informasipublik');
            }
        }
    }

    // public function convertUploadedFileToHumanReadable($size, $precision = 2)
    // {
    //     if ( $size > 0 ) {
    //         $size = (int) $size;
    //         $base = log($size) / log(1024);
    //         $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
    //         return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    //     }

    //     return $size;
    // }
}
