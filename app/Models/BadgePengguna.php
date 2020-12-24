<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property string $badge_pengguna_id
 * @property string $pengguna_id
 * @property string $instrumen_id
 * @property string $tanggal_dapat
 * @property int $tingkat
 * @property string $create_date
 * @property string $last_update
 * @property int $soft_delete
 * @property string $updater_id
 * @property string $last_sync
 */
class BadgePengguna extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'badge_pengguna';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'badge_pengguna_id';

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
    protected $fillable = ['pengguna_id', 'instrumen_id', 'tanggal_dapat', 'tingkat', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync'];

}
