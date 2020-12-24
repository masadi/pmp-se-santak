<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $feedback_id
 * @property string $pengguna_id
 * @property string $tanggal
 * @property int $media_id
 * @property int $jenis_feedback_id
 * @property string $judul
 * @property string $keterangan
 * @property string $saran
 * @property string $create_date
 * @property string $last_update
 * @property int $soft_delete
 * @property string $updater_id
 * @property string $last_sync
 */
class Feedback extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'feedback_id';

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
    protected $fillable = ['feedback_id', 'pengguna_id', 'tanggal', 'media_id', 'jenis_feedback_id', 'judul', 'keterangan', 'saran', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync'];

}
