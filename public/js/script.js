$(function() {
    //SUPPLIER
    //tambah data
    $('.tambah-supplier').on('click', function () {
        var kode = $(this).data('id'); 
        //console.log(kode);
        $('.id-supplier').val(kode);
        $('#exampleModalLabel').html('Tambah Supplier');
        $('.show-id').html(kode);
        $('.btn-submit').html('Tambah');
        $('.modal-body form').attr('action', '/admin/supplier/simpan');
        $('.modal-body form')[0].reset();
    });

    // ubah supplier
    $('.edit-supplier').on('click', function () {
        var kode = $(this).data('id'); 
        // console.log(kode);
        $('.id-supplier').val(kode);  //merubah value kode sesuai dengan input hidden
        $('#exampleModalLabel').html('Ubah Supplier');  //merubah nama title modal
        $('.show-id').html(kode);  //menampilkan kode
        $('.btn-submit').html('Ubah');    
        $('.modal-body form').attr('action', '/admin/supplier/ubah');

        // mengambil data database
        $.ajax({
            url: '/admin/supplier/getSupplierbyId',
            data: {
                id_supplier: kode
            },
            method: 'post',
            dataType: 'json',
            success: function (data) {
            // console.log(data);
            $('.nm-supplier').val(data.nm_supplier);
            $('.alamat-supplier').val(data.alamat);
            $('.no_hp-supplier').val(data.no_hp);
            $('.email-supplier').val(data.email);
            }
        });
    });

    // Hapus data supplier berdasarkan id
    $('.hapus-supplier').on('click', function () {
        var kode= $(this).data('id');
        var nama = $(this).data('nama');

        $('.modal-body p').html('Apakah anda yakin ingin menghapus supplier <b>'+nama+'</b>?')

        $('.modal-content form').attr('action', "/admin/supplier/hapus/"+kode);
        $('.modal-footer button[type=submit]').html('Yes');
    });


    // KATEGORI BARANG
    // tambah kategori
    $('.tambah-kategori').on('click', function () {
        var kode = $(this).data('id'); 
        //console.log(kode);
        $('.id-kategori').val(kode);
        $('#exampleModalLabel').html('Tambah Kategori');
        $('.show-id').html(kode);
        $('.btn-submit').html('Tambah');
        $('.modal-body form').attr('action', '/admin/kategori/simpan');
        $('.modal-body form')[0].reset();
    });

    // ubah kategori
    $('.edit-kategori').on('click', function () {
        var kode = $(this).data('id'); 
        // console.log(kode);
        $('.id-kategori').val(kode);  //merubah value kode sesuai dengan input hidden
        $('#exampleModalLabel').html('Ubah Kategori');  //merubah nama title modal
        $('.show-id').html(kode);  //menampilkan kode
        $('.btn-submit').html('Ubah');    
        $('.modal-body form').attr('action', '/admin/kategori/ubah');

        // mengambil data database
        $.ajax({
            url: '/admin/kategori/getKategoribyId',
            data: {
                id_kategori: kode
            },
            method: 'post',
            dataType: 'json',
            success: function (data) {
            // console.log(data);
            $('.nm-kategori').val(data.nm_kategori);
            }
        });
    });

    // Hapus data kategosi berdasarkan id
    $('.hapus-kategori').on('click', function () {
        var kode= $(this).data('id');
        var nama = $(this).data('nama');

        $('.modal-body p').html('<b>Semua barang dengan kategori '+nama+' akan otomatis ikut terhapus</b>. Apakah anda yakin ingin menghapus kategori <b>'+nama+'</b>?')

        $('.modal-content form').attr('action', "/admin/kategori/hapus/"+kode);
        $('.modal-footer button[type=submit]').html('Yes');
    });

    // BARANG
    // Tambah 
    $('.tambah-barang').on('click', function () {
        var kode = $(this).data('id');
        //console.log(kode);
        $('.id-barang').val(kode);
        $('#exampleModalLabel').html('Tambah Barang');
        $('.show-id').html(kode);
        $('.btn-submit').html('Tambah');
        $('.modal-body form').attr('action', '/admin/barang/simpan');
        $('.modal-body form')[0].reset();
    });

    //Ubah
    $('.edit-barang').on('click', function () {
        var kode = $(this).data('id'); 
        // console.log(kode);
        $('.id-barang').val(kode);  //merubah value kode sesuai dengan input hidden
        $('#exampleModalLabel').html('Ubah barang');  //merubah nama title modal
        $('.show-id').html(kode);  //menampilkan kode
        $('.btn-submit').html('Ubah');    
        $('.modal-body form').attr('action', '/admin/barang/ubah');

        // mengambil data database
        $.ajax({
            url: '/admin/barang/getBarangbyId',
            data: {
                id_barang: kode
            },
            method: 'post',
            dataType: 'json',
            success: function (data) {
            // console.log(data);
            $('.nm-barang').val(data.nm_barang);
            $('.kategori-brg').val(data.kategori);
            $('.satuan-brg').val(data.satuan);
            $('.harga-brg').val(data.harga);
            $('.stok-brg').val(data.stok);
            }
        });
    });

    //Hapus
    $('.hapus-barang').on('click', function () {
        var kode= $(this).data('id');
        var nama = $(this).data('nama');

        $('.modal-body p').html('Apakah anda yakin ingin menghapus data barang <b>'+nama+'</b>?')

        $('.modal-content form').attr('action', "/admin/barang/hapus/"+kode);
        $('.modal-footer button[type=submit]').html('Yes');
    });

    // BARANG MASUK
    // Detail Barang Masuk
    $('.detail-pembelian').on('click', function(){
        var id = $(this).data('id');
        var supplier = $(this).data('supplier');
        // console.log(id);

        // Mengambil data dari database barang masuk
        $.ajax({
            url: '/admin/brgmasuk/getBrgmasukbyId',
            data: {
                id_brgmasuk: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('.id-brgmasuk').html(data.id_brgmasuk);
                $('.tgl-pem').html(data.created_at);
                $('.sup-pem').html(''+supplier);
                $('.catatan-pem').html(data.catatan);
                $('.struk-pem').attr('src', '/assets/img/'+ data.foto_struk);
                $('.total-pem').html('Rp ' + data.total);
                $('.ubah-pem').attr('href','/admin/brgmasuk/ubah/'+ data.id_brgmasuk)
                $('.cetak-detail').attr('href', '/admin/brgmasuk/cetakdetail/'+data.id_brgmasuk)
            }
        });

        
        // memanggil data dari database item barang masuk
        $.ajax({
            url: '/admin/brgmasuk/getItembyBrgmasuk',
            data: {
                id_brgmasuk: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data){
                var show = Array();
                for (var index = 0; index < data.length; index++) {
                    show[index] = '<tr>' +
                                        '<td>' + (index+1) + '</td>' +
                                        '<td>' + data[index].id_barang + '</td>' +
                                        '<td>' + data[index].nm_barang + '</td>' +
                                        '<td>' + data[index].satuan + '</td>' +
                                        '<td>' + data[index].qty + '</td>' +
                                        '<td>' + data[index].harga + '</td>' +
                                        '<td class="text-right">' + data[index].harga*data[index].qty+'</td>' +
                                    '</tr>';

                }
                document.getElementById('show-detail').innerHTML = show.join(" ");
            }
        });
    });
    // detail barang masuk end

    // hapus item ubah data
    // $('.hapus-item').on('click', function() {
    //     var id_barang = $(this).data('barang');
    //     var id_brgmasuk = $(this).data('brgmasuk');
    // });
    

    // Hapus data Barang masuk
    $('.hapus-masuk').on('click', function(){
        var id = $(this).data('id');

        $('.modal-body p').html('Apakah anda yakin ingin menghapus <b>'+id+'</b>?')

            $('.modal-content form').attr('action', "/admin/brgmasuk/delete/"+id);
            $('.modal-footer button[type=submit]').html('Yes');
    });

    // tombol edit
    // $('.ubah-pem').on('click', function(){
    //     var id = $(this).data('id')
    //     $.ajax({
    //         url: '/admin/brgmasuk/getBrgmasukbyId',
    //         data: {
    //             id_brgmasuk: id
    //         },
    //         method: 'post',
    //         dataType: 'json',
    //         success: function(data) {
    //             $('.kode-beli').html(data.id_brgmasuk);
    //             $('.sup-pem').html(data.id_supplier);
    //         }
    //     });
    // });

    // Barang Masuk end

    // Barang Keluar
    // Detail Barang Keluar
    $('.detail-keluar').on('click', function(){
        var id = $(this).data('id');
        // console.log(id);

        // Mengambil data dari database barang masuk
        $.ajax({
            url: '/admin/brgkeluar/getBrgkeluarbyId',
            data: {
                id_brgkeluar: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('.id-brgkeluar').html(data.id_brgkeluar);
                $('.tanggal-keluar').html(data.created_at);
                $('.catatan-keluar').html(data.catatan);
                $('.total-keluar').html('Rp ' + data.total);
                $('.ubah-keluar').attr('href','/admin/brgkeluar/ubah/'+ data.id_brgkeluar)
                $('.cetak-keluar').attr('href','/admin/brgkeluar/cetakdetail/'+ data.id_brgkeluar)
            }
        });

        
        // memanggil data dari database item barang masuk
        $.ajax({
            url: '/admin/brgkeluar/getItembyBrgkeluar',
            data: {
                id_brgkeluar: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data){
                var show = Array();
                for (var index = 0; index < data.length; index++) {
                    show[index] = '<tr>' +
                                        '<td>' + (index+1) + '</td>' +
                                        '<td>' + data[index].id_barang + '</td>' +
                                        '<td>' + data[index].nm_barang + '</td>' +
                                        '<td>' + data[index].satuan + '</td>' +
                                        '<td>' + data[index].qty + '</td>' +
                                        '<td>' + data[index].harga + '</td>' +
                                        '<td class="text-right">' + data[index].harga*data[index].qty+'</td>' +
                                    '</tr>';

                }
                document.getElementById('show-detail').innerHTML = show.join(" ");
            }
        });
    });
    // detail barang masuk end

    $('.hapus-keluar').on('click', function(){
        var id = $(this).data('id');

        $('.modal-body p').html('Apakah anda yakin ingin menghapus <b>'+id+'</b>?')

            $('.modal-content form').attr('action', "/admin/brgkeluar/hapus/"+id);
            $('.modal-footer button[type=submit]').html('Yes');
    });

    //SUPPLIER
    //tambah data
    $('.tambah-user').on('click', function () {
        var kode = $(this).data('id'); 
        //console.log(kode);
        $('.id-user').val(kode);
        $('#exampleModalLabel').html('Tambah User');
        $('.show-id').html(kode);
        $('.btn-submit').html('Tambah');
        $('.modal-body form').attr('action', '/admin/user/simpan');
        $('.modal-body form')[0].reset();
    });

    // ubah supplier
    $('.edit-user').on('click', function () {
        var kode = $(this).data('id'); 
        // console.log(kode);
        $('.id-user').val(kode);  //merubah value kode sesuai dengan input hidden
        $('#exampleModalLabel').html('Ubah User');  //merubah nama title modal
        $('.show-id').html(kode);  //menampilkan kode
        $('.btn-submit').html('Ubah');    
        $('.modal-body form').attr('action', '/admin/user/ubah');

        // mengambil data database
        $.ajax({
            url: '/admin/user/getUserbyId',
            data: {
                id_user: kode
            },
            method: 'post',
            dataType: 'json',
            success: function (data) {
            // console.log(data);
            $('.nm-user').val(data.nama);
            $('.alamat-user').val(data.alamat);
            $('.no_hp-user').val(data.no_hp);
            $('.username-user').val(data.username);
            $('.password-user').val(data.password);
            $('.level-user').val(data.level);
            }
        });
    });

    // Hapus data supplier berdasarkan id
    $('.hapus-user').on('click', function () {
        var kode= $(this).data('id');
        var nama = $(this).data('nama');

        $('.modal-body p').html('Apakah anda yakin ingin menghapus supplier <b>'+nama+'</b>?')

        $('.modal-content form').attr('action', "/admin/user/hapus/"+kode);
        $('.modal-footer button[type=submit]').html('Yes');
    });

});

