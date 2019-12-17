@extends('layouts.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Mata pelajaran</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/matapel/store" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode</label>
                                    <input name="kode" type="text" class="form-control" placeholder="Kode">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input name="nama" type="text" class="form-control" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Semester</label>
                                    <input name="semester" type="text" class="form-control" placeholder="Semester">
                                </div>
                                              
                            <button type="submit" class="btn btn-warning">Tambah</button>
                        </form>
                        <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Mata Pelajaran</th>
                                        <th>Semester</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($addmapel as $a)
                                    <tr>
                                        <td>{{$a->kode}}</td>
                                        <td>{{$a->nama}}</a></td>
                                        <td>{{$a->semester}}</td>
                                        <td><a class="btn btn-warning btn-sm" href="/matapel/{{$a->id}}/editmatapel">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="/matapel/{{$a->id}}/delete">Hapus</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop
