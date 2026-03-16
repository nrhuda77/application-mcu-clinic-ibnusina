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
        
    <img src="{{ $watermark }}" alt="watermark" class="watermark" />
    </div>

    <div class="content">
        <p style="position: relative; top: 110px; text-align: center; font-weight: bold; font-size: 20px;">PEMERIKSAAN KESEHATAN</p>
        <p style="position: relative; top: 95px; text-align: center; font-weight: bold; font-size: 20px;">(MEDICAL CHECKUP)</p>

      <table style="width: 100%; font-size: 17px; font-family:  ; margin-top: 120px; margin-left: 60px;">
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


        {{-- <p style="position: relative; bottom: 90px; left: 65px;  font-size: 16.5px; font-style: arial;">Tanggal Pemeriksaan  / <span style="font-style: italic;">Date Of
Examination</span></p>
        <p style="position: relative; bottom: 127px; left: 360px;  font-size: 16.5px; font-style: arial;">: {{$pasien->no_tlp}}</p>

        <p style="position: relative; bottom: 90px; left: 65px;  font-size: 16.5px; font-style: arial;">No. Telepon  / <span style="font-style: italic;">Phone</span></p>
        <p style="position: relative; bottom: 127px; left: 360px;  font-size: 16.5px; font-style: arial;">: {{$pasien->no_tlp}}</p>

        <p style="position: relative; bottom: 90px; left: 65px;  font-size: 16.5px; font-style: arial;">No. Telepon  / <span style="font-style: italic;">Phone</span></p>
        <p style="position: relative; bottom: 127px; left: 360px;  font-size: 16.5px; font-style: arial;">: {{$pasien->no_tlp}}</p>

        <p style="position: relative; bottom: 90px; left: 65px;  font-size: 16.5px; font-style: arial;">No. Telepon  / <span style="font-style: italic;">Phone</span></p>
        <p style="position: relative; bottom: 127px; left: 360px;  font-size: 16.5px; font-style: arial;">: {{$pasien->no_tlp}}</p>

        <p style="position: relative; bottom: 90px; left: 65px;  font-size: 16.5px; font-style: arial;">No. Telepon  / <span style="font-style: italic;">Phone</span></p>
        <p style="position: relative; bottom: 127px; left: 360px;  font-size: 16.5px; font-style: arial;">: {{$pasien->no_tlp}}</p>

        <p style="position: relative; bottom: 90px; left: 65px;  font-size: 16.5px; font-style: arial;">No. Telepon  / <span style="font-style: italic;">Phone</span></p>
        <p style="position: relative; bottom: 127px; left: 360px;  font-size: 16.5px; font-style: arial;">: {{$pasien->no_tlp}}</p> --}}



        <div class="page-break">
            
     
        </div> <!-- paksa halaman baru -->
 <p style="position: relative; top: 110px; left: 65px; font-size: 16px;"><span style="font-weight: bold;">Temuan :</span></p>
 <div style="position: relative; top: 160px !important; left: 125px; font-size: 16px;">{!! $hip->hasil !!}</div>
    </div>
</body>
</html>