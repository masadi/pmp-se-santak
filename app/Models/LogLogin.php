<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $login_id
 * @property string $pengguna_id
 * @property string $tanggal
 * @property string $jenis_login
 * @property string $token
 * @property string $create_date
 * @property string $last_update
 * @property int $soft_delete
 * @property string $updater_id
 * @property string $last_sync
 * @property int $media_id
 * @property Pengguna $pengguna
 */
class LogLogin extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'log.login';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'login_id';

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
    protected $fillable = ['login_id', 'pengguna_id', 'tanggal', 'jenis_login', 'token', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync', 'media_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengguna()
    {
        return $this->belongsTo('App\Pengguna', null, 'pengguna_id');
    }
}
