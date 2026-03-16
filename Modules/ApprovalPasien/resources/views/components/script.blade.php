<script>
 var table;
var save_method;

$(document).ready(function () {
 table =  $('#table').DataTable ({
 processing: true,
 serverSide: true,
 ajax: { 
   url: "/approval-pasien",
type:"POST",
data: function (d) {


  
                // Menambahkan data t_awal dan t_akhir ke request
                d._token = "{{ csrf_token() }}"; // Menyertakan token CSRF
                d.filter_pj = $('#filter_pj').val();// Ambil nilai dari input tanggal awal
                d.t_awal = $('#t_awal').val(); // Ambil nilai dari input tanggal awal
                d.t_akhir = $('#t_akhir').val(); // Ambil nilai dari input tanggal akhir
            }
},
columnDefs: [
 {
  targets: [ -1 , 0 ], //last column
  orderable: false, //set not orderable
 }
]
})
$('#table').DataTable().search('').draw();
})


 function reload_table() {
  table.ajax.reload();
    };

  function printErrorMsg (msg) {
         $.each( msg, function( key, value ) {
         console.log(key);
           $('.'+key+'_err').text(value);
         });
     }



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






$('#filter_pj').on('change', function() {
    reload_table(); // Memuat ulang DataTables saat input tanggal berubah
  });

  $('#t_awal').on('change', function() {
    reload_table(); // Memuat ulang DataTables saat input tanggal berubah
  });

 $('#t_akhir').on('change', function() {
    reload_table(); // Memuat ulang DataTables saat input tanggal berubah
  });


function add()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data '); // Set Title to Bootstrap modal title
    $('#photo-preview').hide(); // hide photo preview modal
     // $('#label-photo').text('Upload Photo'); // label photo upload

     $('#btnSave').show();
               $('#close').show();
}



function reload_table() {
 table.ajax.reload();
};
function printErrorMsg (msg) {
         $.each( msg, function( key, value ) {
         console.log(key);
           $('.'+key+'_err').text(value);
         });
     }


     function save() {


    
    var url = "/approve";
    var formData = new FormData($('#form')[0]);

    // Menampilkan overlay loading dan menyembunyikan konten
    Notiflix.Loading.circle();
    // Ajax untuk menambahkan data ke database
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data) {
      

    // document.querySelector('.content').classList.remove('show');
    Notiflix.Loading.remove();
            // Jika ada error
            if (data.error) {

                printErrorMsg(data.error);


                
                // Reload tabel dan notifikasi gagal
                reload_table();
                Notiflix.Report.failure(
'eror',
'Data Gagal Disimpan',
'Okay',
);
              
                // Menyembunyikan overlay loading dan menampilkan konten
               
            } else {
                // Jika tidak ada error, reload tabel dan notifikasi sukses
 
                reload_table();
           Notiflix.Report.success(
'Berhasil',
'Data Berhasil Disimpan',
'Okay',
);
             
                // Menyembunyikan overlay loading dan menampilkan konten
               
            }

          
            // Mengubah teks tombol dan mengaktifkan tombol
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled', false); 
        },
        error: function(jqXHR, textStatus, errorThrown) {
          Notiflix.Loading.remove();
          reload_table();
           Notiflix.Report.failure(
'Eror',
'Data Gagal Disimpan',
'Okay',
);
            // Mengubah teks tombol dan mengaktifkan tombol jika terjadi error
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled', false);
        }
    });
}


var rl = $('#role2').text();
var nmrl = $('#nmrole2').text();



$.ajax({
    url: '{{ route("ajax.kelurahan") }}',
    type: 'GET',
    success: function(data) {
        // Jika kamu mengembalikan data JSON


        console.log(data);
  
        // data.forEach(function(kelurahan) {
        //     $("#kd_kel").append('<option value="' + kelurahan.kd_kel + '">' + kelurahan.nm_kel + '</option>');
        // });
    },
    error: function(xhr, status, error) {
        console.error("Error: " + error);
    }
});

