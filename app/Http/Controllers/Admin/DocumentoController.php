<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\Models\Assunto;
use App\Models\Documento;
use App\Models\PalavraChave;
use Illuminate\Support\Facades\DB;

class DocumentoController extends Controller
{
    public function index(){

        $documentos = Documento::with('tipoDocumento','user')->simplePaginate(20);

        return view('admin.documento.index', compact('documentos'));
    }

    public function create(){

        $unidade = auth()->user()->unidade;

        $tiposDocumento = TipoDocumento::all();
        $assuntos = Assunto::all();  

        return view('admin.documento.create', compact('unidade','tiposDocumento',  'assuntos'));
    }

    public function store(Request $request, Documento $documento){

        $data= $request->all();
        $documento = new Documento();
        $documento->fill($data);

        $documento->unidade()->associate(auth()->user()->unidade);
        $documento->user()->associate(auth()->user()->id);

        if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {

            DB::beginTransaction();

            $tituloArquivo = str_replace(" ","",strtolower(preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($documento->numero)))));
            $tituloArquivo = $tituloArquivo."_".uniqid(date('HisYmd'));

            $extensao = $request->arquivo->extension();

            $arquivoNome = "{$tituloArquivo}.{$extensao}";

            $upload = $request->arquivo->storeAs('uploads', $arquivoNome);

            $documento->arquivo = $arquivoNome;

            $documento->save();

            $tags = explode(",", $data["palavras_chave"]);
            if(is_array($tags) && count($tags)>0){
                foreach ($tags as $t) {
                    $palavra = new PalavraChave();
                    $palavra->tag = $t;

                    $palavra->documento()->associate($documento);
                    $documento->palavrasChaves()->save($palavra);
                }
            }

            DB::commit();

        }

        

        return redirect()->route('documentos');
    }
}
