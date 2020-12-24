<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $konfirmasi_supervisi_id
 * @property string $sekolah_id
 * @property string $pengguna_id
 * @property string $supervisi_pengawas_id
 * @property string $keterangan
 * @property string $create_date
 * @property string $last_update
 * @property int $soft_delete
 * @property string $updater_id
 * @property string $last_sync
 */
class KonfirmasiSupervisi extends Model
{
    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'last_update';
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'konfirmasi_supervisi';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'konfirmasi_supervisi_id';

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
    protected $fillable = ['konfirmasi_supervisi_id','sekolah_id', 'pengguna_id', 'supervisi_pengawas_id', 'keterangan', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync'];

}
