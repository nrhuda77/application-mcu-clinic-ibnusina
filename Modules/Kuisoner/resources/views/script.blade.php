@php
    $uri = $url;
@endphp


<script type="text/javascript">
var table;
  var save_method;
 $(document).ready(function () {
   table =  $('#table').DataTable ({
   processing: true,
   serverSide: true,
   ajax: { 
     url: "/{{ $uri }}",
 type:"POST",
data: function (d) {
                // Menambahkan data t_awal dan t_akhir ke request
                d._token = "{{ csrf_token() }}"; // Menyertakan token CSRF
                d.t_awal = $('#t_awal').val(); // Ambil nilai dari input tanggal awal
                d.t_akhir = $('#t_akhir').val(); // Ambil nilai dari input tanggal akhir
                d.url = "{{ $uri }}";
                
            }
 },
 columnDefs: [
   {
  
     targets: [ -1 ], //last column
     orderable: false, //set not orderable
   }
 ]
});

 })

 $('#t_awal').on('change', function() {
    reload_table(); // Memuat ulang DataTables saat input tanggal berubah
  });

 $('#t_akhir').on('change', function() {
    reload_table(); // Memuat ulang DataTables saat input tanggal berubah
  });


   $("#nm_pasien").select2({
        width: '100%',
    dropdownParent: $("#modal-pop"),
    ajax: {
        url: '/ajax-select-registrasi-periksa',
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // gunakan params.term untuk search term
            };
        },
        processResults: function (data) { // ganti results dengan processResults
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.nm_pasien + ' # ' + item.id,
                        id: item.id
                    };
                })
            };
        },
        cache: true
    }
});


  $('#nm_pasien').on('change', function() {
        
        $.ajax({
            url: '/registrasi-periksa/get-no-rawat',
            type: 'GET',
            dataType: 'json',
                success: function(data)
           {
            
             $("#no_rawat").val(data); 
    
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error adding / update data');
               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
           }
        })
       

      
    });


