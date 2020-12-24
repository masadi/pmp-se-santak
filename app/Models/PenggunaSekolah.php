<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Scope\SoftDeleteScope;

/**
 * @property string $pengguna_id
 * @property int $peran_id
 * @property string $sekolah_id
 * @property string $nama
 * @property string $email
 * @property string $password
 * @property string $nik
 * @property string $nip
 * @property string $tanggal_lahir
 * @property string $nama_ibu_kandung
 * @property string $nuptk
 * @property string $bidang_studi_id
 * @property string $bidang_studi_id_str
 * @property string $pd_ptk_id
 * @property string $create_date
 * @property string $last_update
 * @property int $soft_delete
 * @property string $updater_id
 * @property string $last_sync
 * @property peran $peran
 * @property simpanJawaban[] $simpanJawabans
 * @property pengiriman[] $pengiriman
 * @property pengirimanPengguna[] $pengirimanPenggunas
 * @property login[] $logins
 * @property InfoPengguna[] $infoPenggunas
 * @property SekolahBinaan[] $sekolahBinaans
 * @property SyncLog[] $syncLogs
 * @property Jawaban[] $jawabans
 * @property KonfirmasiInstruman[] $konfirmasiInstrumens
 * @property TableSyncLog[] $tableSyncLogs
 */
// class PenggunaSekolah extends Model
class PenggunaSekolah extends Authenticatable implements JWTSubject
// class PenggunaSekolah extends Authenticatable
{
    static function pakaiRedis(){
        return 1;
    }
    
    static function pakaiDatabaseApa(){
        return 'sqlsrv';
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SoftDeleteScope);
    }
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pengguna_sekolah';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'pengguna_id';

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
    protected $fillable = ['pengguna_id','peran_id', 'sekolah_id', 'nama', 'email', 'password', 'nik', 'nip', 'tanggal_lahir', 'nama_ibu_kandung', 'nuptk', 'bidang_studi_id', 'bidang_studi_id_str', 'pd_ptk_id', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function peran()
    {
        return $this->belongsTo('App\peran', 'peran_id', 'peran_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function simpanJawabans()
    {
        return $this->hasMany('App\simpanJawaban', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengiriman()
    {
        return $this->hasMany('App\pengiriman', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengirimanPenggunas()
    {
        return $this->hasMany('App\pengirimanPengguna', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logins()
    {
        return $this->hasMany('App\login', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tmpSyncLogs()
    {
        return $this->hasMany('App\TmpSyncLog', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function infoPenggunas()
    {
        return $this->hasMany('App\InfoPengguna', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sekolahBinaans()
    {
        return $this->hasMany('App\SekolahBinaan', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tmpTableSyncLogs()
    {
        return $this->hasMany('App\TmpTableSyncLog', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function syncLogs()
    {
        return $this->hasMany('App\SyncLog', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jawabans()
    {
        return $this->hasMany('App\Jawaban', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function konfirmasiInstrumens()
    {
        return $this->hasMany('App\KonfirmasiInstruman', null, 'pengguna_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tableSyncLogs()
    {
        return $this->hasMany('App\TableSyncLog', null, 'pengguna_id');
    }
}
