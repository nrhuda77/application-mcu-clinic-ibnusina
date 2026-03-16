<?php

namespace Modules\RegistrasiPeriksa\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudKuisonerController extends Controller
{
     public static function kuisoner(Request $request)
    {

    try {
       
      DB::table('riwayat_kesehatan_mcu')->insert([
        'no_rkm_medis' => $request->no_rkm_medis,
        'no_reg' => $request->no_reg,
        'no_rawat' => $request->no_rawat,
        'hepatitis' => $request->hepatitis,
        'hipertensi' => $request->hipertensi,
        'tbc' => $request->tbc,
        'jantung' => $request->jantung,
        'alergi' => $request->alergi,
        'asma' => $request->asma,
        'diabet' => $request->diabet,
        'wasir' => $request->wasir,
        'typhoid' => $request->typhoid,
        'hernia' => $request->hernia,
        'penyakit_kelamin' => $request->penyakit_kelamin,
        'operasi_pembedahan' => $request->operasi_pembedahan,
        'rawat_inap' => $request->rawat_inap,
        'konsumsi_obat' => $request->konsumsi_obat,
        'penyakit_saat_ini' => $request->penyakit_saat_ini,
        'penyakit_lainya' => $request->penyakit_lainya,
        'hamil' => $request->hamil,
        'keguguran' => $request->keguguran,
        'haid' => $request->haid,
        'haid_tidak_normal' => $request->haid_tidak_normal,
        'keterangan_hepatitis' => $request->keterangan_hepatitis,
        'keterangan_hipertensi' => $request->keterangan_hipertensi,
        'keterangan_tbc' => $request->keterangan_tbc,
        'keterangan_jantung' => $request->keterangan_jantung,
        'keterangan_alergi' => $request->keterangan_alergi,
        'keterangan_asma' => $request->keterangan_asma,

        'keterangan_diabet' => $request->keterangan_diabet,
        'keterangan_wasir' => $request->keterangan_wasir,
        'keterangan_typhoid' => $request->keterangan_typhoid,
        'keterangan_hernia' => $request->keterangan_hernia,
        'keterangan_penyakit_kelamin' => $request->keterangan_penyakit_kelamin,
        'keterangan_operasi_pembedahan' => $request->keterangan_operasi_pembedahan,
        'keterangan_rawat_inap' => $request->keterangan_rawat_inap,
        'keterangan_konsumsi_obat' => $request->keterangan_konsumsi_obat,

        'keterangan_penyakit_saat_ini' => $request->keterangan_penyakit_saat_ini,
        'keterangan_penyakit_lainya' => $request->keterangan_penyakit_lainya,
        'keterangan_hamil' => $request->keterangan_hamil,
        'keterangan_keguguran' => $request->keterangan_keguguran,
        'keterangan_haid' => $request->keterangan_haid,
        'keterangan_haid_tidak_normal' => $request->keterangan_haid_tidak_normal,
     
        
    ]);





    DB::table('riwayat_penyakit_keluarga_mcu')->insert([
        'no_rkm_medis' => $request->no_rkm_medis,
        'no_reg' => $request->no_reg,
        'no_rawat' => $request->no_rawat,

        'bapak_darah_tinggi' => $request->bapak_darah_tinggi,
        'ibu_darah_tinggi' => $request->ibu_darah_tinggi,
        'kakek_darah_tinggi' => $request->kakek_darah_tinggi,
        'nenek_darah_tinggi' => $request->nenek_darah_tinggi,


        'bapak_diabet' => $request->bapak_diabet,
        'ibu_diabet' => $request->ibu_diabet,
        'kakek_diabet' => $request->kakek_diabet,
        'nenek_diabet' => $request->nenek_diabet,

        'bapak_jantung' => $request->bapak_jantung,
        'ibu_jantung' => $request->ibu_jantung,
        'kakek_jantung' => $request->kakek_jantung,
        'nenek_jantung' => $request->nenek_jantung,


        'bapak_ginjal' => $request->bapak_ginjal,
        'ibu_ginjal' => $request->ibu_ginjal,
        'kakek_ginjal' => $request->kakek_ginjal,
        'nenek_ginjal' => $request->nenek_ginjal,


        'bapak_liver' => $request->bapak_liver,
        'ibu_liver' => $request->ibu_liver,
        'kakek_liver' => $request->kakek_liver,
        'nenek_liver' => $request->nenek_liver,



        'bapak_asma' => $request->bapak_asma,
        'ibu_asma' => $request->ibu_asma,
        'kakek_asma' => $request->kakek_asma,
        'nenek_asma' => $request->nenek_asma,


        'bapak_alergi' => $request->bapak_alergi,
        'ibu_alergi' => $request->ibu_alergi,
        'kakek_alergi' => $request->kakek_alergi,
        'nenek_alergi' => $request->nenek_alergi,



        'bapak_gangguan_mental' => $request->bapak_gangguan_mental,
        'ibu_gangguan_mental' => $request->ibu_gangguan_mental,
        'kakek_gangguan_mental' => $request->kakek_gangguan_mental,
        'nenek_gangguan_mental' => $request->nenek_gangguan_mental,

        'bapak_lainya' => $request->bapak_lainya,
        'ibu_lainya' => $request->ibu_lainya,
        'kakek_lainya' => $request->kakek_lainya,
        'nenek_lainya' => $request->nenek_lainya,
        
    
    ]);



    DB::table('riwayat_paparan_mcu')->insert([

      'no_rkm_medis' => $request->no_rkm_medis,
        'no_reg' => $request->no_reg,
        'no_rawat' => $request->no_rawat,

        'terpapar_bising' => $request->terpapar_bising,
        'terpapar_suhu_ekstrim_dingin' => $request->terpapar_suhu_ekstrim_dingin,
        'terpapar_suhu_ekstrim_panas' => $request->terpapar_suhu_ekstrim_panas,
        'terpapar_getaran' => $request->terpapar_getaran,
        'terpapar_debu' => $request->terpapar_debu,
        'terpapar_zat_kimia' => $request->terpapar_zat_kimia,

        'terpapar_radiasi' => $request->terpapar_radiasi,
        'terpapar_komputer' => $request->terpapar_komputer,
        'terpapar_gerakan_berulang' => $request->terpapar_gerakan_berulang,
        'terpapar_mendorong_menarik' => $request->terpapar_mendorong_menarik,
        'terpapar_angkat_beban_25' => $request->terpapar_angkat_beban_25,
        'terpapar_lainnya' => $request->terpapar_lainnya,

        'lama_terpapar_bising' => $request->lama_terpapar_bising,
        'lama_terpapar_suhu_ekstrim_dingin' => $request->lama_terpapar_suhu_ekstrim_dingin,
        'lama_terpapar_suhu_ekstrim_panas' => $request->lama_terpapar_suhu_ekstrim_panas,
        'lama_terpapar_getaran' => $request->lama_terpapar_getaran,
        'lama_terpapar_debu' => $request->lama_terpapar_debu,
        'lama_terpapar_zat_kimia' => $request->lama_terpapar_zat_kimia,

        'lama_terpapar_radiasi' => $request->lama_terpapar_radiasi,
        'lama_terpapar_komputer' => $request->lama_terpapar_komputer,
        'lama_terpapar_gerakan_berulang' => $request->lama_terpapar_gerakan_berulang,
        'lama_terpapar_mendorong_menarik' => $request->lama_terpapar_mendorong_menarik,
        'lama_terpapar_angkat_beban_25' => $request->lama_terpapar_angkat_beban_25,
        'lama_terpapar_lainnya' => $request->lama_terpapar_lainnya,
      


    ]);




    DB::table('riwayat_kebiasan_mcu')->insert([
        'no_rkm_medis' => $request->no_rkm_medis,
        'no_reg' => $request->no_reg,
        'no_rawat' => $request->no_rawat,
        'merokok' => $request->merokok,
        'kopi' => $request->kopi,
        'alkohol' => $request->alkohol,
        'olahraga' => $request->olahraga,
        'tidur' => $request->tidur,
        'keterangan_merokok' => $request->keterangan_merokok,
        'keterangan_kopi' => $request->keterangan_kopi,
        'keterangan_alkohol' => $request->keterangan_alkohol,
        'keterangan_olahraga' => $request->keterangan_olahraga,
        'keterangan_tidur' => $request->keterangan_tidur,
        
    ]);



    DB::table('riwayat_imunisasi_mcu')->insert([
        'no_rkm_medis' => $request->no_rkm_medis,
        'no_reg' => $request->no_reg,
        'no_rawat' => $request->no_rawat,
        'hep_a' => $request->hep_a,
        'hep_b' => $request->hep_b,
        'bcg' => $request->bcg,
        'polio' => $request->polio,
        'dpt' => $request->dpt,
        'tetanus' => $request->tetanus,
        'campak' => $request->campak,
        'typhoid' => $request->typhoid,
        'rubela' => $request->rubela,
        'covid19' => $request->covid19,
    ]);
    return response()->json(['status' => 'success']);

    }catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat mendaftar.',
            'error'   => $e->getMessage(),
             ], 500);
        }
    }

    public static function store_kategori(Request $request){

       try{
         DB::table('menu_kategori_mcu')->insert([
            'no_rkm_medis' => $request->no_rkm_medis,
            'no_rawat' => $request->no_rawat,
            'kategori' => $request->kategori,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return response()->json(['status' => 'success']);
       }catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat mendaftar.',
            'error'   => $e->getMessage(),
             ], 500);
        }
    }


    public static function update_kategori(Request $request){

       try{
         DB::table('menu_kategori_mcu')->where('no_rawat', $request->no_rawat)->update([
            'kategori' => $request->kategori,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return response()->json(['status' => 'success']);
       }catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan.',
            'error'   => $e->getMessage(),
             ], 500);
        }
    }

}