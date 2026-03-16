<script type="text/javascript">

      var save_method = ''

      function kuisoner(no_rawat)
   {

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

       $('#form_kuisoner')[0].reset(); // reset form on modals
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
               $('.no_rkm_medis').val(data.reg.no_rkm_medis);
               $('.no_reg').val(data.reg.no_reg);
               $('.no_rawat').val(data.reg.no_rawat);
                

   
          // show bootstrap modal when complete loaded
               $('.modal-title').text('Kuisoner'); // Set title to Bootstrap modal title
               $('#modal-pop-kuisoner').modal('show'); 
               Notiflix.Block.remove('.blocking');
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }



  function edit(no_rawat)
   {

      save_method = 'update';

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

       $('#form_kuisoner')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
        
       //Ajax Load data from ajax
       $.ajax({
           url : '/get-riwayat-paparan/' + no_rawat,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {

               $('.nama_pasien').val(data.pasien.nm_pasien);
               $('.no_rkm_medis').val(data.reg.no_rkm_medis);
               $('.no_reg').val(data.reg.no_reg);
               $('.no_rawat').val(data.reg.no_rawat);

                 $('[name="terpapar_bising"]').val(data.riwayat.terpapar_bising);    
               $('[name="terpapar_suhu_ekstrim_dingin"]').val(data.riwayat.terpapar_suhu_ekstrim_dingin); 
               $('[name="terpapar_suhu_ekstrim_panas"]').val(data.riwayat.terpapar_suhu_ekstrim_panas); 
               $('[name="terpapar_getaran"]').val(data.riwayat.terpapar_getaran); 
               $('[name="terpapar_debu"]').val(data.riwayat.terpapar_debu); 
               $('[name="terpapar_zat_kimia"]').val(data.riwayat.terpapar_zat_kimia); 
               $('[name="terpapar_radiasi"]').val(data.riwayat.terpapar_radiasi); 
              //  $('[name="terpapar_komputer"]').val(data.riwayat.terpapar_komputer); 
              //  $('[name="terpapar_gerakan_berulang"]').val(data.riwayat.terpapar_gerakan_berulang); 
              //  $('[name="terpapar_mendorong_menarik"]').val(data.riwayat.terpapar_mendorong_menarik); 
              //  $('[name="terpapar_angkat_beban_25"]').val(data.riwayat.terpapar_angkat_beban_25); 
              //  $('[name="terpapar_lainnya"]').val(data.riwayat.terpapar_lainnya); 

              
               $('[name="lama_terpapar_bising"]').val(data.riwayat.lama_terpapar_bising);    
               $('[name="lama_terpapar_suhu_ekstrim_dingin"]').val(data.riwayat.lama_terpapar_suhu_ekstrim_dingin); 
               $('[name="lama_terpapar_suhu_ekstrim_panas"]').val(data.riwayat.lama_terpapar_suhu_ekstrim_panas); 
               $('[name="lama_terpapar_getaran"]').val(data.riwayat.lama_terpapar_getaran); 
               $('[name="lama_terpapar_debu"]').val(data.riwayat.lama_terpapar_debu); 
               $('[name="lama_terpapar_zat_kimia"]').val(data.riwayat.lama_terpapar_zat_kimia); 
               $('[name="lama_terpapar_radiasi"]').val(data.riwayat.lama_terpapar_radiasi); 
              //  $('[name="lama_terpapar_komputer"]').val(data.riwayat.lama_terpapar_komputer); 
              //  $('[name="lama_terpapar_gerakan_berulang"]').val(data.riwayat.lama_terpapar_gerakan_berulang); 
              //  $('[name="lama_terpapar_mendorong_menarik"]').val(data.riwayat.lama_terpapar_mendorong_menarik); 
              //  $('[name="lama_terpapar_angkat_beban_25"]').val(data.riwayat.lama_terpapar_angkat_beban_25); 
              //  $('[name="lama_terpapar_lainnya"]').val(data.riwayat.lama_terpapar_lainnya); 
   
          // show bootstrap modal when complete loaded
               $('.modal-title').text('Kuisoner'); // Set title to Bootstrap modal title
               $('#modal-pop-kuisoner').modal('show'); 
               Notiflix.Block.remove('.blocking');
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }


function save_kuisoner()

   {
    
       $('#btnSave').text('Menyimpan...'); //change button text
       $('#btnSave').attr('disabled',true); //set button disable 
       var url

       if(save_method == 'update'){
        url = "/update-riwayat-paparan";
       }else{
        url = "/insert-riwayat-paparan";
       }

         Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });
    
        
      
       // ajax adding data to database
       $.ajax({
           url : url,
           type: "POST",
           data: $('#form_kuisoner').serialize(),
           dataType: "JSON",
           success: function(data)
           {
            console.log(data);
            
    
               if(data.status == 'success') //if success close modal and reload ajax table
               {
                   $('#modal-pop-kuisoner').modal('hide');
                   
                   Notiflix.Report.success(
                'Berhasil',
                'Data berhasil diinput',
                'Okay',
             () => window.location.reload()

            );
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

      function hapus(no_rawat) {

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
        url : "/delete-riwayat-paparan/" + no_rawat,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if(data.status == 'success') //if success close modal and reload ajax table
            {
                
                Notiflix.Report.success(
                'Berhasil',
                'Data berhasil dihapus',
                'Okay',
               () => window.location.reload()
   
            );
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