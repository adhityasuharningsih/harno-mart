$(function() { 
    // halaman produk start
    $('.tambah-produk').on('click', function () {
        var kode = $(this).data('kode');
        $('.modal-body h5').html(kode);
        $('.kd-produk').val(kode);
        $('#staticBackdropLabel').html('Tambah Produk');
        $('.modal-footer button[type=submit]').html('Save');
        $('.modal-body form').attr('action', '/admin/produk/insert');
        $('.modal-body form')[0].reset();
    });

    // $('.ubah-produk').on('click', function () {
    //     $('#staticBackdropLabel').html('Ubah Data Produk');
    //     $('.modal-footer button[type=submit]').html('Save');
    //     $('.modal-body form').attr('action', '/admin/produk/update');

    //     var kode = $(this).data('kode');

    //     $.ajax({
    //         url: '/admin/produk/getProdukByKode',
    //         data: {
    //             kd_produk: kode
    //         },
    //         method: 'post',
    //         dataType: 'json',
    //         success: function (data) {
    //             $('.modal-body h5').html(kode);
    //             $('.kd-produk').val(data.kd_produk);
    //             $('.nama').val(data.nama);
    //             $('.harga').val(data.harga);
    //             $('.desk').val(data.deskripsi);
    //             $('.gambar').val(data.gambar);
    //             $('.show-gambar').attr('src', '/assets/img/produk/'+data.gambar);               
    //         }
    //     });
    // });

    $('.hapus-produk').on('click', function () {
            const id = $(this).data('id');

            $('.modal-body p').html('Apakah anda yakin ingin menghapus '+id+'?')

            $('.modal-content form').attr('action', "/admin/produk/delete/"+id);
            $('.modal-footer button[type=submit]').html('Yes');
    });

    $('.hapus-kategori').on('click', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');

            $('.modal-body p').html('<b>Semua produk dengan kategori '+nama+' akan otomatis ikut terhapus</b>. Apakah anda yakin ingin menghapus kategori <b>'+nama+'</b>?')

            $('.modal-content form').attr('action', "/admin/produk/deleteKategori/"+id);
            $('.modal-footer button[type=submit]').html('Yes');
    });
    // halaman produk end

    // halaman bahan baku start
    $('.hapus-bahan').on('click', function () {
            const id = $(this).data('id');

            $('.modal-body p').html('Apakah anda yakin ingin menghapus '+id+'?')

            $('.modal-content form').attr('action', "/admin/bahan-baku/delete/"+id);
            $('.modal-footer button[type=submit]').html('Yes');
    });

    $('.detail-bahan').on('click', function () {
        var id = $(this).data('id');

        $('.ubah-bahan').attr('href', "/admin/bahan-baku/ubah/"+id);

        $.ajax({
            url: '/admin/bahan-baku/getBahanByKode',
            data: {
                kd_pembelian: id
            },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('.nama-sup').html(data.nama_suplier);
                $('.no_telepon').html(data.no_telepon);
                $('.nama').html(data.nama);
                $('.qty').html(data.qty);
                $('.harga').html(data.harga);
                $('.tgl').html(data.tgl_pembelian);
                $('.foto-struk').attr('src', '/assets/img/struk-pembelian/'+data.foto_struk);
            }
        });
    });
    // Halaman bahan baku end
    // penjualan start
    // detail penjualan start
    $('.detail-penjualan').on('click', function(){
        var id = $(this).data('id');

        $.ajax({
            url: '/admin/penjualan/getItemByPenjualan',
            data: {
                kd_penjualan: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data){
                var show = Array();
                for (var index = 0; index < data.length; index++) {

                    show[index] =   '<tr>'+
                                        '<td>'+(index+1)+'</td>'+
                                        '<td>'+data[index].nama_produk+'</td>'+
                                        '<td>'+data[index].qty+'</td>'+
                                        '<td> IDR '+format_rupiah(data[index].harga_produk)+'</td>'+
                                        '<td class="text-right"> IDR '+format_rupiah(data[index].harga_produk*data[index].qty)+'</td>'+
                                    '</tr>';                                 
                }
                document.getElementById('show-detail').innerHTML = show.join(" ");
            }
        });

        $.ajax({
            url: '/admin/penjualan/getPenjualanById',
            data: {
                kd_penjualan: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data){
                $('.kd-penjualan').html(data.kd_penjualan);
                $('.nama-pembeli').html(data.nama_pembeli);
                $('.no-telepon').html(data.no_telepon);
                $('.alamat').html(data.alamat);
                $('.total-bayar').html('IDR '+format_rupiah(data.total_bayar));
                $('.btnEdit').attr('href', '/admin/penjualan/ubah/'+data.kd_penjualan);
            }
        });
    });
    // datail penjualan end
    // hapus penjualan
    $('.hapus-penjualan').on('click', function () {
            const id = $(this).data('id');

            $('.modal-body p').html('Apakah anda yakin ingin menghapus '+id+'?')

            $('.modal-content form').attr('action', "/admin/penjualan/delete/"+id);
            $('.modal-footer button[type=submit]').html('Yes');
    });

    $('.belum-lunas').on('click', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');

            $('.modal-body p').html('Apakah pelanggan atas nama '+nama+' telah melakukan pembayaran '+id+'?')

            $('.modal-content form').attr('action', "/admin/penjualan/rubahstatus/"+id);
            $('.modal-footer button[type=submit]').html('Yes');
    });

    // hapus item pada ubah data
    $('.hapus-item').on('click', function () {
            const kd_produk = $(this).data('produk');
            const kd_penjualan = $(this).data('penjualan');
            const nama = $(this).data('nama');

            $('.modal-body p').html('Apakah anda yakin ingin menghapus '+nama+'?')

            $('.modal-content form').attr('action', "/admin/penjualan/deleteItem/"+kd_produk+"/"+kd_penjualan);
            $('.modal-footer button[type=submit]').html('Yes');
    });
    // penjualan end

    // karyawan start

    // tambah karyawan
    $('.tambah-karyawan').on('click', function () {
        var kode = $(this).data('kode');
        $('.modal-body h5').html(kode);
        $('.id-karyawan').val(kode);
        $('#staticBackdropLabel').html('Tambah Karyawan');
        $('.modal-footer button[type=submit]').html('Save');
        $('.modal-body form').attr('action', '/admin/karyawan/insert');
        $('.modal-body form')[0].reset();
    });

    // hapus karyawan
    $('.hapus-karyawan').on('click', function () {
            const id = $(this).data('id');

            $('.modal-body p').html('Apakah anda yakin ingin menghapus '+id+'?')

            $('.modal-content form').attr('action', "/admin/karyawan/delete/"+id);
            $('.modal-footer button[type=submit]').html('Yes');
    });

    // edit karyawan
    $('.edit-karyawan').on('click', function () {
        const id = $(this).data('id');
        $('.modal-body h5').html(id);
        $('.id-karyawan').val(id);
        $('#staticBackdropLabel').html('Ubah Data Karyawan');
        $('.ubah-karyawan').attr('href', '/admin/karyawan/ubah/'+id)

        $.ajax({
            url: '/admin/karyawan/getKaryawanById',
            data: {
                id_karyawan: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data){
                $('.nama').html(data.nama);
                $('.no-telepon').html(data.no_telepon);
                $('.gaji').html(data.gaji);
                $('.foto-ktp').attr('src', '/assets/img/foto-ktp/'+data.foto_ktp);
            }
        });
    });

    // karyawan end

    // Presensi start
    $('.presensi-pulang').on('click', function () {
        id = $(this).data('id');
        nama = $(this).data('nama');
        $('.id-karyawan').val(id);

        $('.modal-body p').html('Tekan "Yes" untuk melanjukan presensi pulang <b>'+nama+'</b> !')

        $('.modal-content form').attr('action', "/admin/karyawan/presensi-pulang");
        $('.modal-footer button[type=submit]').html('Yes');
    });

    $('.presensi-masuk').on('click', function () {
        id = $(this).data('id');
        nama = $(this).data('nama');
        $('.id-karyawan').val(id);

        $('.modal-body p').html('Tekan "Yes" untuk melanjukan presensi masuk <b>'+nama+'</b> !')

        $('.modal-content form').attr('action', "/admin/karyawan/presensi-masuk");
        $('.modal-footer button[type=submit]').html('Yes');
    });

    // suplier
    $('.tambah-suplier').on('click', function () {
        var kode = $(this).data('kode');
        $('.modal-body h5').html(kode);
        $('.id-suplier').val(kode);
        $('#staticBackdropLabel').html('Tambah Suplier');
        $('.modal-footer button[type=submit]').html('Save');
        $('.modal-body form').attr('action', '/admin/suplier/insert');
        $('.modal-body form')[0].reset();
    });

    $('.edit-suplier').on('click', function () {
        const id = $(this).data('id');
        $('.modal-body h5').html(id);
        $('.id-suplier').val(id);
        $('#staticBackdropLabel').html('Ubah Data Suplier');        
        $('.modal-footer button[type=submit]').html('Save');
        $('.modal-body form').attr('action', '/admin/suplier/update');

        $.ajax({
            url: '/admin/suplier/getSuplierById',
            data: {
                id_suplier: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data){
                $('.nama').val(data.nama);
                $('.no-telepon').val(data.no_telepon);
                $('.alamat').html(data.alamat);
            }
        });
    });

    $('.hapus-suplier').on('click', function () {
            const id = $(this).data('id');

            $('.modal-body p').html('Apakah anda yakin ingin menghapus data '+id+'?')

            $('.modal-content form').attr('action', "/admin/suplier/delete/"+id);
            $('.modal-footer button[type=submit]').html('Yes');
    });
});

