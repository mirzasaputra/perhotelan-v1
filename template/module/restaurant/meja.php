<div id="viewMeja"></div>

<script>
    $(document).ready(function(){

        loadData_meja();

        function loadData_meja(){
            
            $.get('template/ajax/restaurant/meja.php', function(data){
                $('#viewMeja').html(data);

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
                                url: 'proses/hapus.php?id='+id+'&&hapus=meja',
                                dataType: 'json',
                                success: function(data){
                                    if(data.hasil == true){
                                        swal({
                                            title: 'Success',
                                            icon: 'success',
                                            text: data.pesan
                                        });
                                        loadData_meja();
                                    } else {
                                        swal({
                                            title: 'Failed',
                                            icon: 'error',
                                            text: datta.pesan
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
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data.hasil == true){
                                $('#formModal').modal('hide');
                                $('.modal-backdrop').remove();
                                $('body').removeClass('modal-open');
                                $('body').removeAttr('style');
                                swal({
                                    title: 'Success',
                                    icon: 'success',
                                    text: data.pesan
                                });
                                loadData_meja();
                            } else {
                                swal({
                                    title: 'Failed',
                                    icon: 'error',
                                    text: data.pesan
                                });
                            }
                        }
                    });
                });

                $('.tambah').click(function(){
                    $('#modal-title').html('Tambah');
                    $('#formModal').attr('action', 'proses/meja_act.php?tambah');
                    $('#modal-submit').html('<i class="fas fa-paper-plane"></i> Tambah');
                });

                $('.ubah').click(function(){
                    let id = $(this).attr('value')
                    $('#modal-title').html('Edit');
                    $('#formModal').attr('action', 'proses/meja_act.php?id='+id+'&ubah');
                    $('#modal-submit').html('<i class="fas fa-paper-plane"></i> Edit');

                    $.ajax({
                        url: 'template/ajax/restaurant/ubah.php?id='+id+'&meja',
                        dataType: 'json',
                        success: function(data){
                            $('#no_meja').val(data.kd_meja);
                            $('#status').val(data.status);
                            console.log(data);
                        }
                    })
                });
            });

        }

    });
</script>