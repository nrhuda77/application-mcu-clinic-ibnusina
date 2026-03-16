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
               $('#no_reg').val(data.reg.no_reg);
               $('[name="no_rawat"]').val(data.reg.no_rawat);

          // show bootstrap modal when complete loaded
               $('.modal-title').text('Pemeriksaan Non Lab'); // Set title to Bootstrap modal title
               $('#modal-pop').modal('show'); 
               Notiflix.Block.remove('.blocking');
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
}


function edit(id)
  {
      save_method = 'update';
       $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal-pop').modal('show'); // show bootstrap modal
   
      //Ajax Load data from ajax
      $.ajax({
          url : "/get-pemeriksaan-nonlab/" + id,
          type: "GET",
          dataType: "JSON",
          
          success: function(data)
          {

              $('.nama_pasien').val(data.pasien.nm_pasien);
              $('[name="no_rkm_medis"]').val(data.reg.no_rkm_medis);
              $('#no_reg').val(data.reg.no_reg);
              $('[name="no_rawat"]').val(data.reg.no_rawat);
            $("#usg").val(data.pemeriksaan.usg);
            $("#ekg").val(data.pemeriksaan.ekg);
            $("#radiologi").val(data.pemeriksaan.radiologi);
            $("#spirometri").val(data.pemeriksaan.spirometri);
            $("#audiometri").val(data.pemeriksaan.audiometri);
            $("#treadmil").val(data.pemeriksaan.treadmil);
            $("#napfa").val(data.pemeriksaan.napfa);
              $('.modal-title').text('Edit Pemeriksaan Non Lab'); // Set title to Bootstrap modal title
             
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
      var url;
   
      if(save_method == 'add') {
          url = "/insert-pemeriksaan-nonlab";
          var formData = new FormData($('#form')[0]);
      }  
      else {
          url = "/update-pemeriksaan-nonlab";
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
               
                  Notiflix.Report.failure(
                        'Error',
                        'Data gagal di Simpan',
                        'Okay'
                        
                    ); 
              }
              else
              {

               $('#modal-pop').modal('hide');
                
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
               
              $('#btnSave').attr('disabled',false); //set button enable 
               
   
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
           Notiflix.Report.failure(
                        'Error',
                        'Data gagal di Simpan',
                        'Okay'
                    ); 
              $('#btnSave').text('Simpan'); //change button text
               
              $('#btnSave').attr('disabled',false); //set button enable 
               
   
          }
      });
  }
function hapus(id) {
    Notiflix.Confirm.show(
        'Konfirmasi',
        'Yakin Hapus Data ?',
        'Yes',
        'No',
     
        function okCb() {
          Notiflix.Loading.circle(),
            $.ajax({
              url : "/delete-pemeriksaan-nonlab/" + id,
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


 
    function alerts(){
       Notiflix.Report.warning(
                'Warning',
                'Data Sudah diinput ,Silahkan edit atau hapus',
                'Okay');              
   }

       function alerts2(){
       Notiflix.Report.warning(
                'Warning',
                'Data Tidak ada ,Silahkan Input Dulu',
                'Okay');              
   }


</script>