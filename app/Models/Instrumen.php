<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $instrumen_id
 * @property string $ins_instrumen_id
 * @property string $tahun_ajaran_id
 * @property int $tingkat_instrumen_id
 * @property int $tipe_instrumen_id
 * @property int $jenis_tampilan_id
 * @property int $id_lama
 * @property string $kode
 * @property int $nomor_urut
 * @property string $judul
 * @property string $deskripsi
 * @property int $kepsek
 * @property int $guru
 * @property int $siswa
 * @property int $pengawas
 * @property int $komite
 * @property int $sd
 * @property int $smp
 * @property int $sma
 * @property int $smk
 * @property int $slb
 * @property int $isian_bebas
 * @property int $abstain
 * @property int $a_pertanyaan
 * @property int $kunci_jawaban
 * @property int $skor_maksimal
 * @property float $bobot_kepsek
 * @property float $bobot_guru
 * @property float $bobot_siswa
 * @property float $bobot_pengawas
 * @property float $bobot_komite
 * @property int $a_numerik
 * @property string $create_date
 * @property string $last_update
 * @property int $soft_delete
 * @property string $updater_id
 * @property string $last_sync
 * @property Instruman $instruman
 * @property Ref.jenisTampilan $ref.jenisTampilan
 * @property Ref.tahunAjaran $ref.tahunAjaran
 * @property Ref.tingkatInstruman $ref.tingkatInstruman
 * @property Ref.tipeInstruman $ref.tipeInstruman
 * @property Log.simpanJawaban[] $log.simpanJawabans
 * @property Jawaban[] $jawabans
 * @property KonfirmasiInstruman[] $konfirmasiInstrumens
 */
class Instrumen extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'instrumen';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'instrumen_id';

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
    protected $fillable = ['ins_instrumen_id', 'tahun_ajaran_id', 'tingkat_instrumen_id', 'tipe_instrumen_id', 'jenis_tampilan_id', 'id_lama', 'kode', 'nomor_urut', 'judul', 'deskripsi', 'kepsek', 'guru', 'siswa', 'pengawas', 'komite', 'sd', 'smp', 'sma', 'smk', 'slb', 'isian_bebas', 'abstain', 'a_pertanyaan', 'kunci_jawaban', 'skor_maksimal', 'bobot_kepsek', 'bobot_guru', 'bobot_siswa', 'bobot_pengawas', 'bobot_komite', 'a_numerik', 'create_date', 'last_update', 'soft_delete', 'updater_id', 'last_sync'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instruman()
    {
        return $this->belongsTo('App\Instruman', 'ins_instrumen_id', 'instrumen_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenisTampilan()
    {
        return $this->belongsTo('App\Ref.jenisTampilan', 'jenis_tampilan_id', 'jenis_tampilan_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahunAjaran()
    {
        return $this->belongsTo('App\Ref.tahunAjaran', 'tahun_ajaran_id', 'tahun_ajaran_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tingkatInstruman()
    {
        return $this->belongsTo('App\Ref.tingkatInstruman', 'tingkat_instrumen_id', 'tingkat_instrumen_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipeInstruman()
    {
        return $this->belongsTo('App\Ref.tipeInstruman', 'tipe_instrumen_id', 'tipe_instrumen_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function simpanJawabans()
    {
        return $this->hasMany('App\Log.simpanJawaban', 'instrumen_id', 'instrumen_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jawabans()
    {
        return $this->hasMany('App\Jawaban', 'instrumen_id', 'instrumen_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function konfirmasiInstrumens()
    {
        return $this->hasMany('App\KonfirmasiInstruman', 'instrumen_id', 'instrumen_id');
    }
}
