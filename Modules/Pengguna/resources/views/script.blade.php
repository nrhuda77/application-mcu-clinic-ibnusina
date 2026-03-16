<script>
    var table;
var save_method;
$(document).ready(function () {

 table =  $('#table').DataTable ({
 processing: true,
 serverSide: true,
 ajax: { 
   url: "/pengguna",
type:"POST",
data: {
 "_token" : "{{csrf_token()}}"
}
},
columnDefs: [
 {

   targets: [ -1 ], //last column
   orderable: false, //set not orderable
 }
]
});
$('#table').DataTable().search('').draw();
})

$(document).ready(function() {
    $('#role').change(function() {
        var selectedValue = $(this).val(); // Mendapatkan nilai yang dipilih
        console.log('Pilihan yang dipilih: ' + selectedValue); // Menampilkan di console

        if (selectedValue == "Admin Perusahaan") {
          var x = document.querySelector('#rl2');
        x.classList.remove('d-none');
        } else {
          var x = document.querySelector('#rl2');
          x.classList.add('d-none');
        }
    });
});



function add()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data '); // Set Title to Bootstrap modal title
    $('#photo-preview').hide(); // hide photo preview modal
     // $('#label-photo').text('Upload Photo'); // label photo upload

     $('#btnSave').show();
               $('#close').show();
}






function reload_table() {
 table.ajax.reload();
};
function printErrorMsg (msg) {
         $.each( msg, function( key, value ) {
         console.log(key);
           $('.'+key+'_err').text(value);
         });
     }


     function save()
   {
       $('#btnSave').text('Menyimpan...'); //change button text
       $('#btnSave').attr('disabled',true); //set button disable 
       var url;
       $('#btnSave').text('Simpan');
       if(save_method == 'add') {
           url = "/insert-pengguna";
           var formData = new FormData($('#form')[0]);
       }  
       else  {
           url = "/edit-pengguna";
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
                reload_table();
                   Notiflix.Report.failure(
                 'Error',
                 'Data gagal diinput',
                 'Okay',
                );
               }
               else
               {
                $('#modal_form').modal('hide');
                   reload_table();
                   Notiflix.Report.success(
                'Berhasil',
                'Data berhasil diinput',
                'Okay');
               }

                   
               

               //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error adding / update data');
               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
           }
       });
   }





     function detail(id)
   {
       save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
       $('#modal_form').modal('show'); // show bootstrap modal
       $('#btnSave').hide();
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-detail-pengguna/" + id,
           type: "GET",
           dataType: "JSON",
           
           success: function(data)
           {

            
               $('[name="id"]').val(data.id);
               $('[name="nama"]').val(data.nama);
               $('[name="role"]').val(data.role);
               $('[name="role2"]').val(data.role2);
               $('[name="username"]').val(data.username);
              //  $('[name="password"]').val(data.password);   
               $('[name="status"]').val(data.status);    
               $('[name="email"]').val(data.email); 
              


             
               $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Detail Data Pasien'); // Set title to Bootstrap modal title
              
             
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
       $('#modal_form').modal('show'); // show bootstrap modal
       $('#btnSave').show();
       //Ajax Load data from ajax
       $.ajax({
        url : "/ajax-detail-pengguna/" + id,
           type: "GET",
           dataType: "JSON",
           
           success: function(data)
           {

        
         
            $('[name="id"]').val(data.id);
               $('[name="role"]').val(data.role);
               $('[name="role2"]').val(data.role2);
               $('[name="username"]').val(data.username);
               $('[name="nama"]').val(data.nama);
               $('[name="status"]').val(data.status);    
               $('[name="email"]').val(data.email); 



               $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Detail Data Pasien'); // Set title to Bootstrap modal title
              
            
             
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }

   function hapus(id) {

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
       url : "/delete-pengguna/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            reload_table();
                Notiflix.Report.success(
                'Berhasil',
                'Data berhasil dihapus',
                'Okay');
        
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



</script>