<script type="text/javascript">

    var url_kategori = '';

      function kategori(no_rawat)
   {

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

      url_kategori = '/insert-registrasi-kategori'

       $('#form_kategori')[0].reset(); // reset form on modals
   
        
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-data-registrasi-kuisoner/" + no_rawat,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {

                 
                 $('[name="nama_pasien"]').val(data.pasien.nama_pasien);
                 $('[name="no_rkm_medis"]').val(data.pasien.no_rkm_medis);
                 $('[name="no_rawat"]').val(data.reg.no_rawat);

   
          // show bootstrap modal when complete loaded

               $('#modal-pop-kategori').modal('show'); 
               Notiflix.Block.remove('.blocking');
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }



    function update_kategori(no_rawat)
   {

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

      url_kategori = '/update-registrasi-kategori'

       $('#form_kategori')[0].reset(); // reset form on modals
   
        
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-data-Kategori/" + no_rawat,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {


                 $('[name="nama_pasien"]').val(data.pasien.nama_pasien);
                 $('[name="no_rkm_medis"]').val(data.pasien.no_rkm_medis);
                 $('[name="no_rawat"]').val(data.reg.no_rawat);
                 $('[name="kategori"]').val(data.kategori.kategori);

   
          // show bootstrap modal when complete loaded

               $('#modal-pop-kategori').modal('show'); 
               Notiflix.Block.remove('.blocking');
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }





function printErrorMsg (msg) {
         $.each( msg, function( key, value ) {
         console.log(key);
           $('.'+key+'_err').text(value);
         });
     }



function save_kategori()

   {
    
       $('#btnSave3').text('Menyimpan...'); //change button text
       $('#btnSave3').attr('disabled',true); //set button disable 

         Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });
    
        
      
       // ajax adding data to database
       $.ajax({
           url : url_kategori,
           type: "POST",
           data: $('#form_kategori').serialize(),
           dataType: "JSON",
           success: function(data)
           {
            console.log(data);
            
    
               if(data.status == 'success') //if success close modal and reload ajax table
               {
                   $('#modal-pop-kategori').modal('hide');
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
               $('#btnSave3').text('Simpan'); //change button text
               $('#btnSave3').attr('disabled',false); //set button enable 
    
    
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
               $('#btnSave3').text('Simpan'); //change button text
               $('#btnSave3').attr('disabled',false); //set button enable 
    
           }
       });
   }


  </script>