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
               $('.modal-title').text('Napfa'); // Set title to Bootstrap modal title
               $('#modal-pop').modal('show'); 
               Notiflix.Block.remove('.blocking');

                 $(document).ready(function () {
    function calculateTotal() {
        // ID semua elemen <select> skor
        const scoreIds = [
            '#score_sit_up',
            '#score_push_up',
            '#score_standing_board_jump',
            '#score_shuttle_run',
            '#score_rockport',
            '#score_sit_reach_forward'
        ];

        // Mengambil semua nilai skor dan mengubah ke angka
        const scores = scoreIds.map(id => parseFloat($(id).val()) || 0);
        const total = scores.reduce((a, b) => a + b, 0);

        // Menentukan status dan class tombol
        let status = "Tidak Valid";
        let alertClass = "btn btn-secondary";

        if (total >= 27) {
            status = (scores.includes(2) || scores.includes(3)) ? "Baik" : "Sangat Baik";
            alertClass = "btn btn-success";
        } else if (total >= 21) {
            status = (scores.includes(1) || scores.includes(2)) ? "Rata Rata" : "Baik";
            alertClass = "btn btn-success";
        } else if (total >= 15) {
            status = scores.includes(1) ? "Kurang" : "Rata Rata";
            alertClass = scores.includes(1) ? "btn btn-danger" : "btn btn-warning";
        } else if (total >= 9) {
            status = "Kurang";
            alertClass = "btn btn-danger";
        } else if (total > 5) {
            status = "Sangat Kurang";
            alertClass = "btn btn-danger";
        }

        // Update nilai dan status ke halaman
        $('.score_all').val(total);
        $('#total').text(status).attr('class', 'btn text-center ' + alertClass);
    }

    // Jalankan fungsi saat <select> berubah dan saat halaman dimuat
    $('select').on('change', calculateTotal);
    calculateTotal();
});



               
    
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
           url : '/get-score-pemeriksaan-napfa/' + no_rawat,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {

               $('.nama_pasien').val(data.pasien.nm_pasien);
               $('.no_rkm_medis').val(data.reg.no_rkm_medis);
               $('.no_reg').val(data.reg.no_reg);
               $('.no_rawat').val(data.reg.no_rawat);

             $("#sit_reach_forward").val(data.score.sit_reach_forward);
            $("#sit_up").val(data.score.sit_up);
            $("#push_up").val(data.score.push_up);
            $("#standing_board_jump").val(data.score.standing_board_jump);
            $("#shuttle_run").val(data.score.shuttle_run);
            $("#rockport").val(data.score.rockport);
            $("#rockport2").val(data.score.rockport2);
            
            $("#score_sit_reach_forward").val(data.score.score_sit_reach_forward);
            $("#score_sit_up").val(data.score.score_sit_up);
            $("#score_push_up").val(data.score.score_push_up);
            $("#score_standing_board_jump").val(data.score.score_standing_board_jump);
            $("#score_shuttle_run").val(data.score.score_shuttle_run);
            $("#score_rockport").val(data.score.score_rockport);
            $("#score_rockport2").val(data.score.score_rockport2);
            $("#score_all").val(data.score.score_all);
            
                   let score = parseFloat($('#score_sit_up').val()) || 0;
        let score2 = parseFloat($('#score_push_up').val()) || 0;
        let score3 = parseFloat($('#score_standing_board_jump').val()) || 0;
        let score4 = parseFloat($('#score_shuttle_run').val()) || 0;
        let score5 = parseFloat($('#score_rockport').val()) || 0;
        let score6 = parseFloat($('#score_sit_reach_forward').val()) || 0;



            let all = data.score.score_all;
       let scores = [score, score2, score3, score4, score5, score6];
        // Menentukan status berdasarkan total
        let status;
        let alertClass = ''; // Class untuk menentukan warna latar belakang alert

    if (all >= 27) {
        
         if (scores.includes(2) || scores.includes(3)) {
                 status = "Baik";
                 alertClass = "btn btn-success"; // Kuning
                }else{
                 status = "Sangat Baik";
                 alertClass = "btn btn-success"; // Kuning
                }
                
        } else if (all >= 21) {
            
             if (scores.includes(1) || scores.includes(2)) {
                 status = "Rata Rata";
                 alertClass = "btn btn-warning"; // Kuning
                }else{
                 status = "Baik";
                 alertClass = "btn btn-success"; // Kuning
                }
                
        } else if (all >= 15) {
          
              if (scores.includes(1)) {
                 status = "kurang";
                 alertClass = "btn btn-danger"; // Kuning
                }else{
                 status = "Rata Rata";
                 alertClass = "btn btn-warning"; // Kuning
                }
           
        } else if (all >= 9) {
            status = "Kurang";
            alertClass = "btn btn-danger"; // Merah
        } else if (all > 5) {
            status = "Sangat Kurang";
            alertClass = "btn btn-danger"; // Merah
        } else {
            status = "Tidak Valid";
            alertClass = "btn btn-secondary"; // Abu-abu (opsional)
        }

        function calculateTotal() {
        // Mengambil nilai dari setiap elemen <select> dan memastikan nilai default 0 jika tidak dipilih
        let score = parseFloat($('#score_sit_up').val()) || 0;
        let score2 = parseFloat($('#score_push_up').val()) || 0;
        let score3 = parseFloat($('#score_standing_board_jump').val()) || 0;
        let score4 = parseFloat($('#score_shuttle_run').val()) || 0;
        let score5 = parseFloat($('#score_rockport').val()) || 0;
        let score6 = parseFloat($('#score_sit_reach_forward').val()) || 0;

        // Menjumlahkan semua nilai
         let all = score + score2 + score3 + score4 + score5 + score6;
        let scores = [score, score2, score3, score4, score5, score6];
        // Menentukan status berdasarkan total
        let status;
        let alertClass = ''; // Class untuk menentukan warna latar belakang alert

    if (all >= 27) {
        
         if (scores.includes(2) || scores.includes(3)) {
                 status = "Baik";
                 alertClass = "btn btn-success"; // Kuning
                }else{
                 status = "Sangat Baik";
                 alertClass = "btn btn-success"; // Kuning
                }
                
        } else if (all >= 21) {
            
             if (scores.includes(1) || scores.includes(2)) {
                 status = "Rata Rata";
                 alertClass = "btn btn-warning"; // Kuning
                }else{
                 status = "Baik";
                 alertClass = "btn btn-success"; // Kuning
                }
                
        } else if (all >= 15) {
          
              if (scores.includes(1)) {
                 status = "kurang";
                 alertClass = "btn btn-danger"; // Kuning
                }else{
                 status = "Rata Rata";
                 alertClass = "btn btn-warning"; // Kuning
                }
           
        } else if (all >= 9) {
            status = "Kurang";
            alertClass = "btn btn-danger"; // Merah
        } else if (all > 5) {
            status = "Sangat Kurang";
            alertClass = "btn btn-danger"; // Merah
        } else {
            status = "Tidak Valid";
            alertClass = "btn btn-secondary"; // Abu-abu (opsional)
        }

        // Memperbarui nilai total dan status pada halaman
        $('.score_all').val(all);
        $('#total').text(status).removeClass().addClass('btn text-center ' + alertClass);
    }

        $('select').on('change', function() {
        calculateTotal();
    });
    
        $('#total').text(status).removeClass().addClass('btn text-center ' + alertClass);
   
          // show bootstrap modal when complete loaded
               $('.modal-title').text('Napfa'); // Set title to Bootstrap modal title
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
        url = "/update-score-pemeriksaan-napfa";
       }else{
        url = "/insert-score-pemeriksaan-napfa";
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
        url : "/delete-score-pemeriksaan-napfa/" + no_rawat,
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