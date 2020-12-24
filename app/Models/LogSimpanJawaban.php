<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $simpan_jawaban_id
 * @property string $pengguna_id
 * @property string $instrumen_id
 * @property string $tanggal_simpan
 * @property string $token
 * @property string $create_date
 * @property string $last_update
 * @property int $soft_delete
 * @property string $updater_id
 * @property string $last_sync
 * @property int $media_id
 * @property Instruman $instruman
 * @property Pengguna $pengguna
 */
class LogSimpanJawaban extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'log.simpan_jawaban';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'simpan_jawaban_id';

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
    protected $fillable = ['simpan_jawaban_id', 'pengguna_id', 'instrumen_id', 'tanggal_simpan', 'token', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync', 'media_id'];

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
