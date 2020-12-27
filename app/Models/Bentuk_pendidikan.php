<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bentuk_pendidikan extends Model
{
    protected $table = 'ref.bentuk_pendidikan';
    protected $primaryKey = 'bentuk_pendidikan_id';
    //protected $fillable = ['jawaban_id', 'pengguna_id', 'instrumen_id', 'sekolah_id', 'isian', 'nilai', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync'];
}
