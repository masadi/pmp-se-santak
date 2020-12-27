<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $sekolah_id
 * @property string $nama
 * @property string $nama_nomenklatur
 * @property string $npsn
 * @property int $bentuk_pendidikan_id
 * @property int $status_sekolah
 * @property string $alamat_jalan
 * @property string $rt
 * @property string $rw
 * @property string $nama_dusin
 * @property string $desa_kelurahan
 * @property string $kode_wilayah
 * @property string $kode_pos
 * @property string $lintang
 * @property string $bujur
 * @property string $nomor_telepon
 * @property string $nomor_fax
 * @property string $email
 * @property string $website
 * @property string $kebutuhan_khusus_id
 * @property string $sk_pendirian_sekolah
 * @property string $tanggal_sk_pendirian
 * @property int $status_kepemilikan_id
 * @property string $yayasan_id
 * @property string $sk_izin_operasional
 * @property string $tanggal_sk_izin_operasional
 * @property string $no_rekening
 * @property string $nama_bank
 * @property string $cabang_kcp_unit
 * @property string $rekening_atas_nama
 * @property int $mbs
 * @property float $luas_tanah_milik
 * @property float $luas_tanah_bukan_milik
 * @property string $kode_registrasi
 * @property string $npwp
 * @property string $nm_wp
 * @property int $flag
 * @property string $create_date
 * @property string $last_update
 * @property int $soft_delete
 * @property string $updater_id
 * @property string $last_sync
 * @property SekolahBinaan[] $sekolahBinaans
 * @property Instalasi[] $instalasis
 */
class Sekolah extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sekolah';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'sekolah_id';

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
    protected $fillable = ['nama', 'nama_nomenklatur', 'npsn', 'bentuk_pendidikan_id', 'status_sekolah', 'alamat_jalan', 'rt', 'rw', 'nama_dusin', 'desa_kelurahan', 'kode_wilayah', 'kode_pos', 'lintang', 'bujur', 'nomor_telepon', 'nomor_fax', 'email', 'website', 'kebutuhan_khusus_id', 'sk_pendirian_sekolah', 'tanggal_sk_pendirian', 'status_kepemilikan_id', 'yayasan_id', 'sk_izin_operasional', 'tanggal_sk_izin_operasional', 'no_rekening', 'nama_bank', 'cabang_kcp_unit', 'rekening_atas_nama', 'mbs', 'luas_tanah_milik', 'luas_tanah_bukan_milik', 'kode_registrasi', 'npwp', 'nm_wp', 'flag', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sekolahBinaans()
    {
        return $this->hasMany('App\SekolahBinaan', null, 'sekolah_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instalasis()
    {
        return $this->hasMany('App\Instalasi', null, 'sekolah_id');
    }
    public function bentuk_pendidikan()
    {
        return $this->belongsTo('App\Models\Bentuk_pendidikan', 'bentuk_pendidikan_id', 'bentuk_pendidikan_id');
    }
}
