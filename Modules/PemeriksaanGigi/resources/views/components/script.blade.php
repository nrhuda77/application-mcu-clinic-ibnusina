<script>

let inputCount = 1;

$('#add-input').click(function() {
   inputCount++;
   $('#urutan_gg').append('<input type="text" class="form-control mt-2" name="urutan[]" placeholder="Urutan no">');

   $('#urutan_posisi').append(`<select class="form-select mt-2" name="posisi[]">
                          <option value="">Pilih...</option>
                          <option value="Kanan Atas">Kanan Atas</option> 
                          <option value="Kiri Atas">Kiri Atas</option> 
                          <option value="Kanan Bawah">Kanan Bawah</option> 
                          <option value="Kiri Bawah">Kiri Bawah</option> 
                          </select>`);

   $('#urutan_jenis').append(` <select class="form-select mt-2" name="jenis[]" id="">
                       <option value="">Pilih...</option>
                       <option value="Caries">Caries</option> 
                       <option value="Impaksi">Impaksi</option> 
                       <option value="Karang">Karang</option> 
                       <option value="Missing">Missing</option> 
                       <option value="Palsu">Palsu</option> 
                       <option value="Plaque">Plaque</option> 
                       <option value="Pulpa">Pulpa</option> 
                       <option value="Radix">Palsu</option> 
                       
                     </select>`)
});



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
               $('.modal-title').text('Pemeriksaan Gigi'); // Set title to Bootstrap modal title
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
       $('#form_edit')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal-pop-edit').modal('show'); // show bootstrap modal
   
      //Ajax Load data from ajax
      $.ajax({
          url : "/get-pemeriksaan-gigi/" + id,
          type: "GET",
          dataType: "JSON",
          
          success: function(data)
          {

              $('.nama_pasien').val(data.pasien.nm_pasien);
              $('[name="no_rkm_medis"]').val(data.reg.no_rkm_medis);
              $('[name="no_reg"]').val(data.reg.no_reg);
              $('[name="no_rawat"]').val(data.reg.no_rawat);
               $('[name="id"]').val(data.gigi.id);
              $('[name="posisi"]').val(data.gigi.posisi);
              $('[name="urutan"]').val(data.gigi.urutan);
              $('[name="jenis"]').val(data.gigi.jenis);
              $('#modal-pop-edit').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Pemeriksaan Gigi'); // Set title to Bootstrap modal title
             
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
          url = "/insert-pemeriksaan-gigi";
          var formData = new FormData($('#form')[0]);
      }  
      else {
          url = "/update-pemeriksaan-gigi";
          var formData = new FormData($('#form_edit')[0]);
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
function hapus(id) {
    Notiflix.Confirm.show(
        'Konfirmasi',
        'Yakin Hapus Data ?',
        'Yes',
        'No',
     
        function okCb() {
          Notiflix.Loading.circle(),
            $.ajax({
              url : "/delete-pemeriksaan-gigi/" + id,
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
                    $('#btnSave2').text('Menyimpan...'); //change button text
                    $('#btnSave2').attr('disabled',true); //set button disable
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
              url : "/delete-pemeriksaan-gigi-all/" + no_rawat,
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


</script>