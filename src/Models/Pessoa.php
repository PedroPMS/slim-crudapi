<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'data_nascimento',
        'nome_mae',
        'nome_pai',
        'endereco',
        'cidade',
        'uf'
    ];
}
