<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Documento extends Model
{

    protected $fillable = [
        'ano', 'titulo','numero','ementa','url','data_publicacao','tipo_documento_id',
        'assunto_id','unidade_id'   ];


    public function palavrasChaves(){
        return $this->hasMany(PalavraChave::class);
    }

    public function assunto()
    {
        return $this->belongsTo(Assunto::class);
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $rules = [
        'numero'    =>  'required|unique:documentos|max:20',
        'titulo'    =>  'required|max:255',
        'ano'       =>  'required|integer|min:4',
        'data_publicacao'   => 'required|date',
        'tipo_documento_id' => 'required|integer',
        'assunto_id' => 'required|integer',
        'ementa'    => 'required',
        'arquivo' => 'required|mimes:pdf',
        'url'   => 'nullable|active_url|max:200'
    ];

    public $messages = [
        'required' => 'O campo :attribute é requerido',
        'numero.max' => 'O campo :attribute deve ter no máximo 20 caracteres',
        'url.max' => 'O campo :attribute deve ter no máximo 200 caracteres',
        'ano.min' => 'O campo :attribute deve ter no mínimo 4 caracteres',
        'titulo.max'  => 'O campo :attribute deve ter no máximo 255 caracteres',
        'numero.unique'   => 'O número deve ser único entre os orgão. Dica: Use junto com a sigla do seu orgão',
        'integer' => 'O campo :attribute deve inteiro',
        'arquivo.mimes'   => 'O documento anexado tem que estar no formato PDF',
        'active_url' => 'A url deve ter um formato válido. Ex.: http://www.seuorgao.com/arquivos/resolucao123'
    ];


    public function toElasticObject(){

        $tags = [];
        foreach($this->palavrasChaves as $tag){
            $tags[] = $tag->tag;
        }

        $object = [
            "ato" => [
                "id_persisted" => $this->id,
                "ano" => $this->ano,
                "titulo" => $this->titulo,
                "ementa" => $this->ementa,
                "url"   =>  $this->url,
                "data_publicacao"   =>  $this->data_publicacao,
                "data_envio"   =>  $this->data_envio,
                "tipo_doc" => $this->tipoDocumento->nome,
                "arquivo"   =>  $this->arquivo,
                "tags"  =>  $tags,
                "fonte"   =>  [
                    "orgao"  => $this->unidade->nome,
                    "sigla" => $this->unidade->sigla,
                    "uf" => '',
                    "uf_sigla" => '',
                    "esfera" => $this->unidade->esfera,
                    "url" => $this->unidade->url
                ]
            ]
        ];


        return collect($object);
    }

    function urlizer($str) {

        $str = strtolower($str);
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        $str = preg_replace('/[^a-z0-9]/i', '-', $str);
        $str = preg_replace("/[^a-z0-9_\s-]/", "", $str);
        $str = preg_replace('/_+/', '-', $str);
        $str = preg_replace("/[\s-]+/", " ", $str);
        $str = str_replace('.','-',$str);
        $str = str_replace(' ','-',$str);
        $str = str_replace('/','_',$str);
        $str = trim($str,"-");
        return strtolower($str);
    }
}
