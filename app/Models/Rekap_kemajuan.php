<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekap_kemajuan extends Model
{
    protected $table = 'rekap.kemajuan';
    protected $primaryKey = 'kemajuan_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    public function instrumen()
    {
        return $this->belongsTo('App\Models\Instrumen', 'instrumen_id', 'instrumen_id');
    }
}
