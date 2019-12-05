@extends('layouts.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Inputs</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/guru/{{$guru->id}}/update" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Depan </label>
                                    <input name="nama_depan" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Nama Depan" value="{{$guru->nama_depan}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Belakang</label>
                                    <input name="nama_belakang" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Nama Belakang" value="{{$guru->nama_belakang}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                                        <option value="L" @if($guru->jenis_kelamin=='L') selected @endif>Laki-laki</option>
                                        <option value="P" @if($guru->jenis_kelamin=='P') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Agama</label>
                                    <input name="agama" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Agama" value="{{$guru->agama}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$guru->alamat}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextArea1">Foto</label>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                                              
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop
