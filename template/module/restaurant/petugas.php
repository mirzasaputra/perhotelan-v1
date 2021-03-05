<div id="viewPetugas"></div>

<script>
    $(document).ready(function(){
        
        loadData_petugas();

        function loadData_petugas(){

            $.get('template/ajax/restaurant/petugas.php', function(data){
                $('#viewPetugas').html(data);

                $('.tambah').click(function(){
                    $('#formModal').attr('action', 'proses/petugas.php?tambah');
                    $('#modal-title').html('<i class="fas fa-user"></i> Tambah User');
                    $('#modal-submit').html('<i class="fas fa-paper-plane"></i> Tambah');
                    $('#imgPreview').attr('src', 'assets/img/blank_images.svg');
                    $('#formModal').trigger('reset');
                });
            
                $('.ubah').click(function(){
                    let id = $(this).attr('value');
                    $('#formModal').attr('action', 'proses/petugas.php?id='+id+'&ubah');
                    $('#modal-title').html('<i class="fas fa-user"></i> Edit User');
                    $('#modal-submit').html('<i class="fas fa-paper-plane"></i> Edit');
                
                    $.ajax({
                        url: "template/ajax/restaurant/ubah.php?id="+id+"&petugas",
                        dataType: "json",
                        success: function(data){
                            $('#nama').val(data.nama_user);
                            $('#username').val(data.username);
                            $('#pass').val(data.password);
                            $('#passLama').val(data.password);
                            $('#level').val(data.level);
                            $('#no_telp').val(data.no_telp);
                            $('#imgPreview').attr('src', 'assets/img/'+data.image);
                            $('#gambarLama').val(data.image);
                        }
                    });
                });

                $('.hapus').click(function(){
                    let id = $(this).attr('value');
                    swal({
                        title: "Hapus?",
                        icon: "warning",
                        text: "Data yang dihapus tidak bisa dikembaikan",
                        buttons: true,
                        dangerMode: true
                    }).then(function(willdelete){
                        if(willdelete){
                            $.ajax({
                                url: "proses/hapus.php?id="+id+"&hapus=user",
                                dataType: "json",
                                success: function(data){
                                    if(data.hasil){
                                        swal({
                                            title: "Success",
                                            icon: "success",
                                            text: data.pesan
                                        });
                                        loadData_petugas();
                                    } else {
                                        swal({
                                            title: "Failed",
                                            icon: "error",
                                            text: data.pesan
                                        });
                                    }
                                }
                            });
                        }
                    });
                });

                $('#formModal').submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data.hasil == true){
                                $('#formModal').modal('hide');
                                $('.modal-backdrop').remove();
                                $('body').removeClass('modal-open');
                                swal({
                                    title: "Success",
                                    icon: "success",
                                    text: data.pesan
                                });
                                loadData_petugas();
                            } else {
                                swal({
                                    title: "Failed",
                                    icon: "error",
                                    text: data.pesan
                                });
                            }
                        }
                    });
                });
            });

        }

    });
</script>