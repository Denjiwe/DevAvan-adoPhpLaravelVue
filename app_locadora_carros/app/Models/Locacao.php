<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    use HasFactory;
    
    protected $table = 'locacoes';

    protected $fillable = [
        'cliente_id', 
        'carro_id', 
        'data_inicio_periodo', 
        'data_final_previsto_periodo', 
        'data_final_realizado_periodo',
        'km_inicial',
        'km_final'
    ];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente');
    }
    
    public function carro() {
        return $this->belongsTo('App\Models\Carro');
    }

    public function rules() {
        return [
            'cliente_id' => 'required|integer',
            'carro_id' => 'required|integer',
            'data_inicio_periodo' => 'required|date',
            'data_final_previsto_periodo' => 'required|date',
            'data_final_realizado_periodo' => 'required|date',
            'km_inicial' => 'required|integer',
            'km_final' => 'required|integer'
        ];
    }
}
