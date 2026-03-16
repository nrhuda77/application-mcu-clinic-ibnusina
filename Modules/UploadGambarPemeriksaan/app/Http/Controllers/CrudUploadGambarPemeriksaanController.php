<?php

namespace Modules\UploadGambarPemeriksaan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CrudUploadGambarPemeriksaanController extends Controller
{
     public static function store(Request $request)
{
 

    $validatedData = $request->validate([
        'jenis' => 'required|array',
        'foto'  => 'required|array',
 
    ], [
    'jenis.required' => 'Jenis wajib diisi.',
    'foto.required'  => 'Foto wajib diisi.',
]
);

    try {

        foreach ($validatedData['jenis'] as $index => $jenis) {
          


            $dt = DB::table('master_berkas_digital')
                ->where('kode', $jenis)
                ->first();

            if (!$dt) continue;

            if ($request->kd_dokter != null) {
                DB::table('dokter_periksa_mcu')->insert([
                    'no_rawat'   => $request->no_rawat,
                    'kd_dokter'  => $request->kd_dokter,
                    'kd_pegawai' => $request->kd_pegawai,
                    'kode'       => $dt->kode,
                ]);
            }

            $path = self::getPathFromKode($dt->kode);
            $data_foto = $validatedData['foto'][$index];
          
            if ($data_foto->getSize() > 2 * 1024 * 1024) {
 
              
              $filename = Str::random(25) . '.jpg';

            $destinationPath = base_path('assets/' . $path);
            $namepath = 'assets/' . $path . '/' . $filename;

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $manager = new ImageManager(new Driver());
$image = $manager->read($data_foto->getRealPath());

$image->toJpeg(70)
      ->save($destinationPath . '/' . $filename);

                  
            // =======================================

            DB::table('berkas_digital_perawatan')->insert([
                'no_rawat'    => $request->no_rawat,
                'kode'        => $dt->kode,
                'lokasi_file' => $namepath,
                'created_ad'  => date('Y-m-d H:i:s'),
            ]);
   
          
              
              
			   }else{
            
            
                 $filename = Str::random(25) . '.' .$data_foto->getClientOriginalExtension();
    
                 $destinationPath = base_path('assets/'.$path); // path ke root/assets/file
                 $namepath = 'assets/'.$path.'/'. $filename;

                 if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                 }

                  $data_foto->move($destinationPath, $filename);

                  DB::table('berkas_digital_perawatan')->insert([
                      'no_rawat' => $request->no_rawat,
                      'kode' => $dt->kode,
                      'lokasi_file' => $namepath,
                      'created_ad' => date('Y-m-d H:i:s')
                  ]);
            
            }

                 }

        return response()->json(['status' => 'success']);

    } catch (\Exception $e) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Terjadi kesalahan saat input.',
            'errors'  => $e->getMessage(),
        ], 500);
    }
}
     
    public static function update(Request $request) {
        $validatedData = $request->validate([
            'jenis' => 'required',
            'foto' => 'required',

        ], [
            'jenis' => 'wajib diisi.',
            'foto' => 'wajib diisi.',
        ]);

        try {
                 $dt = DB::table('master_berkas_digital')->where('kode',$request->jenis)->first();

                if($request->kd_dokter != null) {
                    
                    if(DB::table('dokter_periksa_mcu')->where('no_rawat', $request->no_rawat)->exists()) {
                     DB::table('dokter_periksa_mcu')->where('no_rawat', $request->no_rawat)->update([
                    'no_rawat' => $request->no_rawat,
                    'kd_dokter' => $request->kd_dokter,
                    'kd_pegawai' => $request->kd_pegawai,
                    'kode' => $dt->kode
                  ]);
                    }else{
                         DB::table('dokter_periksa_mcu')->insert([
                    'no_rawat' => $request->no_rawat,
                    'kd_dokter' => $request->kd_dokter,
                    'kd_pegawai' => $request->kd_pegawai,
                    'kode' => $dt->kode
                ]);
                    }
             
                 }
              
                 $path = self::getPathFromKode($dt->kode);
                 $data_foto = $request->foto;
                 $filename = Str::random(25) . '.' .$data_foto->getClientOriginalExtension();
    
                 $destinationPath = base_path('assets/'.$path); // path ke root/assets/file
                 $namepath = 'assets/'.$path.'/'. $filename;
                 $old_path = base_path($request->lokasi_file);

                if (File::exists($old_path)) {
                    File::delete($old_path);
                 }

                 if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                 }

                  $data_foto->move($destinationPath, $filename);

                  DB::table('berkas_digital_perawatan')->where('lokasi_file', $request->lokasi_file)->update([
                      'no_rawat' => $request->no_rawat,
                      'kode' => $dt->kode,
                      'lokasi_file' => $namepath,
                      
                  ]);

            return response()->json([
                'status' => 'success',
            ]);
        }catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat input.',
                'errors'   => $e->getMessage(),
            ], 500);
        }
    }

  
    public static function destroy($lokasi_file) {
        $lkf = Crypt::decrypt($lokasi_file);
        $path = base_path($lkf);
        if (File::exists($path)) {
            File::delete($path);
         }
           DB::table('berkas_digital_perawatan')->where('lokasi_file', $lkf)->delete();

        return response()->json(['status' => 'success']);
    }

    public static function destroy_all($no_rawat) {
       $no_rwt = Crypt::decrypt($no_rawat);
       $brks = DB::table('berkas_digital_perawatan')->where('no_rawat', $no_rwt)->get();
       
       foreach($brks as $b){
        $path = base_path($b->lokasi_file);
        if (File::exists($path)) {
            File::delete($path);
         }
       }

       DB::table('berkas_digital_perawatan')->where('no_rawat', $no_rwt)->delete();
        

        return response()->json(['status' => 'success']);
    }
         



      private static function getPathFromKode($kode)
    {
        $kodePathMap = [
            '006' => 'foto-berkas-radiologi-mcu',
            '009' => 'foto-berkas-ekg-mcu',
            '010' => 'foto-berkas-audiogram-mcu',
            '011' => 'foto-berkas-spirometri-mcu',
            '012' => 'foto-berkas-visiontester-mcu',
            '013' => 'foto-berkas-pasien-mcu',
            '014' => 'foto-berkas-napfa-mcu',
            '015' => 'foto-berkas-treadmil-mcu',
            '016' => 'foto-berkas-kuesioner-acropobhia-mcu',
            '017' => 'foto-berkas-kuesioner-claustropobhia-mcu',
            '018' => 'foto-berkas-cek-lab-mcu',
        ];

        $kode = (string)$kode;

        return $kodePathMap[$kode] ?? 'foto-berkas-lab-mcu';
    }
}