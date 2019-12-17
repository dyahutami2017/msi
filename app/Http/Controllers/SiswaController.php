<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use App\Siswa;
use Carbon\Carbon;
use Storage;
use Str;
use App\User;
use DB;
use App\Mapel;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data_siswa = \App\Siswa::where('nama_depan', 'LIKE', '%' . $request->cari . '%')->get();
            $data_siswa = \App\Siswa::where('nama_belakang', 'LIKE', '%' . $request->cari . '%')->get();
        } else {
            $data_siswa = \App\Siswa::all();
        }
        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }
    public function create(Request $request)
    {

        // \App\Siswa::create($request->all());
        $request->validate([
            'nama_depan' => ['required', 'string'],
            'nama_belakang' => ['required', 'string'],
            'jenis_kelamin' => ['required'],
            'agama' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'avatar' => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        //Insert ke table users
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt($request->nama_depan);
        $user->remember_token = Str::random(60);
        $user->save();

        //Insert ke table siswa

        $file = $request->file('avatar');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'images/';
        $file->move($tujuan_upload, $nama_file);

        $store = Siswa::create([
            'user_id' => $user->id,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'avatar' => $nama_file,

        ]);
        return redirect('/siswa')->with('sukses', 'Data Berhasil Ditambahkan');
    }
    public function edit($id)
    {
        $siswa = \App\Siswa::find($id);
        return view('siswa/edit', ['siswa' => $siswa]);
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $siswa = \App\Siswa::find($id);
        $siswa->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data Berhasil Diupdate');
    }
    public function delete($id)
    {
        // $siswa = \App\Siswa::find($id);
        // if($siswa !=null){
        //     Storage::delete('images'.'/'.$siswa->avatar);
        //     $siswa->delete($siswa);
        //     return redirect('/siswa')->with('sukses', 'Data Berhasil Dihapus');
        // }

        // return redirect('/siswa')->with('sukses', 'Data Berhasil Dihapus');
        $siswa = Siswa::where('id', $id)->firstOrFail();

        Storage::delete('images/' . $siswa->nama_file);

        Siswa::where('id', $id)->delete();
        return redirect('/siswa')->with('sukses', 'Data Berhasil Dihapus');
    }

    public function dashboard()
    {
        return view('welcome');
    }
    public function profile($id)
    {
        // dd($request->all());

        if (Auth::check() && ((Auth::user()->role == 'admin') or (Auth::user()->role == 'guru'))) {
            $siswa = \App\Siswa::where('id', $id)->first();
        } else {
            $siswa = \App\Siswa::where('user_id', $id)->first();
        }
        $matapelajaran = \App\Mapel::all();
        return view('siswa.profile', ['siswa' => $siswa, 'matapelajaran' => $matapelajaran]);
    }
    // private function imageUpload(Request $request)
    // {
    //     $uploadedFile = $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());    
    //     // $filename = strtolower(str_replace(' ', '_', $request->getClientOriginalName())).'-'.(Carbon::now()->timestamp+rand(1,1000));
    //     // $path = $uploadedFile->storeAs($location, $filename.'.'.$uploadedFile->getClientOriginalExtension());        
    //     return $filename.'.'.$uploadedFile->getClientOriginalExtension();
    //     $file = $request->file('avatar');
    //     $nama_file = time() . "_" . $file->getClientOriginalName();
    //     $tujuan_upload = 'images/';
    //     $file->move($tujuan_upload, $nama_file);
    // }
    public function addnilai(Request $request, $idsiswa)
    {
        //dd($request->all());
        $siswa = \App\Siswa::find($idsiswa);
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);
        return redirect('siswa/' . $idsiswa . '/profile')->with('sukses', 'Nilai berhasil dimasukkan');
    }

    public function addmapel(Request $request)
    {
        $addmapel = Mapel::get();
        
        return view('siswa.mapel', ['addmapel' => $addmapel]);
    }
    public function storemapel(Request $request){
        \App\Mapel::create($request->all());
        return redirect('/matapel');
    }
    public function editmapel($id){
        $addmapel = \App\Mapel::find($id);
        return view('siswa.editmatapel', ['addmapel' => $addmapel]);
    }
    public function updatemapel(Request $request,$id){
        $addmapel = \App\Mapel::find($id);
        $addmapel->update($request->all());
        return redirect('/matapel');
    }
    public function deletemapel($id){
        $addmapel = \App\Mapel::find($id);
        $addmapel->delete();
        return redirect('/matapel');
    }
}
