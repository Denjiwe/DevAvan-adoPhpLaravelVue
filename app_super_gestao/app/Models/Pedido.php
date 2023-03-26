<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function produtos() {
        return $this->belongsToMany('App\Models\Produto', 'pedido_produtos')->withPivot('id', 'created_at', 'updated_at'); // Caso o nome das models e tabelas sejam os mesmos 
        /*return $this->belongsToMany('App\Models\Item', 'pedido_produtos', 'pedido_id', 'produto_id'); // Caso o nome das models e tabelas sejam diferentes 
            1 - Model do relacionamento NxN em relação a model que estamos implementando
            2 - É a tabela auxiliar que armazena os registros de relacionamento
            3 - Representa a FK da tabela mapeada pela model na tabela de relacionamento
            4 - Representa o nome da FK da tabela mapeada pela model utilizada no relacionamento que estamos implementando 
        */
    }
}
