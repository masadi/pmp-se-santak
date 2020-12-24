<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $primaryKey = 'jawaban_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['jawaban_id', 'pengguna_id', 'instrumen_id', 'sekolah_id', 'isian', 'nilai', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync'];
}
