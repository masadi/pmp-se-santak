<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $konfirmasi_instrumen_id
 * @property string $pengguna_id
 * @property string $instrumen_id
 * @property string $sekolah_id
 * @property int $konfirmasi
 * @property string $create_date
 * @property string $last_update
 * @property int $soft_delete
 * @property string $updater_id
 * @property string $last_sync
 * @property Instruman $instruman
 * @property Pengguna $pengguna
 */
class KonfirmasiInstrumen extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'konfirmasi_instrumen';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'konfirmasi_instrumen_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['konfirmasi_instrumen_id', 'pengguna_id', 'instrumen_id', 'sekolah_id', 'konfirmasi', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instruman()
    {
        return $this->belongsTo('App\Instruman', 'instrumen_id', 'instrumen_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengguna()
    {
        return $this->belongsTo('App\Pengguna', null, 'pengguna_id');
    }
}
