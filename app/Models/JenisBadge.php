<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $jenis_badge_id
 * @property string $nama
 * @property string $keterangan
 * @property string $create_date
 * @property string $last_update
 * @property string $expired_date
 * @property string $updater_id
 * @property string $last_sync
 */
class JenisBadge extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ref.jenis_badge';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'jenis_badge_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['nama', 'keterangan', 'create_date', 'last_update', 'expired_date', 'updater_id', 'last_sync'];

}
