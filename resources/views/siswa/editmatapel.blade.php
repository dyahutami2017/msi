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
                            <form action="/matapel/{{$addmapel->id}}/update" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode</label>
                                    <input name="kode" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Kode" value="{{$addmapel->kode}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Pelajaran</label>
                                    <input name="nama_pelajaran" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Nama Pelajaran" value="{{$addmapel->nama}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Semester</label>
                                    <input name="semester" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Semester" value="{{$addmapel->semester}}">
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
