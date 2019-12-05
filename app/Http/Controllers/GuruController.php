<?php

namespace App\Http\Controllers;

use App\Guru;
use Illuminate\Http\Request;
use App\User;
use App\Siswa;
use Carbon\Carbon;
use Storage;
use Str;
use DB;
use Illuminate\Support\Facades\Auth;
class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data_guru = \App\Guru::where('nama_depan', 'LIKE', '%' . $request->cari . '%')->get();
            $data_guru = \App\Guru::where('nama_belakang', 'LIKE', '%' . $request->cari . '%')->get();
        } else {
            $data_guru = \App\Guru::all();
        }
        return view('guru.index', ['data_guru' => $data_guru]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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
        $user->role = 'guru';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt($request->nama_depan);
        $user->remember_token = Str::random(60);
        $user->save();

        //Insert ke table siswa

        $file = $request->file('avatar');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'imagesGuru/';
        $file->move($tujuan_upload, $nama_file);

        $store = Guru::create([
            'user_id' => $user->id,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'avatar' => $nama_file,

        ]);
        return redirect('/guru')->with('sukses', 'Data Berhasil Ditambahkan');
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
        $guru = \App\Guru::find($id);
        return view('guru/edit', ['guru' => $guru]);
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
        $guru = \App\Guru::find($id);
        $guru->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('imagesGuru/', $request->file('avatar')->getClientOriginalName());
            $guru->avatar = $request->file('avatar')->getClientOriginalName();
            $guru->save();
        }
        return redirect('/guru')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::where('id', $id)->firstOrFail();

        Storage::delete('imagesGuru/' . $guru->nama_file);

        Guru::where('id', $id)->delete();
        return redirect('/guru')->with('sukses', 'Data Berhasil Dihapus');
    }
}
