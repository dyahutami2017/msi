@extends('layouts.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Materi</h3>
                            <div class="row">
                                <div class="container">
                                </br>

                                    <div class="col-lg-8 mx-auto my-5">

                                        @if(count($errors) > 0)
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                            {{ $error }} <br />
                                            @endforeach
                                        </div>
                                        @endif

                                        @if((auth()->user()->role == 'guru') or (auth()->user()->role =='admin'))
                                        <form action="/upload/proses" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <b>File Materi</b><br />
                                                <input type="file" name="file">
                                            </div>

                                            <div class="form-group">
                                                <b>Keterangan</b>
                                                <textarea class="form-control" name="keterangan"></textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="submit" value="Upload" class="btn btn-primary">
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <a href="" class="btn btn-primary">Kembali</a>
                                                </div>
                                            </div>
                                        </form>
                                        @endif
                                        </br>
                                        
                                        <table class="table table-bordered table-striped mt-5">
                                            <thead>
                                                <tr>
                                                    <!-- <th width="1%">File</th> -->
                                                    <th>Keterangan</th>
                                                    <th width="1%">OPSI</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($materi as $m)
                                                <tr>
                                                    
                                                    <td>{{$m->keterangan}}</td>
                                                    <td>
                                                    @if((auth()->user()->role == 'admin') or (auth()->user()->role == 'guru'))
                                                        <a class="btn btn-danger" href="/upload/hapus/{{ $m->id }}">HAPUS</a>
                                                    @endif
                                                    <a class="btn btn-primary" href="/upload/download/{{ $m->file}}">Download</a></td>
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
        </div>
    </div>
</div>
@stop