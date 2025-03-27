<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPencatatanSkrining extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'detail_pencatatan_skrinings';

    protected $fillable = [
        'id_pencatatan_skrining',
        'id_pertanyaan_skrining',
        'hasil_skrining'
    ];

    public function pencatatanSkrining()
    {
        return $this->belongsTo(PencatatanSkrining::class, 'id_pencatatan_skrining');
    }

    public function pertanyaanSkrining()
    {
        return $this->belongsTo(PertanyaanSkrining::class, 'id_pertanyaan_skrining');
    }
}