$("#nm_pasien").on('change', function () {

    Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

    var selectedValue = $(this).val();

  $.ajax({
    url: '/get-registrasi-periksa/' + $(this).val(),
    type: 'GET',
    dataType: 'json',
  })
  .done(function(data) {
    Notiflix.Block.remove('.blocking');
    if(data.booking == null){
      Notiflix.Notify.failure('Data Booking pasien tidak ditemukan');
      $('#no_reg').val('---');
      $('#kd_dokter').val('');
      $('#kd_pj').val('');
    }
    var jk = data.pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan'; 
    $('#no_rkm_medis').val(selectedValue);
    $('#no_ktp').val(data.pasien.no_ktp);
    $('#tempat_lahir').val(data.pasien.tmp_lahir);
    $('#tgl_lahir').val(data.pasien.tgl_lahir);
    $('#alamat').val(data.pasien.alamat);  
    $('#jenis_kelamin').val(jk); 
    $('#no_tlp').val(data.pasien.no_tlp);
    $("#hubunganpj").val(data.pasien.keluarga);  
    $("#p_jawab").val(data.pasien.pnd); 
    $("#sttsumur").val(data.stt_umur);
    $("#umurdaftar").val(data.pasien.umur);

    $('#no_reg').val(data.booking.no_reg ?? '---');
    $('#kd_dokter').val(data.booking.kd_dokter ?? '');
    $('#kd_pj').val(data.booking.kd_pj ?? '');
    Notiflix.Notify.success('Data Booing berhasil diambil');
    
  })
  .fail(function() {
    Notiflix.Block.remove('.blocking');
    console.log("error");
    Notiflix.Notify.failure('Data gagal diambil');
  })
  .always(function() {
    Notiflix.Block.remove('.blocking');
    console.log("complete");
  });
  })




  $("#kd_dokter").on('change', function () {

    Notiflix.Block.arrows('.blocking2', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

    var selectedValue = $(this).val();

  $.ajax({
    url: '/registrasi-periksa/get-noreg/' + $(this).val(),
    type: 'GET',
    dataType: 'json',
  })
  .done(function(data) {
    Notiflix.Block.remove('.blocking2');
    $('#no_reg').val(data);
    Notiflix.Notify.success('No Reg berhasil diambil');
  })
  .fail(function() {
    Notiflix.Block.remove('.blocking2');
    console.log("error");
    Notiflix.Notify.failure('No Reg gagal diambil');
  })
  .always(function() {
    Notiflix.Block.remove('.blocking2');
    console.log("complete");
  });
  })





        Notiflix.Confirm.init({
className: 'notiflix-confirm',
width: '300px',
zindex: 4003,
position: 'center',
distance: '10px',
backgroundColor: '#f8f8f8',
borderRadius: '25px',
backOverlay: true,
backOverlayColor: 'rgba(0,0,0,0.5)',
rtl: false,
fontFamily: 'Quicksand',
cssAnimation: true,
cssAnimationDuration: 300,
cssAnimationStyle: 'fade',
plainText: true,
titleColor: '#DC143C',
titleFontSize: '16px',
titleMaxLength: 34,
messageColor: '#1e1e1e',
messageFontSize: '14px',
messageMaxLength: 110,
buttonsFontSize: '15px',
buttonsMaxLength: 34,
okButtonColor: '#f8f8f8',
okButtonBackground: '#DC143C',
cancelButtonColor: '#f8f8f8',
cancelButtonBackground: '#a9a9a9',
});



function reload_table()
   {
      table.ajax.reload(null,false); //reload datatable ajax
   }

function add() {
  save_method = 'add';
  $('#form')[0].reset(); // reset form on modals
  $('#modal-pop').modal('show'); // show bootstrap modal
  $('.modal-title').text('Tambah Data Registrasi'); // Set Title to Bootstrap modal title
  $('.psn2').hide();
  $('.psn').show();
  $('.wbk2').hide();
  $('.wbk').show();
  $('#btnSave').show();
}

function printErrorMsg (msg) {
         $.each( msg, function( key, value ) {
         console.log(key);
           $('.'+key+'_err').text(value);
         });
     }




      function detail(no_rawat)
   {

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
    
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-data-registrasi-periksa/" + no_rawat,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {

              const jp = data.pasien.jp == 'L' ? 'Laki-laki' : 'Perempuan'
               $('.psn').hide();
               $('.psn2').show();
               $('.wbk').hide();
               $('.wbk2').show();
               $('#btnSave').hide();
               $('.nm_pasien').val(data.pasien.nm_pasien);
               $('[name="no_rkm_medis"]').val(data.pasien.no_rkm_medis);
               $('[name="no_ktp"]').val(data.pasien.no_ktp);
               $('[name="no_tlp"]').val(data.pasien.no_tlp);
               $('[name="tempat_lahir"]').val(data.pasien.tmp_lahir);
               $('[name="jenis_kelamin"]').val(jp);
               $('[name="tgl_lahir"]').val(data.pasien.tgl_lahir);
               $('[name="alamat"]').val(data.pasien.alamat);
               $('[name="no_rawat"]').val(data.reg.no_rawat);
               $('[name="hubunganpj"]').val(data.reg.hubunganpj);
               $('[name="kd_dokter"]').val(data.reg.kd_dokter);
               $('[name="no_reg"]').val(data.reg.no_reg);
               $('[name="kd_pj"]').val(data.reg.kd_pj);
               $('[name="status"]').val(data.reg.status);
               $('[name="umurdaftar"]').val(data.reg.umurdaftar);
               $('[name="sttsumur"]').val(data.reg.sttsumur);
               $('[name="p_jawab"]').val(data.reg.p_jawab);
               $('[name="biaya_reg"]').val(data.reg.biaya_reg);
               $('[name="stts"]').val(data.reg.stts);
               $('[name="stts_daftar"]').val(data.reg.stts_daftar);
               $('[name="stts_lanjut"]').val(data.reg.stts_lanjut);
               $('[name="status_bayar"]').val(data.reg.status_bayar);
               $('[name="status_poli"]').val(data.reg.status_poli);
               $('#modal-pop').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Detail Data Registrasi'); // Set title to Bootstrap modal title
            
               Notiflix.Block.remove('.blocking');
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }

function save()

   {
    
       $('#btnSave').text('Menyimpan...'); //change button text
       $('#btnSave').attr('disabled',true); //set button disable 
       var url;

         Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });
    
       if(save_method == 'add') {
           url = "/insert-registrasi-periksa";
       } else {
           url = "/update-registrasi-periksa";
       }
    
       // ajax adding data to database
       $.ajax({
           url : url,
           type: "POST",
           data: $('#form').serialize(),
           dataType: "JSON",
           success: function(data)
           {
    
               if(data.status == 'success') //if success close modal and reload ajax table
               {
                   $('#modal-pop').modal('hide');
                   reload_table();
                   Notiflix.Report.success(
                'Berhasil',
                'Data berhasil diinput',
                'Okay');
               }
               else
               {
                    Notiflix.Report.failure(
                 'Error',
                 'Data gagal diinput',
                 'Okay',
                );
               }
               Notiflix.Block.remove('.blocking');
               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
              Notiflix.Block.remove('.blocking');
              console.log(jqXHR.responseJSON.errors);
              
              printErrorMsg(jqXHR.responseJSON.errors);
                Notiflix.Report.failure(
                 'Error',
                 'Data gagal diinput',
                 'Okay',
                );
               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
           }
       });
   }


  </script>