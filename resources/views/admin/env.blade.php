@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <ol class="breadcrumb">
    <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="#" class="active"><a href="#">Ambiente</a></li>
    </ol>
    <div class="page-header">
        <h1>Variáveis de ambiente 
            <br/><small>(.env)</small>
        </h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Últimos documentos enviados</h3>
                    </div>
                        <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <td>APP_DEBUG</td>
                                    <td>{{$APP_DEBUG}}</td>
                                </tr>
                                <tr>
                                    <td>APP_ENV</td>
                                    <td>{{$APP_ENV}}</td>
                                </tr>
                                <tr>
                                    <td>APP_URL</td>
                                    <td>{{$APP_URL}}</td>
                                </tr>
                                <tr>
                                    <td>ELASTIC_URL</td>
                                    <td>{{$ELASTIC_URL}}</td>
                                </tr>
                                <tr>
                                    <td>MAIL_USERNAME</td>
                                    <td>{{$MAIL_USERNAME}}</td>
                                </tr>
                                <tr>
                                    <td>MAIL_PASSWORD</td>
                                    <td>{{$MAIL_PASSWORD}}</td>
                                </tr>
                                <tr>
                                    <td>DATABASE_URL</td>
                                    <td>{{$DATABASE_URL}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@stop