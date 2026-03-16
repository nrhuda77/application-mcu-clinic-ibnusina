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
           url : '/get-riwayat-kesehatan/' + no_rawat,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {

               $('.nama_pasien').val(data.pasien.nm_pasien);
               $('.no_rkm_medis').val(data.reg.no_rkm_medis);
               $('.no_reg').val(data.reg.no_reg);
               $('.no_rawat').val(data.reg.no_rawat);

                 $('[name="hepatitis"]').val(data.riwayat.hepatitis);    
               $('[name="hipertensi"]').val(data.riwayat.hipertensi); 
               $('[name="tbc"]').val(data.riwayat.tbc); 
               $('[name="jantung"]').val(data.riwayat.jantung); 
               $('[name="alergi"]').val(data.riwayat.alergi); 
               $('[name="asma"]').val(data.riwayat.asma); 
               $('[name="diabet"]').val(data.riwayat.diabet); 
               $('[name="wasir"]').val(data.riwayat.wasir); 
              //  $('[name="typhoid"]').val(data.riwayat.typhoid); 
              //  $('[name="hernia"]').val(data.riwayat.hernia); 
              //  $('[name="penyakit_kelamin"]').val(data.riwayat.penyakit_kelamin); 
               $('[name="operasi_pembedahan"]').val(data.riwayat.operasi_pembedahan); 
              //  $('[name="rawat_inap"]').val(data.riwayat.rawat_inap); 
               $('[name="konsumsi_obat"]').val(data.riwayat.konsumsi_obat); 
               $('[name="penyakit_saat_ini"]').val(data.riwayat.penyakit_saat_ini); 
              //  $('[name="penyakit_lainya"]').val(data.riwayat.penyakit_lainya); 
               $('[name="hamil"]').val(data.riwayat.hamil); 
              //  $('[name="keguguran"]').val(data.riwayat.keguguran); 
               $('[name="haid"]').val(data.riwayat.haid); 
              //  $('[name="haid_tidak_normal"]').val(data.riwayat.haid_tidak_normal); 

               $('[name="keterangan_hepatitis"]').val(data.riwayat.keterangan_hepatitis);    
               $('[name="keterangan_hipertensi"]').val(data.riwayat.keterangan_hipertensi); 
               $('[name="keterangan_tbc"]').val(data.riwayat.keterangan_tbc); 
               $('[name="keterangan_jantung"]').val(data.riwayat.keterangan_jantung); 
               $('[name="keterangan_alergi"]').val(data.riwayat.keterangan_alergi); 
               $('[name="keterangan_asma"]').val(data.riwayat.keterangan_asma); 
               $('[name="keterangan_diabet"]').val(data.riwayat.keterangan_diabet); 
               $('[name="keterangan_wasir"]').val(data.riwayat.keterangan_wasir); 
              //  $('[name="keterangan_typhoid"]').val(data.riwayat.keterangan_typhoid); 
              //  $('[name="keterangan_hernia"]').val(data.riwayat.keterangan_hernia); 
              //  $('[name="keterangan_penyakit_kelamin"]').val(data.riwayat.keterangan_penyakit_kelamin); 
               $('[name="keterangan_operasi_pembedahan"]').val(data.riwayat.keterangan_operasi_pembedahan); 
              //  $('[name="keterangan_rawat_inap"]').val(data.riwayat.keterangan_rawat_inap); 
               $('[name="keterangan_konsumsi_obat"]').val(data.riwayat.keterangan_konsumsi_obat); 
               $('[name="keterangan_penyakit_saat_ini"]').val(data.riwayat.keterangan_penyakit_saat_ini); 
              //  $('[name="keterangan_penyakit_lainya"]').val(data.riwayat.keterangan_penyakit_lainya); 
               $('[name="keterangan_hamil"]').val(data.riwayat.keterangan_hamil); 
              //  $('[name="keterangan_keguguran"]').val(data.riwayat.keterangan_keguguran); 
               $('[name="keterangan_haid"]').val(data.riwayat.keterangan_haid); 
              //  $('[name="keterangan_haid_tidak_normal"]').val(data.riwayat.keterangan_haid_tidak_normal); 
   
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
        url = "/update-riwayat-kesehatan";
       }else{
        url = "/insert-riwayat-kesehatan";
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
        url : "/delete-riwayat-kesehatan/" + no_rawat,
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