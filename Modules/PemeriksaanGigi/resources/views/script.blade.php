


<script type="text/javascript">
var table;
  var save_method;
 $(document).ready(function () {
   table =  $('#table').DataTable ({
   processing: true,
   serverSide: true,
   ajax: { 
     url: "/pemeriksaan-gigi",
 type:"POST",
data: function (d) {
                // Menambahkan data t_awal dan t_akhir ke request
                d._token = "{{ csrf_token() }}"; // Menyertakan token CSRF
                d.t_awal = $('#t_awal').val(); // Ambil nilai dari input tanggal awal
                d.t_akhir = $('#t_akhir').val(); // Ambil nilai dari input tanggal akhir
                
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