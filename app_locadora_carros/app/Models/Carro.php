<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = ['modelo_id', 'placa', 'disponivel', 'km'];

    public function modelo() {
        return $this->belongsTo('App\Models\Modelo');
    }

    public function locacoes() {
        return $this->hasMany('App\Models\Locacao');
    }

    public function rules() {
        return [
            'modelo_id' => 'required|integer',
            'placa' => 'required|unique:carros',
            'disponivel' => 'required|boolean',
            'km' => 'required|integer'
        ];
    }
}
