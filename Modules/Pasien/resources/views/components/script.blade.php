 <script>
   var table;
   var save_method;

$(document).ready(function () {
 table =  $('#table').DataTable ({
 processing: true,
 serverSide: true,
 ajax: { 
   url: "/pasien",
type:"POST",
data: function (d) {
                // Menambahkan data t_awal dan t_akhir ke request
                d._token = "{{ csrf_token() }}"; // Menyertakan token CSRF
                d.role2 = $('#role2').text();// Ambil nilai dari input tanggal awal
                d.role = $('#role').text();
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
$('#table').DataTable().search('').draw();
})



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




// $("#kd_kel").load("{{ route('ajax.kelurahan') }}");

 

//         setInterval(() => {
//           $.ajax({
//             url: '/ajax-norkm/',
//             type: 'GET',
//             dataType: 'json',
//         })
//         .done(function(data) {



//             // $("#nama_barang_real").val(data.nama_barang);
//             $("#no_rkm_medis").val(data);
     
//         })
//         .fail(function() {
//             console.log("error");
//         })
//         .always(function() {
//             console.log("complete");
//         });
// }, 100);
       

      
  



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

$('#t_awal').on('change', function() {
    reload_table(); // Memuat ulang DataTables saat input tanggal berubah
  });

 $('#t_akhir').on('change', function() {
    reload_table(); // Memuat ulang DataTables saat input tanggal berubah
  });

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
           url = "/insert-pasien";
           var formData = new FormData($('#form')[0]);
       }  
       else  {
           url = "/edit-pasien";
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
                 'Data gagal diinput',
                 'Okay',
                );
               }
               else
               {
                $('#modal_form').modal('hide');
                   reload_table();
                   Notiflix.Report.success(
                'Berhasil',
                'Data berhasil diubah',
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




     function detail(no_rkm_medis)
   {
       save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
       $('#modal_form').modal('show'); // show bootstrap modal
    
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-detail-pasien/" + no_rkm_medis,
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
               $('[name="id"]').val(data.id);
               $('[name="nm_pasien"]').val(data.nm_pasien);
               $('[name="no_rkm_medis"]').val(data.no_rkm_medis);
               $('[name="no_ktp"]').val(data.no_ktp);   
               $('[name="jk"]').val(data.jk);    
               $('[name="tmp_lahir"]').val(data.tmp_lahir); 
               $('[name="tgl_lahir"]').val(data.tgl_lahir); 
               $('[name="alamat"]').val(data.alamat); 
               $('[name="nm_ibu"]').val(data.nm_ibu); 
               $('[name="gol_darah"]').val(data.gol_darah); 
               $('[name="pekerjaan"]').val(data.pekerjaan); 

               $('[name="stts_nikah"]').val(data.stts_nikah); 
               $('[name="agama"]').val(data.agama); 

               $('[name="tgl_daftar"]').val(data.tgl_daftar); 
               $('[name="no_tlp"]').val(data.no_tlp); 
               $('[name="umur"]').val(data.umur); 



               $('[name="pnd"]').val(data.pnd);
               $('[name="keluarga"]').val(data.keluarga);
               $('[name="namakeluarga"]').val(data.namakeluarga);
               $('[name="kd_pj"]').val(data.kd_pj);   
               $('[name="no_peserta"]').val(data.no_peserta);    
               $('[name="kd_kel"]').val(data.kd_kel); 
               $('[name="kd_kec"]').val(data.kd_kec); 
               $('[name="kd_kab"]').val(data.kd_kab); 
               $('[name="pekerjaanpj"]').val(data.pekerjaanpj); 
               $('[name="kelurahanpj"]').val(data.kelurahanpj); 
               $('[name="kecamatanpj"]').val(data.kecamatanpj); 
               $('[name="kabupatenpj"]').val(data.kabupatenpj); 
               $('[name="kabupatenpj"]').val(data.kabupatenpj); 
               $('[name="alamatpj"]').val(data.alamatpj); 

               $('[name="suku_bangsa"]').val(data.suku_bangsa); 
               $('[name="bahasa_pasien"]').val(data.bahasa_pasien); 
               $('[name="cacat_fisik"]').val(data.cacat_fisik); 

               $('[name="email"]').val(data.email); 
               $('[name="nip"]').val(data.nip); 
               $('[name="propinsipj"]').val(data.propinsipj); 



               $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Detail Data Pasien'); // Set title to Bootstrap modal title
              
             
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }


   function edit(no_rkm_medis)
   {
       save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
       $('#modal_form').modal('show'); // show bootstrap modal
    
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-detail-pasien/" + no_rkm_medis,
           type: "GET",
           dataType: "JSON",
           
           success: function(data)
           {

        
         

               $('[name="id"]').val(data.id);
               $('[name="nm_pasien"]').val(data.nm_pasien);
               $('[name="no_rkm_medis"]').val(data.no_rkm_medis);
               $('[name="no_ktp"]').val(data.no_ktp);   
               $('[name="jk"]').val(data.jk);    
               $('[name="tmp_lahir"]').val(data.tmp_lahir); 
               $('[name="tgl_lahir"]').val(data.tgl_lahir); 
               $('[name="alamat"]').val(data.alamat); 
               $('[name="nm_ibu"]').val(data.nm_ibu); 
               $('[name="gol_darah"]').val(data.gol_darah); 
               $('[name="pekerjaan"]').val(data.pekerjaan); 

               $('[name="stts_nikah"]').val(data.stts_nikah); 
               $('[name="agama"]').val(data.agama); 

               $('[name="tgl_daftar"]').val(data.tgl_daftar); 
               $('[name="no_tlp"]').val(data.no_tlp); 
               $('[name="umur"]').val(data.umur); 



               $('[name="pnd"]').val(data.pnd);
               $('[name="keluarga"]').val(data.keluarga);
               $('[name="namakeluarga"]').val(data.namakeluarga);
               $('[name="kd_pj"]').val(data.kd_pj);   
               $('[name="no_peserta"]').val(data.no_peserta);    
               $('[name="kd_kel"]').val(data.kd_kel); 
               $('[name="kd_kec"]').val(data.kd_kec); 
               $('[name="kd_kab"]').val(data.kd_kab); 
               $('[name="pekerjaanpj"]').val(data.pekerjaanpj); 
               $('[name="kelurahanpj"]').val(data.kelurahanpj); 
               $('[name="kecamatanpj"]').val(data.kecamatanpj); 
               $('[name="kabupatenpj"]').val(data.kabupatenpj); 
               $('[name="kabupatenpj"]').val(data.kabupatenpj); 
               $('[name="alamatpj"]').val(data.alamatpj); 

               $('[name="suku_bangsa"]').val(data.suku_bangsa); 
               $('[name="bahasa_pasien"]').val(data.bahasa_pasien); 
               $('[name="cacat_fisik"]').val(data.cacat_fisik); 

               $('[name="email"]').val(data.email); 
               $('[name="nip"]').val(data.nip); 
               $('[name="propinsipj"]').val(data.propinsipj); 



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
        url : "/delete-thoraks-abdomen/" + id,
        type: "GET",
        dataType: "JSON",
        data: {
           "_token" : "{{csrf_token()}}"
             },

           }),
                  reload_table();
            Swal.fire({
                 icon: 'success',
                 title: 'Berhasil di Hapus',
                 showConfirmButton: false,
                 timer: 1500
                   })
            Lobibox.notify('warning', {
                 size: 'mini',
                 msg: 'Data berhasil Dihapus'
             });

         }
       })
      }

</script>
