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
               $('.modal-title').text('Jakarta Cardiovascular'); // Set title to Bootstrap modal title
               $('#modal-pop').modal('show'); 
               Notiflix.Block.remove('.blocking');

              $(document).ready(function () {
    function calculateTotal() {
        // Array ID elemen <select> skor
        const scoreIds = [
            '#score_gender',
            '#score_age',
            '#score_blood_presure',
            '#score_bmi',
            '#score_smoking',
            '#score_diabetes',
            '#score_activity'
        ];

        // Ambil semua nilai skor, ubah ke float, default ke 0
        const scores = scoreIds.map(id => parseFloat($(id).val()) || 0);
        const total = scores.reduce((a, b) => a + b, 0);
        console.log(total);

        // Menentukan status dan class tombol berdasarkan total
        let status = "Tidak Valid";
        let alertClass = "btn btn-secondary";

        if (total >= 5 && total <= 18) {
            status = "High Risk (CV10 > 20%)";
            alertClass = "btn btn-danger";
        } else if (total >= 2 && total <= 4) {
            status = "Moderate Risk (CV10 = 10-20%)";
            alertClass = "btn btn-warning";
        } else if (total <= 1) {
            status = "Low Risk (CV10 < 10%)";
            alertClass = "btn btn-success";
        }

        // Update nilai total dan status ke halaman
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


$(document).ready(function () {
  // Fungsi utilitas untuk mapping dan pengisian nilai
  function setupScoreMapping(selectId, scoreId, mapping) {
    $(selectId).on('change', function () {
      const value = $(this).val();
      const score = mapping[value] !== undefined ? mapping[value] : '';
      $(scoreId).val(score);
    }).trigger('change'); // trigger untuk set awal
  }

  // Mapping untuk tiap input
  setupScoreMapping('#gender', '#score_gender', {
    'Male': '1',
    'Female': '0'
  });

  setupScoreMapping('#age', '#score_age', {
    '25-34': '-4',
    '35-39': '-3',
    '40-44': '-2',
    '45-49': '0',
    '50-54': '1',
    '55-59': '2',
    '60-64': '3'
  });

  setupScoreMapping('#blood_presure', '#score_blood_presure', {
    'Normal (<130/<85)': '0',
    'High Normal (130-139/85-89)': '1',
    'Grade 1 HT (140-159/90-99)': '2',
    'Grade 2 HT (160-179/100-109)': '3',
    'Grade 3 HT (>180/>110)': '4'
  });

  setupScoreMapping('#bmi', '#score_bmi', {
    '01.00-24.99': '0',
    '25.00-29.99': '1',
    '30.00-35.58': '2'
  });

  setupScoreMapping('#smoking', '#score_smoking', {
    'Never': '0',
    'Ex-Smoker': '3',
    'Smoker': '4'
  });

  setupScoreMapping('#diabetes', '#score_diabetes', {
    'Yes': '2',
    'No': '0'
  });

  setupScoreMapping('#activity', '#score_activity', {
    'High': '-3',
    'Medium': '0',
    'Low': '1',
    'No': '2'
  });
});



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
           url : '/get-score-jakarta-cardiovascular/' + no_rawat,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {

               $('.nama_pasien').val(data.pasien.nm_pasien);
               $('.no_rkm_medis').val(data.reg.no_rkm_medis);
               $('.no_reg').val(data.reg.no_reg);
               $('.no_rawat').val(data.reg.no_rawat);

                $("#gender").val(data.score.gender);
            $("#age").val(data.score.age);
            $("#blood_presure").val(data.score.blood_presure);
            $("#bmi").val(data.score.bmi);
            $("#smoking").val(data.score.smoking);
            $("#diabetes").val(data.score.diabetes);
            $("#activity").val(data.score.activity);
            
            $("#score_gender").val(data.score.score_gender);
            $("#score_age").val(data.score.score_age);
            $("#score_blood_presure").val(data.score.score_blood_presure);
            $("#score_bmi").val(data.score.score_bmi);
            $("#score_smoking").val(data.score.score_smoking);
            $("#score_diabetes").val(data.score.score_diabetes);
            $("#score_activity").val(data.score.score_activity);
            $("#score_all").val(data.score.score_all);


            let all = data.score.score_all;
        let status;
        let alertClass = ''; // Class untuk menentukan warna latar belakang alert

        if (all <= 18 && all  >= 5) {
            status = "High Risk (CV10 > 20%)";
            alertClass = "btn btn-danger"; // Hijau
        } else if (all <= 4 && all >= 2) {
            status = "Moderate Risk (CV10 = 10-20%)";
            alertClass = "btn btn-warning"; // Hijau
        } else if (all <= 1) {
            status = "Low Risk (CV10 < 10%)";
            alertClass = "btn btn-success"; // Kuning
        }else {
            status = "Tidak Valid";
            alertClass = "btn btn-secondary"; // Abu-abu (opsional)
        }



        function calculateTotal() {
        // Mengambil nilai dari setiap elemen <select> dan memastikan nilai default 0 jika tidak dipilih
            let score = parseFloat($('#score_gender').val()) || 0;
        let score2 = parseFloat($('#score_age').val()) || 0;
        let score3 = parseFloat($('#score_blood_presure').val()) || 0;
        let score4 = parseFloat($('#score_bmi').val()) || 0;
        let score5 = parseFloat($('#score_smoking').val()) || 0;
        let score6 = parseFloat($('#score_diabetes').val()) || 0;
        let score7 = parseFloat($('#score_activity').val()) || 0;


        // Menjumlahkan semua nilai
        let all = score + score2 + score3 + score4 + score5 + score6 + score7;

        // Menentukan status berdasarkan total
        let status;
        let alertClass = ''; // Class untuk menentukan warna latar belakang alert

        if (all <= 18 && all  >= 5) {
            status = "High Risk (CV10 > 20%)";
            alertClass = "btn btn-danger"; // Hijau
        } else if (all <= 4 && all >= 2) {
            status = "Moderate Risk (CV10 = 10-20%)";
            alertClass = "btn btn-warning"; // Hijau
        } else if (all <= 1) {
            status = "Low Risk (CV10 < 10%)";
            alertClass = "btn btn-success"; // Kuning
        }else {
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
               $('.modal-title').text('Genital Extremitas'); // Set title to Bootstrap modal title
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
        url = "/update-score-jakarta-cardiovascular";
       }else{
        url = "/insert-score-jakarta-cardiovascular";
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
        url : "/delete-score-jakarta-cardiovascular/" + no_rawat,
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