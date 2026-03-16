
<script type="text/javascript">
 


$('#summernote').on('input', function () {
    let contents = $(this).val();
    autoSaveContent(contents); // panggil fungsi autosave
});




let timeout1 = null;
function autoSaveContent(content) {
    clearTimeout(timeout1);
    timeout1 = setTimeout(function () {
      
      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

        $.ajax({
            url: "/auto-save-temuan-rongentdada",
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                temuan: content,
                hasil_kategori: $('[name="hasil_kategori"]').val(),
                kesimpulan: $('[name="kesimpulan"]').val(),
                no_rawat: '{{ $norawat }}',
                no_reg: '{{ $reg->no_reg }}',
                no_rkm_medis: '{{ $reg->no_rkm_medis }}'
            },
            success: function (res) {
                $('#pdfFrame').attr('src', '/pdf-preview-temuan-rongentdada/' + '{{ $norawat }}');
                 Notiflix.Block.remove('.blocking');
            }
        });
    }, 400);
}




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
        url : "/delete-hasil-inputan-dokter-rongentdada/" + no_rawat,
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