<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;
use Mail;

class Convite extends Model
{

    protected $fillable = [
        'contato', 'telefone', 'email','destinatario','mensagem'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function enviarNovoUsuario($userNovo,$passwordGerado){
        $to_name = $userNovo->name;
        $to_email = 'thiagok2@gmail.com';
        //$to_email = $userNovo->email;
        $data = array(
            'name'      =>  $userNovo->name, 
            "password"  =>  $passwordGerado,
            "unidade"   =>  $userNovo->unidade->nome,
            "tipo"      =>  $userNovo->tipo);
    
        Mail::send('emails.acesso', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Acesso a plataforma Normativas');
                $message->from('normativas@nees.com.br','Normativas - NEES');
        });
    }


}