function previewImg() {
    const gambar = document.querySelector('#gambar');
    const gambarLabel = document.querySelector('.custom-file-label');
    const imgPreview = document.querySelector('.img-preview');

    gambarLabel.textContent = gambar.files[0].name;

    const fileGambar = new FileReader();
    fileGambar.readAsDataURL(gambar.files[0]);

    fileGambar.onload = function(e) {
        imgPreview.src = e.target.result;
    }
};

function format_rupiah(value) {
    var	reverse = value.toString().split('').reverse().join('');
	var ribuan 	= reverse.match(/\d{1,3}/g);
	var ribuan	= ribuan.join('.').split('').reverse().join('');

    return ribuan;
}

// buat transaksi start

function total() {
    var n = $('.count-item').val();
    var totalItem = Array();
    var total = 0;        
    for (var index = 0; index < n; index++) {
        totalItem[index] = $('.total-harga-'+(index+1)).val();
    }
    for (var index = 0; index < n; index++) {
        total += parseFloat(totalItem[index]);
    }
    return total;
}

$('.total-bayar').val(total());
$('.show-total-bayar').html('IDR '+format_rupiah(total()));

function plus(id) {    
    var qty = parseFloat($('.qty-'+id).val());
    var plus = qty + 1;

    $('.show-qty-'+id).html(plus);
    $('.qty-'+id).val(plus);
    $('.show-qty2-'+id).html(plus+' Items');

    var harga = parseFloat($('.harga_'+id).val());

    $('.show-harga-'+id).html('IDR '+format_rupiah(plus*harga));
    $('.total-harga-'+id).val(plus*harga);
    
    $('.total-bayar').val(total());
    $('.show-total-bayar').html('IDR '+format_rupiah(total()));
}


