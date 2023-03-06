<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\field;


class Table extends Model
{
    protected $table = 'tableslist';
    public function fields()
    {
        return $this->hasMany(field::class);
    }
    use HasFactory;
}
