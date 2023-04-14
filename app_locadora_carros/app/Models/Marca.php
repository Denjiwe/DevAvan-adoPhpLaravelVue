<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'imagem'];

    public function rules() {
        return [
            'nome' => 'required|unique:marcas,nome,'.$this->id.'|min:3',
            'imagem' => 'required|file|mimes:png,jpeg,jpg'
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome infomado já foi inserido',
            'nome.min' => 'O nome deve possuir no mínimo 3 caracteres',
            'imagem.file' => 'A imagem deve ser um arquivo',
            'imagem.mimes' => 'O arquivo deve ser do tipo PNG, JPEG ou JPG'
        ];
    } 

    public function modelos() {
        return $this->hasMany('App\Models\Modelo');
    }
}
