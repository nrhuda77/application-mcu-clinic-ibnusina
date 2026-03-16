
  <script>
    var table;
var save_method;

$(document).ready(function () {
 table =  $('#table').DataTable ({
 processing: true,
 serverSide: true,
 ajax: { 
   url: "/pengajuan-pasien",
type:"POST",
data: function (d) {
                // Menambahkan data t_awal dan t_akhir ke request
                d._token = "{{ csrf_token() }}"; // Menyertakan token CSRF
                d.role2 = $('#role2').text();// Ambil nilai dari input tanggal awal
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
})
$('#table').DataTable().search('').draw();
})

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

$("#kd_kel").select2({
    dropdownParent: $("#modal_form"),
    ajax: {
        url: '/ajax-kelurahan',
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
                        text: item.nm_kel,
                        id: item.id
                    };
                })
            };
        },
        cache: true
    }
});


$("#kd_kab").select2({
    dropdownParent: $("#modal_form"),
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

$('#t_awal').on('change', function() {
    reload_table(); // Memuat ulang DataTables saat input tanggal berubah
  });

 $('#t_akhir').on('change', function() {
    reload_table(); // Memuat ulang DataTables saat input tanggal berubah
  });

$("#kd_kec").select2({
    dropdownParent: $("#modal_form"),
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
  

function add()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    var myModal = new bootstrap.Modal(document.getElementById('modal_form'), {
        backdrop: 'static', // Mengatur agar modal tidak menutup saat diklik di luar
        keyboard: false // Mengatur agar modal tidak menutup saat menekan tombol Escape
    });
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data '); // Set Title to Bootstrap modal title
    $('#photo-preview').hide(); // hide photo preview modal
     // $('#label-photo').text('Upload Photo'); // label photo upload
     $('#kd_pj').val(rl);   
     $('#kd_pjf').val(nmrl); 
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


     function save()
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
           var formData = new FormData($('#form')[0]);
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
                $('#modal_form').modal('hide');
                   reload_table();


 Notiflix.Report.success(
                'Berhasil',
                'Data berhasil disimpan',
                'Okay');
                   
               
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





     function detail(id)
   {
       save_method = 'update';
        $('#form2')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
       $('#modal_form2').modal('show'); // show bootstrap modal
    
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-detail-pengajuan-pasien/" + id,
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
               $('#kd_pj2').val(rl);   
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


               $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Detail Data Pasien'); // Set title to Bootstrap modal title
              
             
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }

   
// Setelah item dipilih dari dropdown
$("#kd_kel").on("select2:select", function (e) {
    var selectedData = e.params.data; // Data yang dipilih
    // Set nilai untuk elemen input lainnya berdasarkan data yang dipilih
    $('[name="kd_kel"]').val(selectedData.id);  // Set nilai untuk kd_kel
    $('#nkd_kel').val(selectedData.text);
});


$("#kd_kec").on("select2:select", function (e) {
    var selectedData = e.params.data; // Data yang dipilih

    // Set nilai untuk elemen input lainnya berdasarkan data yang dipilih
    $('[name="kd_kec"]').val(selectedData.id); // Pastikan kd_kec ada di data yang dipilih
    $('#nkd_kec').val(selectedData.text);
});


$("#kd_kab").on("select2:select", function (e) {
    var selectedData = e.params.data; // Data yang dipilih

    // Set nilai untuk elemen input lainnya berdasarkan data yang dipilih
    $('[name="kd_kab"]').val(selectedData.id); // Pastikan kd_kab ada di data yang dipilih
    $('#nkd_kab').val(selectedData.text);
});


   function edit(id)
   {
       save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
       $('#modal_form').modal('show'); // show bootstrap modal
    
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
               $('#nkd_kec').val(data[2].nm_kec);
               $('#nkd_kel').val(data[1].nm_kel);
               $('#nkd_kab').val(data[3].nm_kab);


               $('[name="pnd"]').val(data[0].pnd);
               $('[name="keluarga"]').val(data[0].keluarga);
               $('[name="namakeluarga"]').val(data[0].namakeluarga);
               $('#kd_pj').val(rl);   
               $('#kd_pjf').val(nmrl);
               $('[name="no_peserta"]').val(data[0].no_peserta);    
               $('[name="kd_kel"]').val(data[0].kd_kel); 
               $('[name="kd_kec"]').val(data[0].kd_kec); 
               $('[name="kd_kab"]').val(data[0].kd_kab); 
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


               $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Detail Data Pasien'); // Set title to Bootstrap modal title
              
             
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }



   function hapus(id){
 
 Swal.fire({
 title: 'Are you sure?',
 text: "You won't be able to revert this!",
 icon: 'warning',
 showCancelButton: true,
 confirmButtonColor: '#3085d6',
 cancelButtonColor: '#d33',
 confirmButtonText: 'Yes, delete it!'
 }).then((result) => {

 if (result.isConfirmed) {
         $.ajax({
        url : "/delete-riwayat-approval-pasien/" + id,
        type: "GET",
        dataType: "JSON",
        data: {
           "_token" : "{{csrf_token()}}"
             },

           }),
                  reload_table();
    
 Notiflix.Report.success(
                'Berhasil',
                'Data berhasil dihapus',
                'Okay');
                   

         }
       })
      }

</script>