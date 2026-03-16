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


 <div style="position: relative; top: 0px !important; left: 125px; font-size: 16px;">{!! $content->hasil !!}</div>
  
</body>
</html>