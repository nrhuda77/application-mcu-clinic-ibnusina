<style>

 @page {
        margin: 0px;
    }

    body {
        margin-top: 120px; /* Top margin untuk header */
        padding: 0px;
            margin-bottom: 30px;
    }


        .kop-surat {
              background: transparent !important;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            text-align: center;
            /* margin: 0; */
            padding: 0;
            /* border-bottom: 1px solid black; */
            background: white; /* supaya tdk transparan */
            /* z-index: 1000; */
        }

        .kop-surat img {
            display: block;
            margin: 0 auto;
            padding: 0;
            border: 0;
            width: 80%;
        }


            .footer {
 background: transparent !important;
                position: fixed;
            bottom: -70px;
            
            height: 100px;
            text-align: center;
            /* margin: 0; */
            padding: 0;
            /* border-bottom: 1px solid black; */
            background: white; /* supaya tdk transparan */
            /* z-index: 1000; */
        }

         .footer img {
            display: block;
margin: 0 auto;
            padding: 0;
            border: 0;
            width: 100%;
        }


       .kop-surat hr {
    margin: 0 auto;
    margin-top: 3px;
    padding: 0.2;
    width: 80%;
}

    .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1; /* transparansi */
            z-index: 999; /* di belakang konten */
            pointer-events: none; /* supaya gak ganggu interaksi */
        }
        

        .content {
            margin-top: 0;
            padding: 0 20px; /* optional untuk isi */
        }

        /* Untuk memaksa pindah halaman */
        .content {
            page-break-after: always;
        }

 #kategori { 
    /* margin-bottom: 150px; */
        width: 100%;
        border-collapse: collapse;
    }

    #kategori th,
    #kategori td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

  

 


</style>