@extends('layouts.main')

@section('content')
  
<link rel="stylesheet" href="{{asset('assets/plugin/datatables/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/notiflix/dist/notiflix-3.2.7.min.css')}}" />
<script src="{{asset('assets/notiflix/dist/notiflix-3.2.7.min.js')}}"></script>
<h1 class="h3 mb-3"> Nama Pelabuhan</h1>
<div class="row blocking">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex">
          <h4 class="card-title"></h4>
          <a class="btn btn-primary btn-round ms-auto" onclick="add()" style="background-color: rgb(114, 79, 255)!important; color:azure;!important"><i class="fa fa-plus"></i> Tambah Pelabuhan</a>&nbsp;
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="datatables-ajax table table-bordered dataTable" width="100%">
              <thead class="">
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Kode Pelabuhan</th>
                    <th width="20%">Nama Pelabuhan</th>
                    <th width="15%">Keterangan</th>
                    <th width="5%">Status</th>
                    <th width="12%">Action</th>

                </tr>
              </thead>
              <tbody>
                <tr>      
                  
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  
  <!-- Edit User Modal -->
              <div class="modal fade" id="modal-pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Data Pelabuhan</h4>
                      </div>
                      <form id="form" class="row g-6" >
                        @csrf
                        <input type="hidden" id="id" name="id" class="form-control">
                      <div class="col-lg-12">
                          <label class="form-label" for="nama_pelabuhan">Nama Pelabuhan</label>
                          <input type="text" id="nama_pelabuhan" name="nama_pelabuhan" class="form-control" />
                          <span class="help-block text-danger nama_pelabuhan_err"></span>
                      </div>

                        <div class="col-lg-12">
                          <label class="form-label" for="kode_pelabuhan">Kode Pelabuhan</label>
                          <input type="text" id="kode_pelabuhan" name="kode_pelabuhan" class="form-control" />
                          <span class="help-block text-danger kode_pelabuhan_err"></span>
                      </div>

                       <div class="col-lg-12">
                          <label class="form-label" for="keterangan">keterangan</label>
                          <input type="text" id="keterangan" name="keterangan" class="form-control" />
                      </div>
                        
                        <div class="col-lg-12 text-end">
                          <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary me-3">Submit</button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

  <script>
var table;
  var save_method;
 $(document).ready(function () {
   table =  $('#table').DataTable ({
   processing: true,
   serverSide: true,
   ajax: { 
     url: "/pelabuhan",
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

 })


        Notiflix.Confirm.init({
className: 'notiflix-confirm',
width: '300px',
zindex: 4003,
position: 'center',
distance: '10px',
backgroundColor: '#f8f8f8',
borderRadius: '25px',
backOverlay: true,
backOverlayColor: 'rgba(0,0,0,0.5)',
rtl: false,
fontFamily: 'Quicksand',
cssAnimation: true,
cssAnimationDuration: 300,
cssAnimationStyle: 'fade',
plainText: true,
titleColor: '#DC143C',
titleFontSize: '16px',
titleMaxLength: 34,
messageColor: '#1e1e1e',
messageFontSize: '14px',
messageMaxLength: 110,
buttonsFontSize: '15px',
buttonsMaxLength: 34,
okButtonColor: '#f8f8f8',
okButtonBackground: '#DC143C',
cancelButtonColor: '#f8f8f8',
cancelButtonBackground: '#a9a9a9',
});



function reload_table()
   {
      table.ajax.reload(null,false); //reload datatable ajax
   }

function add() {
  save_method = 'add';
  $('#form')[0].reset(); // reset form on modals
  $('#modal-pop').modal('show'); // show bootstrap modal
  $('.modal-title').text('Tambah Pelabuhan'); // Set Title to Bootstrap modal title
}

function printErrorMsg (msg) {
         $.each( msg, function( key, value ) {
         console.log(key);
           $('.'+key+'_err').text(value);
         });
     }



      function edit(id)
   {

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(100, 149, 237)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

       save_method = 'update';
       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
    
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-data-pelabuhan/" + id,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {
               $('[name="id"]').val(data.id_pelabuhan);
               $('[name="nama_pelabuhan"]').val(data.nama_pelabuhan);
               $('[name="kode_pelabuhan"]').val(data.kode_pelabuhan);
               $('[name="keterangan"]').val(data.keterangan);
               $('#modal-pop').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
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
       var url;

         Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(100, 149, 237)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });
    
       if(save_method == 'add') {
           url = "/insert-pelabuhan";
       } else {
           url = "/update-pelabuhan";
       }
    
       // ajax adding data to database
       $.ajax({
           url : url,
           type: "POST",
           data: $('#form').serialize(),
           dataType: "JSON",
           success: function(data)
           {
    
               if(data.status == 'success') //if success close modal and reload ajax table
               {
                   $('#modal-pop').modal('hide');
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
                 data.data,
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
      svgColor: 'rgba(100, 149, 237)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });
  
    $.ajax({
        url : "/hapus-pelabuhan/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if(data.status == 'success') //if success close modal and reload ajax table
            {
                reload_table();
                Notiflix.Report.success(
                'Berhasil',
                'Data berhasil dihapus',
                'Okay');
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


  </script>

  
    
@endsection