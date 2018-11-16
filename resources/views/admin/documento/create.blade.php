@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
   
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="../home">Painel</a></li>
        <li> <a href="#" ><a href="#">Documentos</a></li>
        <li> <a href="#" class="active"><a href="#">Publicar</a></li>
    </ol>


    <div class="container">
    
    @include('admin.includes.alerts')
    
    <form name="form" id="form" action="{{route('enviar')}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="unidade">Orgão</label>
                        <input type="text" class="form-control" readonly 
                            value="{{ $unidade->nome }} - {{ $unidade->sigla }}" id="unidade">
                        
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="ano">Ano*</label>
                            <input type="text" required class="form-control" id="ano" name="ano" placeholder="Ex.: 2019" maxlength="4">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="numero">Número*</label>
                            <input type="text" required class="form-control" id="numero" name="numero"  
                            placeholder="Ex.: CEE/BR Nº 12.123" maxlength="20">
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="data_publicacao">Data Publicação*</label>
                            <div class='input-group date'>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar">
                                    </span>
                                </span>
                                <input type='date' required class="form-control" id="data_publicacao" name="data_publicacao"/>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="tipo_documento">Tipo Documento*</label>
                            <select class="form-control" required id="tipo_documento_id" name="tipo_documento_id">
                                <option>Selecione</option>
                                @foreach ($tiposDocumento as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
        
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="assunto">Abrangência*</label>
                            <select class="form-control" required id="assunto_id" name="assunto_id">
                                <option>Selecione</option>
                                @foreach ($assuntos as $assunto)
                                    <option value="{{$assunto->id}}">{{$assunto->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div><!--end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="titulo">Título*</label>
                            <input type="text" required class="form-control" id="titulo" name="titulo" placeholder="Ex.: Deliberação CEEBR Nº 12321...">
                        </div>
                    </div>
                </div><!--end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="ementa">Ementa*</label>
                            <textarea id="ementa" required class="form-control" rows="5" name="ementa"></textarea>
                            <small class=".text-muted">Máximo de 255 caracteres</small>
                        </div>
                        
                    </div>
                </div><!--end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="palavras_chave">Palavras chave</label>
                            <small class=".text-muted">(Insira os termos mais relevantes abordados neste documento)</small>
                            <input type="text"  required data-role="tagsinput" id="palavras_chave" name="palavras_chave"/>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="url">URL</label>
                            <small class=".text-muted">(Endereço online - opcional)</small>
                            <div class='input-group'>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-globe">
                                    </span>
                                </span>
                                <input type='url' class="form-control" id="url" name="url" placeholder="HTTP://..." maxlength="200"/>
                            </div>
                        </div>
                    </div>
                </div><!--end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="arquivo">Arquivo(PDF)*</label>
                            <small class=".text-muted">(Tamanho máximo 5MB)</small>
                            <input id="arquivo" required name="arquivo" class="form-control" type="file"></textarea>
                            <small class=".text-muted">Arquivos escaneados não são indexados para busca.</small>
                        </div>
                    </div>
                </div><!--end row -->
            
            </div> <!-- end div-col-container -->
        </div><!-- end row-col_container-->
        <button type="submit" class="btn btn-primary btn-lg" value="Enviar" onclick="this.form.submit();">Enviar</button>

    </form>
    </div> <!--end container ALL 4332-->
@stop