$("#kd_kel3").select2({
    dropdownParent: $("#modal_form3"),
    ajax: {
        url: '/ajax-kelurahan',
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // menggunakan params.term untuk mencari
            };
        },
        processResults: function (data) { 
            console.log(data);
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.nm_kel,
                        id: item.id
                    };
                })
            };
        },
        cache: true
    }
});

// Setelah item dipilih dari dropdown
$("#kd_kel3").on("select2:select", function (e) {
    var selectedData = e.params.data; // Data yang dipilih
    // Set nilai untuk elemen input lainnya berdasarkan data yang dipilih
    $('[name="kd_kel"]').val(selectedData.id);  // Set nilai untuk kd_kel
    $('#nkd_kel').val(selectedData.text);
});


$("#kd_kec3").on("select2:select", function (e) {
    var selectedData = e.params.data; // Data yang dipilih

    // Set nilai untuk elemen input lainnya berdasarkan data yang dipilih
    $('[name="kd_kec"]').val(selectedData.id); // Pastikan kd_kec ada di data yang dipilih
    $('#nkd_kec').val(selectedData.text);
});


$("#kd_kab3").on("select2:select", function (e) {
    var selectedData = e.params.data; // Data yang dipilih

    // Set nilai untuk elemen input lainnya berdasarkan data yang dipilih
    $('[name="kd_kab"]').val(selectedData.id); // Pastikan kd_kab ada di data yang dipilih
    $('#nkd_kab').val(selectedData.text);
});



$("#kd_kab3").select2({
    dropdownParent: $("#modal_form3"),
    ajax: {
        url: '/ajax-kabupaten',
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // gunakan params.term untuk search term
            };
        },
        processResults: function (data) { // ganti results dengan processResults
            console.log(data);
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.nm_kab,
                        id: item.id
                    };
                })
            };
        },
        cache: true
    }
});


$("#kd_kec3").select2({
    dropdownParent: $("#modal_form3"),
    ajax: {
        url: '/ajax-kecamatan',
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // gunakan params.term untuk search term
            };
        },
        processResults: function (data) { // ganti results dengan processResults
            console.log(data);
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.nm_kec,
                        id: item.id
                    };
                })
            };
        },
        cache: true
    }
});



function save2()
   {
       $('#btnSave').text('Menyimpan...'); //change button text
       $('#btnSave').attr('disabled',true); //set button disable 
       var url;
    
       if(save_method == 'add') {
           url = "/insert-pengajuan-pasien";
           var formData = new FormData($('#form')[0]);
       }  
       else  {
           url = "/edit-pengajuan-pasien";
           var formData = new FormData($('#form3')[0]);
       }
    
       // ajax adding data to database
      
       $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
           success: function(data)
           {
            
               if(data.error ) //if success close modal and reload ajax table
               {   printErrorMsg(data.error);
                reload_table();
                Notiflix.Report.failure(
'Error',
'Data Gagal Disimpan',
'Okay',
); 
               }
               else
               {
                $('#modal_form3').modal('hide');
                   reload_table();
                   Notiflix.Report.success(
'Berhasil',
'Data Berhasil Disimpan',
'Okay',
);

                   
               
               }

               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
           
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error adding / update data');
               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
           }
       });
   }


