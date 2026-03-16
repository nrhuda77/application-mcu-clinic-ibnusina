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
           url : '/get-riwayat-penyakit-keluarga/' + no_rawat,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {

               $('.nama_pasien').val(data.pasien.nm_pasien);
               $('.no_rkm_medis').val(data.reg.no_rkm_medis);
               $('.no_reg').val(data.reg.no_reg);
               $('.no_rawat').val(data.reg.no_rawat);

               $('[name="bapak_darah_tinggi"]').val(data.riwayat.bapak_darah_tinggi);    
               $('[name="ibu_darah_tinggi"]').val(data.riwayat.ibu_darah_tinggi);  
               $('[name="kakek_darah_tinggi"]').val(data.riwayat.kakek_darah_tinggi);  
               $('[name="nenek_darah_tinggi"]').val(data.riwayat.nenek_darah_tinggi);
               
               $('[name="bapak_jantung"]').val(data.riwayat.bapak_jantung);    
               $('[name="ibu_jantung"]').val(data.riwayat.ibu_jantung);  
               $('[name="kakek_jantung"]').val(data.riwayat.kakek_jantung);  
               $('[name="nenek_jantung"]').val(data.riwayat.nenek_jantung);

               $('[name="bapak_diabet"]').val(data.riwayat.bapak_diabet);    
               $('[name="ibu_diabet"]').val(data.riwayat.ibu_diabet);  
               $('[name="kakek_diabet"]').val(data.riwayat.kakek_diabet);  
               $('[name="nenek_diabet"]').val(data.riwayat.nenek_diabet);


              //  $('[name="bapak_ginjal"]').val(data.riwayat.bapak_ginjal);    
              //  $('[name="ibu_ginjal"]').val(data.riwayat.ibu_ginjal);  
              //  $('[name="kakek_ginjal"]').val(data.riwayat.kakek_ginjal);  
              //  $('[name="nenek_ginjal"]').val(data.riwayat.nenek_ginjal);


              //  $('[name="bapak_liver"]').val(data.riwayat.bapak_liver);    
              //  $('[name="ibu_liver"]').val(data.riwayat.ibu_liver);  
              //  $('[name="kakek_liver"]').val(data.riwayat.kakek_liver);  
              //  $('[name="nenek_liver"]').val(data.riwayat.nenek_liver);


               $('[name="bapak_asma"]').val(data.riwayat.bapak_asma);    
               $('[name="ibu_asma"]').val(data.riwayat.ibu_asma);  
               $('[name="kakek_asma"]').val(data.riwayat.kakek_asma);  
               $('[name="nenek_asma"]').val(data.riwayat.nenek_asma);


              //  $('[name="bapak_alergi"]').val(data.riwayat.bapak_alergi);    
              //  $('[name="ibu_alergi"]').val(data.riwayat.ibu_alergi);  
              //  $('[name="kakek_alergi"]').val(data.riwayat.kakek_alergi);  
              //  $('[name="nenek_alergi"]').val(data.riwayat.nenek_alergi);


              //  $('[name="bapak_gangguan_mental"]').val(data.riwayat.bapak_gangguan_mental);    
              //  $('[name="ibu_gangguan_mental"]').val(data.riwayat.ibu_gangguan_mental);  
              //  $('[name="kakek_gangguan_mental"]').val(data.riwayat.kakek_gangguan_mental);  
              //  $('[name="nenek_gangguan_mental"]').val(data.riwayat.nenek_gangguan_mental);


              //  $('[name="bapak_lainya"]').val(data.riwayat.bapak_lainya);    
              //  $('[name="ibu_lainya"]').val(data.riwayat.ibu_lainya);  
              //  $('[name="kakek_lainya"]').val(data.riwayat.kakek_lainya);  
              //  $('[name="nenek_lainya"]').val(data.riwayat.nenek_lainya);
 
   
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
        url = "/update-riwayat-penyakit-keluarga";
       }else{
        url = "/insert-riwayat-penyakit-keluarga";
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
        url : "/delete-riwayat-penyakit-keluarga/" + no_rawat,
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