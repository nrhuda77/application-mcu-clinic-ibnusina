<script>



function add(no_rawat)
{
   save_method = 'add';
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
           url :'/ajax-data-registrasi-kuisoner/' + no_rawat,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {
               $('.nama_pasien').val(data.pasien.nm_pasien);
               $('[name="no_rkm_medis"]').val(data.reg.no_rkm_medis);
               $('[name="no_reg"]').val(data.reg.no_reg);
               $('[name="no_rawat"]').val(data.reg.no_rawat);

          // show bootstrap modal when complete loaded
               $('.modal-title').text('Upload Gambar'); // Set title to Bootstrap modal title
               $('#modal-pop').modal('show'); 
               
               Notiflix.Block.remove('.blocking');
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
}

function edit(lokasi_file)
  {
      save_method = 'update';
       $('#form_edit')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal-pop-edit').modal('show'); // show bootstrap modal
   
      //Ajax Load data from ajax
      $.ajax({
          url : "/get-upload-gambar-pemeriksaan/" + lokasi_file,
          type: "GET",
          dataType: "JSON",
          
          success: function(data)
          {

              $('.nama_pasien').val(data.pasien.nm_pasien);
              $('[name="no_rkm_medis"]').val(data.reg.no_rkm_medis);
              $('[name="no_reg"]').val(data.reg.no_reg);
              $('[name="no_rawat"]').val(data.reg.no_rawat);
              $('[name="jenis"]').val(data.gambar.kode);
              $('[name="lokasi_file"]').val(data.gambar.lokasi_file);
              $('#modal-pop-edit').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Upload Gambar'); // Set title to Bootstrap modal title
             
              $('#close').hide();
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
      $('#btnSave2').text('Menyimpan...'); //change button text
      $('#btnSave2').attr('disabled',true); //set button disable
      var url;
   
      if(save_method == 'add') {
          url = "/insert-upload-gambar-pemeriksaan";
          var formData = new FormData($('#form')[0]);
          let formDataz = formData ;
        
          // ambil semua dropzones dari window.dropzones (global)
  Object.values(window.dropzones).forEach((dz) => {
  const dropzoneId = dz.element.id || '(no id)';
  const index = dropzoneId.startsWith('dropzone-dynamic-')
  ? dropzoneId.replace('dropzone-dynamic-', '')
  : 0; // default index

  console.log('dropzoneId:', dropzoneId, '-> index:', index);

  dz.files.forEach((file) => {
    formDataz.append(`foto[${index}]`, file);
  });
});

      }  
      else {
          url = "/update-upload-gambar-pemeriksaan";
          var formData = new FormData($('#form_edit')[0]);
          let formDataz = formData ;

           Object.values(window.dropzones).forEach((dz, index) => {
                 dz.files.forEach((file) => {
                        formDataz.append(`foto`, file);
                 });
          });
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
               
                  Notiflix.Report.failure(
                        'Error',
                        'Data gagal di Simpan',
                        'Okay'
                        
                    ); 
              }
              else
              {

               $('#modal-pop-edit').modal('hide');
                
                   Notiflix.Report.success(
                      'Berhasil',
                      'Data Berhasil di Simpan',
                      'Okay',
                      function () {
                            window.location.reload();
                        }
                   );
            
              }

              $('#btnSave').text('Simpan'); //change button text
               $('#btnSave2').text('Simpan'); //change button text
              $('#btnSave').attr('disabled',false); //set button enable 
              $('#btnSave2').attr('disabled',false); //set button enable 
   
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
             printErrorMsg(jqXHR.responseJSON.errors);
           Notiflix.Report.failure(
                        'Error',
                        'Data gagal di Simpan',
                        'Okay'
                    ); 
              $('#btnSave').text('Simpan'); //change button text
               $('#btnSave2').text('Simpan'); //change button text
              $('#btnSave').attr('disabled',false); //set button enable 
              $('#btnSave2').attr('disabled',false); //set button enable 
   
          }
      });
  }
function hapus(lokasi_file) {
    Notiflix.Confirm.show(
        'Konfirmasi',
        'Yakin Hapus Data ?',
        'Yes',
        'No',
     
        function okCb() {
          Notiflix.Loading.circle(),
            $.ajax({
              url : "/delete-upload-gambar-pemeriksaan/" + lokasi_file,
                type: "GET",
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    
                    Notiflix.Loading.remove();
                    Notiflix.Report.success(
                        'Berhasil',
                        'Data Berhasil dihapus',
                        'Okay',
                        function () {
                            window.location.reload();
                        }
                    );
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  Notiflix.Loading.remove();
                    Notiflix.Report.failure(
                        'Error',
                        'Data gagal dihapus',
                        'Okay'
                    );
                    $('#btnSave').text('Simpan'); // change button text
                    $('#btnSave').attr('disabled', false); // enable button
                }
            });
        },
        function cancelCb() {
    
        }
    );
}


     function hapus_all(no_rawat) {
    Notiflix.Confirm.show(
        'Konfirmasi',
        'Yakin Hapus Semua Data ?',
        'Yes',
        'No',
     
        function okCb() {
          Notiflix.Loading.circle(),
            $.ajax({
              url : "/delete-upload-gambar-pemeriksaan-all/" + no_rawat,
                type: "GET",
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    
                    Notiflix.Loading.remove();
                    Notiflix.Report.success(
                        'Berhasil',
                        'Semua Data Berhasil dihapus',
                        'Okay',
                        function () {
                            window.location.reload();
                        }
                    );
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  Notiflix.Loading.remove();
                    Notiflix.Report.failure(
                        'Error',
                        'Data gagal dihapus',
                        'Okay'
                    );
                    $('#btnSave').text('Simpan'); // change button text
                    $('#btnSave').attr('disabled', false); // enable button
                    $('#btnSave2').text('Menyimpan...'); //change button text
                    $('#btnSave2').attr('disabled',true); //set button disable
                }
            });
        },
        function cancelCb() {
    
        }
    );
}

    function alerts(){
       Notiflix.Report.warning(
                'Warning',
                'Data Tidak ada ,Silahkan Input Dulu',
                'Okay');              
   }

   function printErrorMsg (msg) {
         $.each( msg, function( key, value ) {
         console.log(key);
           $('.'+key+'_err').text(value);
         });
     }



</script>