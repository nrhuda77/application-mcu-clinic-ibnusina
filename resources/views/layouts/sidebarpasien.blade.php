<aside id="layout-menu" class="layout-menu menu-vertical menu " style="background-color: rgb(13, 140, 163)">
    {{-- #263A5F --}}
    <div class="app-brand demo" >
        <a href="{{ url('halaman_dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo  mt-5">
                <span class="text-primary  ">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" height="60" />
                </span>
                
                {{-- <span class="app-brand-text demo menu-text fw-bold m"> Sina</span> --}}
            </span>
            <span class="app-brand-text demo menu-text fw-bold mt-3">Pasien Mcu Ibnu Sina</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base ti menu-toggle-icon d-none d-xl-block text-white"></i>
            <i class="icon-base ti tabler-x d-block d-xl-none text-white"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-5">
        <!-- Dashboards -->
        <li class="menu-item {{ Request::is('dashboard-pasien') ? 'active' : '' }}">
            <a href="{{ url('/dashboard-pasien') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-layout-dashboard"></i>
                <div class="text-white" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

       

        <!-- Inventory -->
        <li class="menu-header small">
            <span class="menu-header-text text-white" style="font-weight: bold" data-i18n="Data Pasien">Data Pasien</span>
        </li>
   

       
		
		<li class="menu-item {{ Request::is('registrasi-periksa') ? 'active' : '' }}">
            <a href="{{ url('/registrasi-periksa') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-file-text-spark"></i>
                <div class="text-white">Profile</div>
            </a>
        </li>   
		
		
                            


        <!-- Supplier -->
        <li class="menu-header small">
            <span class="menu-header-text text-white" style="font-weight: bold" data-i18n="Pemeriksaan Pasien">Pemeriksaan Pasien</span>
        </li>

        <li class="menu-item {{ Request::is('kuisoner') ? 'active' : '' }}">
            <a href="{{ url('kuisoner') }}" class="menu-link">
                <i class="menu-icon text-white icon-base ti tabler-dental"></i>
                <div class="text-white" data-i18n="Kuisoner">Kuisoner</div>
            </a>
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

</script>


<!-- End Sidebar -->