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


 <p style="position: relative; top: 110px; left: 65px; font-size: 16px;"><span style="font-weight: bold;">Saran :</span></p>
 <div style="position: relative; top: 60px !important; left: 125px; font-size: 16px;">{!! $content->catatan_hasil !!}</div>
  
</body>
</html>