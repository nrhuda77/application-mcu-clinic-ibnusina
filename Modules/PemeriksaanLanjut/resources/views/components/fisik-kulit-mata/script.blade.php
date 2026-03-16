<script type="text/javascript">

      var save_method = ''

      function add(no_rawat)
   {

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
               $('.no_rkm_medis').val(data.reg.no_rkm_medis);
               $('.no_reg').val(data.reg.no_reg);
               $('.no_rawat').val(data.reg.no_rawat);
                

   
          // show bootstrap modal when complete loaded
               $('.modal-title').text('Fisik Kulit Mata'); // Set title to Bootstrap modal title
               $('#modal-pop').modal('show'); 
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

       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
        
       //Ajax Load data from ajax
       $.ajax({
           url : '/get-fisik-kulit-mata/' + no_rawat,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {

               $('.nama_pasien').val(data.pasien.nm_pasien);
               $('.no_rkm_medis').val(data.reg.no_rkm_medis);
               $('.no_reg').val(data.reg.no_reg);
               $('.no_rawat').val(data.reg.no_rawat);

            $("#kulit").val(data.pemeriksaan.kulit);
            $("#buta_warna").val(data.pemeriksaan.buta_warna);
            $("#kaca_mata").val(data.pemeriksaan.kaca_mata);
            $("#visus_kanan").val(data.pemeriksaan.visus_kanan);
            $("#visus_kiri").val(data.pemeriksaan.visus_kiri);
            $("#jaeger_test").val(data.pemeriksaan.jaeger_test);
            $("#bola_mata").val(data.pemeriksaan.bola_mata);
            // $("#tekanan_bola_mata").val(data.pemeriksaan.tekanan_bola_mata);
            $("#seklera").val(data.pemeriksaan.seklera);
            // $("#kedalaman_bilik_mata").val(data.pemeriksaan.kedalaman_bilik_mata);
            $("#conjungtiva").val(data.pemeriksaan.conjungtiva);
            $("#pupil").val(data.pemeriksaan.pupil);
            $("#refleks_pupil").val(data.pemeriksaan.refleks_pupil);
            // $("#pemulihan_silau").val(data.pemeriksaan.pemulihan_silau);
            $("#daun_telinga_kanan").val(data.pemeriksaan.daun_telinga_kanan);
            $("#liang_telinga_kanan").val(data.pemeriksaan.liang_telinga_kanan);
            $("#serumen_telinga_kanan").val(data.pemeriksaan.serumen_telinga_kanan);


            $("#membran_timpani_kanan").val(data.pemeriksaan.membran_timpani_kanan);
            $("#hidung").val(data.pemeriksaan.hidung);
            $("#faring").val(data.pemeriksaan.faring);
            $("#daun_telinga_kiri").val(data.pemeriksaan.daun_telinga_kiri);
            $("#liang_telinga_kiri").val(data.pemeriksaan.liang_telinga_kiri);
            $("#serumen_telinga_kiri").val(data.pemeriksaan.serumen_telinga_kiri);
            $("#membran_timpani_kiri").val(data.pemeriksaan.membran_timpani_kiri);
            $("#lidah").val(data.pemeriksaan.lidah);
            $("#tonsil").val(data.pemeriksaan.tonsil); 
   
          // show bootstrap modal when complete loaded
               $('.modal-title').text('Fisik Kulit Mata'); // Set title to Bootstrap modal title
               $('#modal-pop').modal('show'); 
               Notiflix.Block.remove('.blocking');
    
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
       var url

       if(save_method == 'update'){
        url = "/update-fisik-kulit-mata";
       }else{
        url = "/insert-fisik-kulit-mata";
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
           data: $('#form').serialize(),
           dataType: "JSON",
           success: function(data)
           {
            console.log(data);
            
    
               if(data.status == 'success') //if success close modal and reload ajax table
               {
                   $('#modal-pop').modal('hide');
                   
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
        url : "/delete-fisik-kulit-mata/" + no_rawat,
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