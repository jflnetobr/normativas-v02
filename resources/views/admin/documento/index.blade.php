@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')

    <div class="row">
        <div class="col-sm-12 mb-2">
            <a href="{{route('publicar')}}" class="btn btn-primary btn-lg">Publicar Novo</a>
        </div>
    </div>
    <br/>
    <ol class="breadcrumb">
        <li><a href="../home">Painel</a></li>
        <li> <a href="#" class="active"><a href="#">Documentos</a></li>
    </ol>
    
    @include('admin.includes.alerts')

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Últimos documentos enviados</h3>
                </div>
                    <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 2%">Ano</th>
                                <th style="width: 8%">Número</th>
                                <th style="width: 6%">Tipo</th>
                                <th style="width: 20%">Título</th>
                                <th style="width: 6%">Publicação</th>
                                <th style="width: 6%">Envio</th>
                                <th style="width: 4%">Por</th>
                                <th style="width: 2%"></th>
                            </tr>
                        <thead>  
                        <tbody>
                            
                                @forelse ($documentos as $doc)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$doc->ano}}</td>
                                    <td>{{$doc->numero}}</td>
                                    <td>{{$doc->tipoDocumento->nome}}</td>
                                    <td>{{$doc->titulo}}</td>
                                    <td>{{date('d-m-Y', strtotime($doc->data_publicacao))}}</td>
                                    <td>{{date('d-m-Y', strtotime($doc->data_envio))}}</td>
                                    <td>{{$doc->user->firstName()}}</td>
                                    <td>
                                        <a href="{{ url("storage/uploads/{$doc->arquivo}") }}" target="_blank">
                                            <i class="fa fa-arrow-circle-down"></i>
                                        </a>
                                        <a href="{{ url("documento/{$doc->id}") }}">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-cloud-upload"></i>
                                        </a>

                                       
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">
                                            <span class="no-results">Sem documentos enviados</span>
                                        </td>
                                    </tr>
                                @endforelse

                        </tbody>
                    </table>
                </div><!-- /.box-body --> 
                <div class="box-footer">
                    {{ $documentos->links() }}
                </div>
            </div>
        </div>
    </div>
    
@stop