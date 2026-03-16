
@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html>
<head>

    @include("laporanhasilpdfmcu::components.css.style") 

</head>
<body>
    <div class="kop-surat">
        <img src="{{ $kop }}" alt="gambar-ibnusina" />
        <hr />
        
    </div>
    <div class="footer">
        <img src="{{ $footer }}" alt="Watermark" width="300">
</div>

     <div class="watermark">
        <img src="{{ $watermark }}" alt="Watermark" width="300">
    </div>

    <div class="content">
        <p style="position: relative; top: -20px; text-align: center; font-weight: bold; font-size: 20px;">PEMERIKSAAN KESEHATAN</p>
        <p style="position: relative; top: -40px; text-align: center; font-weight: bold; font-size: 20px;">(MEDICAL CHECKUP)</p>

      <table style="width: 100%; font-size: 17px; font-family:  ; margin-top: -40px; margin-left: 60px;">
    <tr>
        <td style="width: 41%;">Nama / Name</td>
        <td style="width: 4%;">:</td>
        <td style="width: 55%;">{{ $pasien->nm_pasien }}</td>
    </tr>
    <tr>
        <td>Tanggal Lahir (Umur) / <em>Date Of Birth (Age)</em></td>
        <td>:</td>
        <td>{{ Carbon::parse($pasien->tgl_lahir)->locale('id')->translatedFormat('d F Y') }}</td>
    </tr>
    <tr>
        <td>No KTP / <em>ID Number</em></td>
        <td>:</td>
        <td>{{ $pasien->no_ktp }}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin / <em>Sex</em></td>
        <td>:</td>
        <td>{{ $pasien->jk ? 'Laki-laki' : 'Perempuan' }}</td>
    </tr>
    <tr>
        <td>No. Telepon / <em>Phone</em></td>
        <td>:</td>
        <td>{{ $pasien->no_tlp }}</td>
    </tr>
    <tr>
        <td>Jabatan / <em>Job Title</em></td>
        <td>:</td>
        <td>{{ $pasien->pekerjaan }}</td>
    </tr>
    <tr>
        <td>Alamat / <em>Address</em></td>
        <td>:</td>
        <td> <div style="max-width: 90%;">{{ $pasien->alamat }}</div> </td>
    </tr>

     <tr>
        <td>Tanggal Pemeriksaan / <em>Date Of Examination</em></td>
        <td>:</td>
        <td>{{Carbon::parse($booking->tanggal_periksa)->locale('id')->translatedFormat('d F Y')}}</td>
    </tr>

    <tr>
        <td>Massa Berlaku / <em>Expired Date</em></td>
        <td>:</td>
        <td>{{ Carbon::parse($booking->tanggal_periksa)->addYear()->locale('id')->translatedFormat('d F Y') }}</td>
    </tr>

     <tr>
        <td>Instansi / <em>Company</em></td>
        <td>:</td>
        <td>-</td>
    </tr>

     <tr>
        <td>Proyek / <em>Project</em></td>
        <td>:</td>
        <td>-</td>
    </tr>

     <tr>
        <td>Jenis Pemeriksaan / <em>Type Of Examination</em></td>
        <td>:</td>
        <td>Berkala</td>
    </tr>

     <tr>
        <td>No. Rekam Medis / <em>Medical Record Number</em></td>
        <td>:</td>
        <td>{{$pasien->no_rkm_medis}}</td>
    </tr>

     <tr>
        <td>No. MCU</td>
        <td>:</td>
        <td>{{Carbon::parse($booking->tanggal_periksa)->locale('id')->translatedFormat('d F Y')}}</td>
    </tr>

</table>

</div>
       


        <div class="page-break"></div>
   <div class="content">
                     <p style="position: relative; top: -35px; left: 65px; font-size: 20px;">
                        <span style="font-weight: bold;"><u>SERTIFIKAT HASIL PEMERIKSAAN KESEHATAN</u> 
                        </span></p>
                     <p style="position: relative; top: -40px; left: 65px; font-size: 16px;">
                        <span >Berikut ini adalah hasil pemeriksaan kesehatan yang dilakukan pada tanggal : {{ $reg->tgl_registrasi }}</span>
                   <br> Nama <br> Jabatan <br>
                   <span style="position: relative; top: -38px; left: 55px; font-size: 16px;">: {{ $pasien->nm_pasien }}</span>
                    <br>  <span style="position: relative; top: -38px; left: 55px; font-size: 16px;">: {{ $pasien->pekerjaan }}</span>
                    <span style="font-weight: bold;">TEMUAN :</span>
      
                    </p>
                    
               

                     {{-- <p style="position: relative; top: -105px; left: 65px; font-size: 16px;"><span >Jabatan</span></p>
                     <p style="position: relative; top: -140px; left: 125px; font-size: 16px;"><span >: {{ $pasien->pekerjaan }}</span></p> --}}
                    
                    {{-- <p style="position: relative; top: -145px; left: 65px; font-size: 18px;"><span style="font-weight: bold;">TEMUAN :</span></p> --}}
                    <div style="position: relative; top: -108px !important; left: 140px; font-size: 16px;">{!! $hip->hasil !!}</div>
                    <div></div>

       <table id="kategori" style="">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Item</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 7; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>Item {{ $i }}</td>
                    <td>Ini deskripsi item nomor {{ $i }}.</td>
                </tr>
            @endfor
        </tbody>
    </table>
   

     
        </div> 
   <div class="page-break">sd</div>
    
</body>
</html>