function tolaks(id)
   {
    $('#btnSave').hide();
       save_method = 'tolak';
        $('#form2')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
       $('#modal_form2').modal('show'); // show bootstrap modal
    
       //Ajax Load data from ajax
       $.ajax({
        url : "/ajax-detail-approval-pasien/" + id,
           type: "GET",
           dataType: "JSON",
    
           success: function(data)
           {

            $("#id").val(data[0].id);


               $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Tolak'); // Set title to Bootstrap modal title
              
             
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }



     function detail(id)
   {
       save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
   
       $('#btnSave').hide();
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-detail-approval-pasien/" + id,
           type: "GET",
           dataType: "JSON",
           
           success: function(data)
           {

            var jk;

         

            if (data.jk == "L" || data.jk == "l") {
              jk = "Laki - Laki";
            } else if(data.jk == "P" || data.jk == "p")  {
              jk = "Perempuan";
            }else{
              jk = "";
            }
               $('#id').val(data[0].id);
               $('#nm_pasien2').val(data[0].nm_pasien);
               $('#no_rkm_medis2').val(data[0].no_rkm_medis);
               $('#no_ktp2').val(data[0].no_ktp);   
               $('#jk2').val(data[0].jk);    
               $('#tmp_lahir2').val(data[0].tmp_lahir); 
               $('#tgl_lahir2').val(data[0].tgl_lahir); 
               $('#alamat2').val(data[0].alamat); 
               $('#nm_ibu2').val(data[0].nm_ibu); 
               $('#gol_darah2').val(data[0].gol_darah); 
               $('#pekerjaan2').val(data[0].pekerjaan); 

               $('#stts_nikah2').val(data[0].stts_nikah); 
               $('#agama2').val(data[0].agama); 

               $('#tgl_daftar2').val(data[0].tgl_daftar); 
               $('#no_tlp2').val(data[0].no_tlp); 
               $('#umur2').val(data[0].umur); 



               $('#pnd2').val(data[0].pnd);
               $('#keluarga2').val(data[0].keluarga);
               $('#namakeluarga2').val(data[0].namakeluarga);
               $('#kd_pj2').val(data[0].kd_pj);   
               $('#no_peserta2').val(data[0].no_peserta);    
               $('#kd_kel2').val(data[1].nm_kel); 
               $('#kd_kec2').val(data[2].nm_kec); 
               $('#kd_kab2').val(data[3].nm_kab); 
               $('#pekerjaanpj2').val(data[0].pekerjaanpj); 
               $('#kelurahanpj2').val(data[0].kelurahanpj); 
               $('#kecamatanpj2').val(data[0].kecamatanpj); 
               $('#kabupatenpj2').val(data[0].kabupatenpj); 
               $('#kabupatenpj2').val(data[0].kabupatenpj); 
               $('#alamatpj2').val(data[0].alamatpj); 

               $('#suku_bangsa2').val(data[0].suku_bangsa); 
               $('#bahasa_pasien2').val(data[0].bahasa_pasien); 
               $('#cacat_fisik2').val(data[0].cacat_fisik); 
               $('#kd_prop2').val(data[0].kd_prop); 
               $('#email2').val(data[0].email); 
               $('#nip2').val(data[0].nip); 
               $('#propinsipj2').val(data[0].propinsipj); 
               $('#perusahaan_pasien2').val(data[0].perusahaan_pasien); 


               $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Detail Data Pasien'); // Set title to Bootstrap modal title
              
             
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }

   function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}



   


      function edit(id)
   {
       save_method = 'update';
        $('#form3')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
       $('#modal_form3').modal('show'); // show bootstrap modal
       $('#btnSave').show();
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-detail-pengajuan-pasien/" + id,
           type: "GET",
           dataType: "JSON",
           
           success: function(data)
           {

        
         

               $('[name="id"]').val(data[0].id);
               $('[name="nm_pasien"]').val(data[0].nm_pasien);
               $('[name="no_rkm_medis"]').val(data[0].no_rkm_medis);
               $('[name="no_ktp"]').val(data[0].no_ktp);   
               $('[name="jk"]').val(data[0].jk);    
               $('[name="tmp_lahir"]').val(data[0].tmp_lahir); 
               $('[name="tgl_lahir"]').val(data[0].tgl_lahir); 
               $('[name="alamat"]').val(data[0].alamat); 
               $('[name="nm_ibu"]').val(data[0].nm_ibu); 
               $('[name="gol_darah"]').val(data[0].gol_darah); 
               $('[name="pekerjaan"]').val(data[0].pekerjaan); 

               $('[name="stts_nikah"]').val(data[0].stts_nikah); 
               $('[name="agama"]').val(data[0].agama); 

               $('[name="tgl_daftar"]').val(data[0].tgl_daftar); 
               $('[name="no_tlp"]').val(data[0].no_tlp); 
               $('[name="umur"]').val(data[0].umur); 



               $('[name="pnd"]').val(data[0].pnd);
               $('[name="keluarga"]').val(data[0].keluarga);
               $('[name="namakeluarga"]').val(data[0].namakeluarga);
               $('#kd_pj3').val(data[0].kd_pj);   
              //  $('#kd_pjf').val(nmrl);
               $('[name="no_peserta"]').val(data[0].no_peserta);    
               $('[name="kd_kel"]').val(data[0].kd_kel); 
               $('[name="kd_kec"]').val(data[0].kd_kec); 
               $('[name="kd_kab"]').val(data[0].kd_kab); 
               $('#nkd_kec').val(data[2].nm_kec);
               $('#nkd_kel').val(data[1].nm_kel);
               $('#nkd_kab').val(data[3].nm_kab);
               $('[name="pekerjaanpj"]').val(data[0].pekerjaanpj); 
               $('[name="kelurahanpj"]').val(data[0].kelurahanpj); 
               $('[name="kecamatanpj"]').val(data[0].kecamatanpj); 
               $('[name="kabupatenpj"]').val(data[0].kabupatenpj); 
               $('[name="kabupatenpj"]').val(data[0].kabupatenpj); 
               $('[name="alamatpj"]').val(data[0].alamatpj); 

               $('[name="suku_bangsa"]').val(data[0].suku_bangsa); 
               $('[name="bahasa_pasien"]').val(data[0].bahasa_pasien); 
               $('[name="cacat_fisik"]').val(data[0].cacat_fisik); 
               $('[name="kd_prop"]').val(data[0].kd_prop); 

               $('[name="email"]').val(data[0].email); 
               $('[name="nip"]').val(data[0].nip); 
               $('[name="propinsipj"]').val(data[0].propinsipj); 
               $('[name="perusahaan_pasien"]').val(data[0].perusahaan_pasien); 


               $('#modal_form3').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title3').text('Edit Data'); // Set title to Bootstrap modal title
              
             
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }

   function hapus(id) {
    // Menampilkan konfirmasi menggunakan Notiflix
    Notiflix.Confirm.show(
        'Hapus',
        'Anda yakin ingin menghapus data ini ?',
        'Yes',
        'No',
        function okCb() {
            // Melakukan request AJAX ke server untuk menghapus data
            $.ajax({
                url : "/delete-riwayat-approval-pasien/" + id,
                type: "GET",  // Menggunakan metode GET jika itu adalah API GET
                dataType: "JSON",  // Menyatakan bahwa kita mengharapkan response JSON
                data: {
                    _token: "{{ csrf_token() }}"  // Mengirimkan CSRF token untuk validasi
                },
                success: function(data) {
                    // Jika berhasil menghapus data
                    Notiflix.Notify.success('Data berhasil dihapus');
                    reload_table();  // Memuat ulang data setelah penghapusan
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Jika terjadi error
                    Notiflix.Notify.failure('Data gagal dihapus');
                    reload_table();  // Memuat ulang data meskipun terjadi error
                }
            });
        },
        function cancelCb() {
            // Tidak ada tindakan yang dilakukan jika user membatalkan
        }
    );
}
function tolak(id) {
    // Menampilkan konfirmasi menggunakan Notiflix
    Notiflix.Confirm.show(
        'Hapus',
        'Anda yakin ingin menolak data pasien ini ?',
        'Yes',
        'No',
        function okCb() {
            // Melakukan request AJAX ke server untuk menghapus data
            $.ajax({
                url : "/tolak-approval-pasien/" + id,
                type: "GET",  // Menggunakan metode GET jika itu adalah API GET
                dataType: "JSON",  // Menyatakan bahwa kita mengharapkan response JSON
                data: {
                    _token: "{{ csrf_token() }}"  // Mengirimkan CSRF token untuk validasi
                },
                success: function(data) {
                    // Jika berhasil menghapus data
                    Notiflix.Notify.success('Data berhasil dihapus');
                    reload_table();  // Memuat ulang data setelah penghapusan
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Jika terjadi error
                    Notiflix.Notify.failure('Data gagal dihapus');
                    reload_table();  // Memuat ulang data meskipun terjadi error
                }
            });
        },
        function cancelCb() {
            // Tidak ada tindakan yang dilakukan jika user membatalkan
        }
    );
}
</script>