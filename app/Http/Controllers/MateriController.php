<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Materi;
use File;
use App\User;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller{
    public function upload(){
        $materi=Materi::get();
        return view('siswa.materi',['materi'=>$materi]);

    }

    // public function admin(){
    //     $gambar=Gambar::get();
    //     return view('show',['gambar'=>$gambar]);

    // }

    public function proses_upload(Request $request){
        $this ->validate($request,[ 
        'file'=>'required|mimetypes:application/pdf|max:2048',
        'keterangan'=>'required']);

        $file =$request->file('file');

        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload='data_file';
        $file->move($tujuan_upload,$nama_file);
            
        Materi::create([
            'file'=>$nama_file,
            'keterangan'=>$request->keterangan,
        ]);

        return redirect()->back();
    } 

    public function hapus($id){
        $materi=Materi::where('id',$id)->first();
        File::delete('data_file/'.$materi->file);

        Materi::where('id',$id)->delete();

        return redirect()->back()->with('alert-success','Data berhasil dihapus!');;
    }

    public function download($id){  
        //$gambar=Gambar::where('id',$id)->first();
        $materi = Materi::where('id',$id)->first();
        $file = public_path('/data_file/' .$id);//Mencari file dari model yang sudah dicari
        return response()->download($file); //Download file yang dicari berdasarkan nama file
        // File::download('data_file/'.$gambar->file);

        // Gambar::where('id',$id)->download();

        // return redirect()->route('admin');
    }
}