function minus(id) {
    var qty = parseFloat($('.qty-'+id).val());
    var minus = qty - 1;

    $('.show-qty-'+id).html(minus);
    $('.qty-'+id).val(minus);
    $('.show-qty2-'+id).html(minus+' Items');

   var harga = parseFloat($('.harga_'+id).val());

    $('.show-harga-'+id).html('IDR '+format_rupiah(minus*harga));
    $('.total-harga-'+id).val(minus*harga);

    $('.total-bayar').val(total());
    $('.show-total-bayar').html('IDR '+format_rupiah(total()));
}

// Buat transaksi end

// Presensi start
function riwayatPresensi(i){
    var id_karyawan = $('.id-karyawan-'+i).val();
    $('.nama-karyawan').html($('.nama-'+i).val());

    $.ajax({
            url: '/admin/karyawan/getPresensiById',
            data: {
                id_karyawan: id_karyawan
            },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('.count-absen').html(data.length);
                var show = Array();                 
                for (var index = 0; index < data.length; index++) {
                    show[index] = '<div class="row">'+
                                    '<div class="col">'+
                                        '<div class="card mb-2 border-left-primary barang-review">'+
                                            '<div class="card-body">'+
                                                '<div class="row justify-content-center">'+
                                                    '<div class="col">'+
                                                        '<b>Tanggal</b>'+
                                                        '<h6>'+data[index].tanggal+'</h6>'+
                                                    '</div>'+
                                                    '<div class="col-5 text-right">'+
                                                        '<b>Jam</b>'+
                                                        '<h6>'+data[index].jam_masuk+' - '+data[index].jam_keluar+'</h6>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                  '</div>';                                  
                }                
                document.getElementById('show-presensi').innerHTML = show.join(" ");
            }
        });
}
// Presensi End

// check all
function checkAll(ele) {
   var checkboxes = document.getElementsByTagName('input');
   if (ele.checked) {
       for (var i = 0; i < checkboxes.length; i++) {
           if (checkboxes[i].type == 'checkbox' ) {
               checkboxes[i].checked = true;
           }
       }
   } else {
       for (var i = 0; i < checkboxes.length; i++) {
           if (checkboxes[i].type == 'checkbox') {
               checkboxes[i].checked = false;
          }
       }
   }
}


