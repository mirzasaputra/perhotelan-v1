<div id="viewMenu"></div>

<script>
    $(document).ready(function(){
        loadData_menu();

        function loadData_menu(){
            $.get('template/ajax/restaurant/menu.php', function(data){
                $('#viewMenu').html(data);

                $('.hapus').click(function(){
                    let id = $(this).attr('value');
                    swal({
                        title: 'Hapus?',
                        icon: 'warning',
                        text: 'Data yang dihapus tidak bisa dikembalikan',
                        buttons: true,
                        dangerMode: true
                    }).then(function(willdelete){
                        if(willdelete){
                            $.ajax({
                                url: "proses/hapus.php?id="+id+"&hapus=menu",
                                dataType: "json",
                                success: function(data){
                                    if(data.hasil == true){
                                        swal({
                                            title: 'Success',
                                            icon: 'success',
                                            text: data.pesan
                                        });
                                        loadData_menu();
                                    } else {
                                        swal({
                                            title: 'Failed',
                                            icon: 'error',
                                            text: data.pesan
                                        });
                                    }
                                }
                            });
                        }
                    });
                });

                $('#formTambahMenu').submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data.hasil == true){
                                $('#modalTambahMenu').modal('hide');
                                $('.modal-backdrop').remove();
                                $('body').removeClass('modal-open');
                                $('body').removeAttr('style');
                                swal({
                                    title: 'Success',
                                    icon: 'success',
                                    text: data.pesan
                                });
                                loadData_menu();
                            } else {
                                swal({
                                    title: 'Failed',
                                    icon: 'error',
                                    text: data.pesan
                                });
                            }
                            console.log(data);
                        }
                    })
                });

                $('.tambah').click(function(){
                    $('#modalLabel').html('<i class="fas fa-utensils"></i> Add Menu');
                    $('#modalButton').html('<i class="fas fa-paper-plane"></i> Add');
                    $('#formTambahMenu').attr('action', 'proses/tambah_menu.php');
                });

                $('.ubah').click(function(){
                    let id = $(this).attr('value');

                    $('#modalLabel').html('<i class="fas fa-utensils"></i> Edit Menu');
                    $('#modalButton').html('<i class="fas fa-pencil-alt"></i> Edit');
                    $('#formTambahMenu').attr('action', 'proses/ubah_menu.php?id='+id);
                    $('#upload').removeAttr('required');

                    $.ajax({
                        url: "template/ajax/restaurant/ubah.php?id="+id+"&menu",
                        dataType: "json",
                        success: function(data){
                            $('#nama').val(data.nama_menu);
                            $('#harga').val(data.harga_menu);
                            $('#kategori').val(data.kategori);
                        }
                    });
                });

            });

        }
    });
</script>