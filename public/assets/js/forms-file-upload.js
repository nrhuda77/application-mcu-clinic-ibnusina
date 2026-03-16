
'use strict';

// Matikan autoDiscover agar Dropzone tidak inisialisasi otomatis
Dropzone.autoDiscover = false;

(function () {
  // Template preview Dropzone
  const previewTemplate = `
  <div class="dz-preview dz-file-preview">
    <div class="dz-details">
      <div class="dz-thumbnail">
        <img data-dz-thumbnail>
        <span class="dz-nopreview">No preview</span>
        <div class="dz-success-mark"></div>
        <div class="dz-error-mark"></div>
        <div class="dz-error-message">
          <span data-dz-errormessage></span>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
        </div>
      </div>
      <div class="dz-filename" data-dz-name></div>
      <div class="dz-size" data-dz-size></div>
    </div>
  </div>`;

  // ✅ Fungsi untuk inisialisasi Dropzone baru (dipanggil ulang setiap append)
  window.dropzones = {};


  function initDropzone(selector) {
    const el = document.querySelector(selector);
    if (el && !el.dropzone) {
      const dz = new Dropzone(el, {
        previewTemplate: previewTemplate,
        parallelUploads: 1,
        maxFilesize: 5,
        addRemoveLinks: true,
        maxFiles: 1,
        url: "/upload",
        autoProcessQueue: false,
      });
      window.dropzones[selector] = dz; // simpan di global dropzones
    }
  }



  // ✅ Inisialisasi Dropzone statis saat halaman load
  document.addEventListener('DOMContentLoaded', function () {
    const staticDropzones = document.querySelectorAll('.dropzone-basic');
    staticDropzones.forEach((el) => {
      initDropzone(`#${el.id}`);
    });
  });

  // ✅ Event untuk tombol tambah input
  window.inputCount = window.inputCount || 0;


  $('#add-input').on('click', function () {
    window.inputCount++;
    const index = window.inputCount;
    const dzId = `dropzone-dynamic-${index}`;
    let options = '<option value="" disabled selected hidden>Pilih</option>';
    masterData.forEach(b => {
      options += `<option value="${b.kode}">${b.nama}</option>`;
    });
    // Tambahkan <select>
    $('#result-container').append(`
      <div class="col-lg-12 mt-5">
      <label for="alamat" class="form-label"> jenis </label>
      <select class="form-select " name="jenis[]">
        <option value="" disabled selected hidden>Pilih</option> 
         ${options}
      </select>
      </div>

<div class="col-lg-12 mb-5">
      <div class="card ">
        <h5 class="card-header">Upload Gambar</h5>
        <div class="card-body">
          <div class="dropzone dropzone-basic needsclick" id="${dzId}">
            <div class="dz-message needsclick">
              Drop files here or click to upload
            </div>
            <div class="fallback">
              <input name="foto[]" type="file" />
            </div>
          </div>
        </div>
      </div>
      </div>
    `);

    // Unique ID untuk Dropzone baru




    // ✅ Inisialisasi Dropzone baru yang barusan ditambahkan
    initDropzone(`#${dzId}`);

  });

})();

