<aside id="layout-menu" class="layout-menu menu-vertical menu " style="background-color: rgb(13, 163, 123)">
    {{-- #263A5F --}}
    <div class="app-brand demo" >
        <a href="{{ url('halaman_dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo  mt-5">
                <span class="text-primary  ">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" height="60" />
                </span>
                
                {{-- <span class="app-brand-text demo menu-text fw-bold m"> Sina</span> --}}
            </span>
            <span class="app-brand-text demo menu-text fw-bold mt-3">Admin Mcu Ibnu Sina</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base ti menu-toggle-icon d-none d-xl-block text-white"></i>
            <i class="icon-base ti tabler-x d-block d-xl-none text-white"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-5">
        <!-- Dashboards -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ url('/dashboard') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-layout-dashboard"></i>
                <div class="text-white" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

       

        <!-- Inventory -->
        <li class="menu-header small">
            <span class="menu-header-text text-white" style="font-weight: bold" data-i18n="Data Pasien">Data Pasien</span>
        </li>
   

        
        <li class="menu-item {{ Request::is('approval-pasien') ? 'active' : '' }}
                             {{ Request::is('detail-pkk*') ? 'active' : '' }}">
            <a href="{{ url('/approval-pasien') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-device-ipad-check"></i>
                <div class="text-white">Approval Pasien</div>
            </a>
        </li>   

		<li class="menu-item {{ Request::is('booking-registrasi') ? 'active' : '' }}">
            <a href="{{ url('/booking-registrasi') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-clipboard-copy"></i>
                <div class="text-white">Booking Registrasi</div>
            </a>
        </li> 
		
		<li class="menu-item {{ Request::is('registrasi-periksa') ? 'active' : '' }}">
            <a href="{{ url('/registrasi-periksa') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-file-text-spark"></i>
                <div class="text-white">Registrasi Periksa</div>
            </a>
        </li>   
		
		    <li class="menu-item {{ Request::is('pasien') ? 'active' : '' }}">
            <a href="{{ url('/pasien') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-user"></i>
                <div class="text-white">Pasien</div>
            </a>
        </li>  

          <li class="menu-item {{ Request::is('pengajuan-pasien') ? 'active' : '' }}">
            <a href="{{ url('/pengajuan-pasien') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-license"></i>
                <div class="text-white">Pengajuan Pasien</div>
            </a>
        </li>  
                            


        <!-- Supplier -->
        <li class="menu-header small">
            <span class="menu-header-text text-white" style="font-weight: bold" data-i18n="Pemeriksaan Pasien">Pemeriksaan Pasien</span>
        </li>

				
		<li class="menu-item {{Request::is('riwayat-paparan') ? 'active' : ''}}
                             {{Request::is('riwayat-kesehatan') ? 'active' : ''}}
                             {{ Request::is('riwayat-penyakit-keluarga') ? 'active' : '' }}
                             {{ Request::is('riwayat-imunisasi') ? 'active' : '' }}
                             {{ Request::is('riwayat-kebiasaan') ? 'active' : '' }}

                             {{ Request::is('detail-riwayat-kesehatan*') ? 'active' : '' }}
                             {{ Request::is('detail-riwayat-paparan*') ? 'active' : '' }}
                             {{ Request::is('detail-riwayat-penyakit-keluarga*') ? 'active' : '' }}
                             {{ Request::is('detail-riwayat-imunisasi*') ? 'active' : '' }}
                             {{ Request::is('detail-riwayat-kebiasaan*') ? 'active' : '' }}
                             
                             ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon text-white icon-base ti tabler-align-box-center-top"></i>
                <div class="text-white" data-i18n="Kuisoner">Kuisoner</div>
            </a>
            <ul class="menu-sub text-white">
                <li class="text-white menu-item {{Request::is('riwayat-kesehatan') ? 'active' : ''}}
                                     {{ Request::is('detail-riwayat-kesehatan*') ? 'active' : '' }} ">
                    <a href="/riwayat-kesehatan" class="menu-link text-white">
                        <div class="text-white" data-i18n="Riwayat Kesehatan">Riwayat Kesehatan</div>
                    </a>
                </li>
                <li class="menu-item {{Request::is('riwayat-penyakit-keluarga') ? 'active' : ''}} 
                                     {{ Request::is('detail-riwayat-penyakit-keluarga*') ? 'active' : '' }}">
                    <a href="/riwayat-penyakit-keluarga" class="menu-link">
                        <div class="text-white" data-i18n="Riwayat <br> Penyakit Keluarga">Riwayat <br> Penyakit Keluarga</div>
                    </a>
                </li>
                <li class="menu-item {{Request::is('riwayat-kebiasaan') ? 'active' : ''}} 
                                     {{ Request::is('detail-riwayat-kebiasaan*') ? 'active' : '' }}">
                    <a href="/riwayat-kebiasaan" class="menu-link">
                        <div class="text-white" data-i18n="Riwayat Kebiasaan">Riwayat Kebiasaan</div>
                    </a>
                </li>
                <li class="menu-item {{Request::is('riwayat-imunisasi') ? 'active' : ''}}
                                     {{ Request::is('detail-riwayat-imunisasi*') ? 'active' : '' }}">
                    <a href="/riwayat-imunisasi" class="menu-link">
                        <div class="text-white" data-i18n="Riwayat Imunisasi">Riwayat Imunisasi</div>
                    </a>
                </li>
                <li class="menu-item {{Request::is('riwayat-paparan') ? 'active' : ''}}
                                     {{ Request::is('detail-riwayat-paparan*') ? 'active' : '' }}">
                    <a href="/riwayat-paparan" class="menu-link">
                        <div class="text-white" data-i18n="Riwayat Paparan">Riwayat Paparan</div>
                    </a>
                </li>
            </ul>
        </li>
               

        <li class="menu-item {{ Request::is('pemeriksaan-gigi') ? 'active' : '' }}
                             {{ Request::is('detail-pemeriksaan-gigi*') ? 'active' : '' }}">
            <a href="{{ url('pemeriksaan-gigi') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-dental"></i>
                <div class="text-white" data-i18n="Gigi">Gigi</div>
            </a>
        </li>
       

        	<li class="menu-item {{Request::is('vital-kondisi-umum') ? 'active' : ''}}
                                 {{Request::is('fisik-kulit-mata') ? 'active' : ''}}
                                 {{Request::is('thoraks-abdomen') ? 'active' : ''}}
                                 {{Request::is('genital-anus') ? 'active' : ''}}
                                 {{Request::is('detail-vital-kondisi-umum*') ? 'active' : ''}}
                                 {{Request::is('detail-fisik-kulit-mata*') ? 'active' : ''}}
                                 {{Request::is('detail-thoraks-abdomen*') ? 'active' : ''}}
                                 {{Request::is('detail-genital-anus*') ? 'active' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon text-white icon-base ti tabler-checkup-list"></i>
                <div class="text-white" data-i18n="Pemeriksaan Lanjut">Pemeriksaan Lanjut</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{Request::is('vital-kondisi-umum') ? 'active' : ''}}">
                    <a href="/vital-kondisi-umum" class="menu-link">
                        <div class="text-white" data-i18n="Vital & Kondisi Umum">Vital & Kondisi Umum</div>
                    </a>
                </li>
                <li class="menu-item {{Request::is('fisik-kulit-mata') ? 'active' : ''}}">
                    <a href="/fisik-kulit-mata" class="menu-link">
                        <div class="text-white" data-i18n="Fisik, Kulit, Mata & THT">Fisik, Kulit, Mata & THT</div>
                    </a>
                </li>
                <li class="menu-item {{Request::is('thoraks-abdomen') ? 'active' : ''}}">
                    <a href="/thoraks-abdomen" class="menu-link">
                        <div class="text-white" data-i18n="Thoraks & Abdomen">Thoraks & Abdomen</div>
                    </a>
                </li>
                <li class="menu-item {{Request::is('genital-anus') ? 'active' : ''}}">
                    <a href="/genital-anus" class="menu-link">
                        <div class="text-white" data-i18n="Genital, Anus, <br> Vertebrata & Extremitas">Genital, Anus, <br> Vertebrata & Extremitas</div>
                    </a>
                </li>
            </ul>
        </li>

       
        <li class="menu-item {{ Request::is('pemeriksaan-nonlab') ? 'active' : '' }}
                             {{ Request::is('detail-pemeriksaan-nonlab*') ? 'active' : '' }}">
            <a href="{{ url('pemeriksaan-nonlab') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-flask-off"></i>
                <div class="text-white" data-i18n="Cek Non Lab">Cek Non Lab</div>
            </a>
        </li>


         <!-- Supplier -->
        <li class="menu-header small">
            <span class="menu-header-text text-white" style="font-weight: bold" data-i18n="Inputan">Inputan</span>
        </li>

        <li class="menu-item {{ Request::is('upload-gambar-pemeriksaan') ? 'active' : '' }}
                             {{ Request::is('detail-upload-gambar-pemeriksaan*') ? 'active' : '' }}">
            <a href="{{ url('upload-gambar-pemeriksaan') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-library-photo"></i>
                <div class="text-white" data-i18n="Upload Gambar <br> Pemeriksaan">Upload Gambar <br> Pemeriksaan</div>
            </a>
        </li>

	<li class="menu-item {{Request::is('score-jakarta-cardiovascular') ? 'active' : ''}}
                         {{Request::is('detail-score-jakarta-cardiovascular*') ? 'active' : ''}}
						 {{Request::is('score-pemeriksaan-napfa') ? 'active' : ''}}
					     {{Request::is('detail-score-pemeriksaan-napfa*') ? 'active' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon text-white icon-base ti tabler-jump-rope"></i>
                <div class="text-white" data-i18n="Score Input">Score Input</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{Request::is('score-jakarta-cardiovascular') ? 'active' : ''}}
                                     {{Request::is('detail-score-jakarta-cardiovascular*') ? 'active' : ''}}">
                    <a href="/score-jakarta-cardiovascular" class="menu-link">
                        <div class="text-white" data-i18n="Score Jakarta <br> Cardiovascular">Score Jakarta <br> Cardiovascular </div>
                    </a>
                </li>
                <li class="menu-item  {{Request::is('score-pemeriksaan-napfa') ? 'active' : ''}}
					                  {{Request::is('detail-score-pemeriksaan-napfa*') ? 'active' : ''}}">
                    <a href="/score-pemeriksaan-napfa"  class="menu-link">
                        <div class="text-white" data-i18n="Score Napfa">Score Napfa</div>
                    </a>
                </li>
            </ul>
        </li>

   <li class="menu-item {{Request::is('hasil-inputan-dokter') ? 'active' : ''}}
                         {{Request::is('detail-hasil-inputan-dokter*') ? 'active' : ''}}
						 {{Request::is('hasil-inputan-dokter-spirometri') ? 'active' : ''}}
					     {{Request::is('detail-hasil-inputan-dokter-spirometri*') ? 'active' : ''}}
                         {{Request::is('hasil-inputan-dokter-audiogram') ? 'active' : ''}}
					     {{Request::is('detail-hasil-inputan-dokter-audiogram*') ? 'active' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon text-white icon-base ti tabler-report"></i>
                <div class="text-white" data-i18n="Hasil Inputan">Hasil Inputan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{Request::is('hasil-inputan-dokter') ? 'active' : ''}}
                                     {{Request::is('detail-hasil-inputan-dokter*') ? 'active' : ''}}">
                    <a href="/hasil-inputan-dokter" class="menu-link">
                        <div class="text-white" data-i18n="Hasil inputan Dokter">Hasil inputan Dokter </div>
                    </a>
                </li>
                <li class="menu-item  {{Request::is('hasil-inputan-dokter-spirometri') ? 'active' : ''}}
					                  {{Request::is('detail-hasil-inputan-dokter-spirometri*') ? 'active' : ''}}">
                    <a href="/hasil-inputan-dokter-spirometri"  class="menu-link">
                        <div class="text-white" data-i18n="Hasil Inputan <br> Dokter Spirometri">Hasil Inputan <br> Dokter Spirometri</div>
                    </a>
                </li>
                <li class="menu-item  {{Request::is('hasil-inputan-dokter-audiogram') ? 'active' : ''}}
					                  {{Request::is('detail-hasil-inputan-dokter-audiogram*') ? 'active' : ''}}">
                    <a href="/hasil-inputan-dokter-audiogram"  class="menu-link">
                        <div class="text-white" data-i18n="Hasil Inputan <br> Dokter Audiogram">Hasil Inputan <br> Dokter Audiogram</div>
                    </a>
                </li>
                 <li class="menu-item  {{Request::is('hasil-inputan-dokter-rongentdada') ? 'active' : ''}}
					                  {{Request::is('detail-hasil-inputan-dokter-rongentdada*') ? 'active' : ''}}">
                    <a href="/hasil-inputan-dokter-rongentdada"  class="menu-link">
                        <div class="text-white" data-i18n="Hasil Inputan Dokter <br> Rongent Dada">Hasil Inputan Dokter  <br> Rongent Dada</div>
                    </a>
                </li>
                      <li class="menu-item  {{Request::is('hasil-inputan-dokter-elektrokardiogram') ? 'active' : ''}}
					                  {{Request::is('detail-hasil-inputan-dokter-elektrokardiogram*') ? 'active' : ''}}">
                    <a href="/hasil-inputan-dokter-elektrokardiogram"  class="menu-link">
                        <div class="text-white" data-i18n="Hasil Inputan Dokter <br> ElektroKardiogram">Hasil Inputan Dokter  <br> ElektroKardiogram</div>
                    </a>
                </li>
                </li>
            </ul>
        </li>

          <!-- Supplier -->
        <li class="menu-header small">
            <span class="menu-header-text text-white" style="font-weight: bold" data-i18n="User">User</span>
        </li>

           <li class="menu-item {{ Request::is('pengguna') ? 'active' : '' }}">
            <a href="{{ url('/pengguna') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-license"></i>
                <div class="text-white">User</div>
            </a>
        </li>  


         <!-- Supplier -->
        <li class="menu-header small">
            <span class="menu-header-text text-white" style="font-weight: bold" data-i18n="Laporan">Laporan</span>
        </li>

         <li class="menu-item {{Request::is('laporan-pdf-mcu') ? 'active' : ''}}
                         {{Request::is('detail-laporan-pdf-mcu*') ? 'active' : ''}}
						 {{Request::is('laporan-mcu') ? 'active' : ''}}
					     {{Request::is('detail-laporan-mcu*') ? 'active' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon text-white icon-base ti tabler-clipboard-data"></i>
                <div class="text-white" data-i18n="Laporan Pdf Mcu">Laporan Hasil Mcu</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{Request::is('laporan-pdf-mcu') ? 'active' : ''}}
                                     {{Request::is('detail-laporan-pdf-mcu*') ? 'active' : ''}}">
                    <a href="/laporan-pdf-mcu" class="menu-link">
                        <div class="text-white" data-i18n="Laporan Pdf Mcu">Laporan Pdf Mcu </div>
                    </a>
                </li>
                <li class="menu-item  {{Request::is('laporan-mcu') ? 'active' : ''}}
					                  {{Request::is('detail-laporan-mcu*') ? 'active' : ''}}">
                    <a href="/laporan-mcu"  class="menu-link">
                        <div class="text-white" data-i18n="Laporan Mcu">Laporan Mcu</div>
                    </a>
                </li>
            </ul>
        </li>


	<li class="menu-item">
        
            <a href="{{ url('/logout-admin') }}" class="menu-link"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="menu-icon text-white icon-base ti tabler-logout"></i>
                <div class="text-white">Logout</div>
            </a>
             <form id="logout-form" method="POST" action="/logout-pasien">
              @csrf
            </form>
        </li> 
	

    </ul>

    	
</aside>



{{-- <script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script> --}}
<script>
//    setInterval(() => {
//   $.ajax({
//           url : "/ajax_numonline" ,
//           type: "GET",
//           dataType: "JSON",
          
//           success: function(data)
//           {
            
//               var element = document.getElementById('number')
//               var element2 = document.getElementById('number2')
//                var element3 = document.getElementById('number3')
//                 var element4 = document.getElementById('number4')
//               element.innerHTML = data[0];
//               element2.innerHTML = data[1];
//               element3.innerHTML = data[2];
//                element4.innerHTML = data[3];

            
//           },
//           error: function (jqXHR, textStatus, errorThrown)
//           {
//               // alert('Error get data from ajax');
//           }
//          });

       
// }, 1000);
</script>


<!-- End Sidebar -->