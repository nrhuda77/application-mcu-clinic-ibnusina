  <script>
var table;
  var save_method;
 $(document).ready(function () {
   table =  $('#table').DataTable ({
   processing: true,
   serverSide: true,
   ajax: { 
     url: "/booking-registrasi",
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


   $("#nm_pasien").select2({
        width: '100%',
    dropdownParent: $("#modal-pop"),
    ajax: {
        url: '/ajax-select-booking-registrasi',
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
                        text: item.nama + ' # ' + item.id,
                        id: item.id
                    };
                })
            };
        },
        cache: true
    }
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
    url: '/get-booking-registrasi/' + $(this).val(),
    type: 'GET',
    dataType: 'json',
  })
  .done(function(data) {
    Notiflix.Block.remove('.blocking');
    var jk = data.jk == 'L' ? 'Laki-laki' : 'Perempuan'; 
    $('#no_rkm_medis').val(selectedValue);
    $('#no_ktp').val(data.no_ktp);
    $('#tempat_lahir').val(data.tmp_lahir);
    $('#tgl_lahir').val(data.tgl_lahir);
    $('#alamat').val(data.alamat);  
    $('#jenis_kelamin').val(jk); 
    Notiflix.Notify.success('Data berhasil diambil');
    
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
    url: '/booking-registrasi/get-noreg/' + $(this).val(),
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



  function updateDateTime() {

    var now = new Date(); // Mendapatkan waktu sistem saat ini
    var year = now.getFullYear();
    var month = (now.getMonth() + 1).toString().padStart(2, '0'); // Bulan dalam format 2 digit
    var day = now.getDate().toString().padStart(2, '0'); // Tanggal dalam format 2 digit
    var hour = now.getHours().toString().padStart(2, '0'); // Jam dalam format 2 digit
    var minute = now.getMinutes().toString().padStart(2, '0'); // Menit dalam format 2 digit
    var second = now.getSeconds().toString().padStart(2, '0'); // Detik dalam format 2 digit

    // Membuat string waktu dalam format yang diterima oleh input datetime-local
    var datetime = year + '-' + month + '-' + day + 'T' + hour + ':' + minute;
    document.getElementById('waktu_booking').value = datetime;
  }

  setInterval(updateDateTime, 1000); 


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
  $('.modal-title').text('Tambah Booking'); // Set Title to Bootstrap modal title
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



        function edit(no_rkm_medis,tgl_periksa)
   {

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

       save_method = 'update';
       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
    
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-data-booking-registrasi/" + no_rkm_medis + '/' + tgl_periksa,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {
              const jp = data.jp == 'L' ? 'Laki-laki' : 'Perempuan'
               $('.psn').hide();
               $('.psn2').show();
               $('.wbk').hide();
               $('.wbk2').show();
               $('#btnSave').show();
               $('.nm_pasien').val(data.pasien.nm_pasien);
               $('[name="no_rkm_medis"]').val(data.pasien.no_rkm_medis);
               $('[name="no_ktp"]').val(data.pasien.no_ktp);
               $('[name="tempat_lahir"]').val(data.pasien.tmp_lahir);
               $('[name="jenis_kelamin"]').val(jp);
               $('[name="tgl_lahir"]').val(data.pasien.tgl_lahir);
               $('[name="alamat"]').val(data.pasien.alamat);
               $('[name="tanggal_periksa"]').val(data.reg.tanggal_periksa);
               $('[name="tanggal_periksa_edit"]').val(data.reg.tanggal_periksa);
               $('[name="kd_dokter"]').val(data.reg.kd_dokter);
               $('[name="no_reg"]').val(data.reg.no_reg);
               $('[name="kd_pj"]').val(data.reg.kd_pj);
               $('[name="status"]').val(data.reg.status);
               $('[name="waktu_kunjungan"]').val(data.reg.waktu_kunjungan);
               $('[name="waktu_booking_edit"]').val(data.reg.tanggal_booking + 'T' + data.reg.jam_booking);
               $('#modal-pop').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
               Notiflix.Block.remove('.blocking');
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }




      function detail(no_rkm_medis,tgl_periksa)
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
           url : "/ajax-data-booking-registrasi/" + no_rkm_medis + '/' + tgl_periksa,
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
               $('[name="tempat_lahir"]').val(data.pasien.tmp_lahir);
               $('[name="jenis_kelamin"]').val(jp);
               $('[name="tgl_lahir"]').val(data.pasien.tgl_lahir);
               $('[name="alamat"]').val(data.pasien.alamat);
               $('[name="tanggal_periksa"]').val(data.reg.tanggal_periksa);
               $('[name="tanggal_periksa_edit"]').val(data.reg.tanggal_periksa);
               $('[name="kd_dokter"]').val(data.reg.kd_dokter);
               $('[name="no_reg"]').val(data.reg.no_reg);
               $('[name="kd_pj"]').val(data.reg.kd_pj);
               $('[name="status"]').val(data.reg.status);
               $('[name="waktu_kunjungan"]').val(data.reg.waktu_kunjungan);
               $('[name="waktu_booking_edit"]').val(data.reg.tanggal_booking + 'T' + data.reg.jam_booking);
               $('#modal-pop').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Detail Data'); // Set title to Bootstrap modal title
            
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
           url = "/insert-booking-registrasi";
       } else {
           url = "/update-booking-registrasi";
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


   function hapus(no_rkm_medis,tgl_periksa) {

    Notiflix.Confirm.show(
  'Hapus Data',
  'Apakah anda yakin ingin menghapus data ini?',
  'Yes',
  'No',
  function() {
     Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });
  
    $.ajax({
        url : "/hapus-booking-registrasi/" + no_rkm_medis + '/' + tgl_periksa,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if(data.status == 'success') //if success close modal and reload ajax table
            {
                reload_table();
                Notiflix.Report.success(
                'Berhasil',
                'Data berhasil dihapus',
                'Okay');
            }
            else
            {
                Notiflix.Report.failure(
                 'Error',
                 data.data,
                 'Okay',
                );
            }
              Notiflix.Block.remove('.blocking');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            Notiflix.Block.remove('.blocking');
            Notiflix.Report.failure(
                 'Error',
                 'Data gagal dihapus',
                 'Okay',
                );
        }
    });
  },
  function() {
    Notiflix.Block.remove('.blocking');
  }
);
   }


  </script>

  