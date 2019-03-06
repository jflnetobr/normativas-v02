@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="#" class="active">Assuntos Removidos</a></li>
    </ol>
    <div class="page-header">
        <a href="{{route('assuntos-create')}}" class="btn btn-primary btn-lg">Novo Assunto</a>
    </div>
    <div class="container">
        @include('admin.includes.alerts')
        <div class="row">
            @forelse ($assuntos as $assunto)
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <span class="lead">{{$assunto->nome}}</span>

                            <div class="pull-right">
                                <a href="{{route('assunto-edit',$assunto->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{$assunto->descricao}}
                        </div>
                        <div class="panel-footer">
                            Assunto desabilitado em {{date('d/m/Y H:i:s', strtotime($assunto->deleted_at))}}        
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">
                    Nenhum assunto utilizado anteriormente foi desabilitado.
                </div>
            @endforelse
        </div>
    </div>
@stop