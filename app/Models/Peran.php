<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $peran_id
 * @property string $nama
 * @property string $create_date
 * @property string $last_update
 * @property string $expired_date
 * @property string $updater_id
 * @property string $last_sync
 * @property Pengguna[] $penggunas
 */
class Peran extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ref.peran';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'peran_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['nama', 'create_date', 'last_update', 'expired_date', 'updater_id', 'last_sync'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penggunas()
    {
        return $this->hasMany('App\Pengguna', 'peran_id', 'peran_id');
    }
}
