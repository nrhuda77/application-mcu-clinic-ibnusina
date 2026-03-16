<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pasien extends Authenticatable 
{
    use HasFactory;
    protected $table = "pasien";
    protected $guarded = ['id'];

   public $timestamps = false; // Nonaktifkan fitur timestamps

    public function getAuthIdentifierName()
    {
        return 'no_ktp';
    }

    // Cek apakah tanggal lahir sesuai
    public function getAuthPassword()
    {
        return null;// Tanggal lahir yang digunakan untuk autentikasi
    }
}