// Merubah Gambar
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

// Merubah format rupian 


function format_rupiah(value) {
    var reverse = value.toString().split('').reverse().join('');
    var ribuan = reverse.match(/\d{1,3}/g);
    var ribuan = ribuan.join()('.').split('').reverse().join('');

    return ribuan;
}

 // perhitungan total harga
    function total() {
        var n = $('.count-item').val();
        var totalItem = Array();
        var total = 0;

        for (var index = 0; index < n; index++)
        {
            totalItem[index] = $('.total-harga-'+(index+1)).val();
        }

        for (var index = 0; index < n; index++)
        {
            total += parseFloat(totalItem[index]);
        }

        return total;
    }

    // Menampilkan Perhitungan TOTAL
    // barang masuk
    $('.total-tran').val(total());
    $('.show-total-tran').html('Rp ' + total());
    
    // barang keluar
    $('.total-keluar').val(total());
    $('.show-total-keluar').html('Rp ' + total());

    // Perubahan input Harga
    function harga(id) {
        var harga =  $('.harga-'+id).val();

        $('.harga-' + id).val(harga);

        var qty = $('.qty-'+id).val();

        $('.show-subtotal-'+id).html('Rp '+ (harga*qty));
        $('.total-harga-'+id).val(harga*qty);
        
        // barang masuk
        $('.total-tran').val(total());
        $('.show-total-tran').html('Rp ' + total());
        
        // barang keluar
        $('.total-keluar').val(total());
        $('.show-total-keluar').html('Rp ' + total());
        
    }

    // Perubahan input QTY
    function qty(id) {
        var qty =  $('.qty-'+id).val();

        $('.qty-' + id).val(qty);

        var harga = $('.harga-'+id).val();


        $('.show-subtotal-'+id).html('Rp '+ (qty*harga));
        $('.total-harga-'+id).val(qty*harga);
        
        // barang masuk
        $('.total-tran').val(total());
        $('.show-total-tran').html('Rp ' + total());

        // barang keluar
        $('.total-keluar').val(total());
        $('.show-total-keluar').html('Rp ' + total());
        
    }