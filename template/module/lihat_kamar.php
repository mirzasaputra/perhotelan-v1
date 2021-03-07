<div id="kamarView"></div>
<script>
    $(document).ready(function(){
        loadData_kamar()

        function loadData_kamar(){

            $.get('template/ajax/lihat_kamar.php', function(data){
                $('#kamarView').html(data);
                
                $('#formTambah').submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data.hasil == true){
                                $('#modal-tambah').hide();
                                $('.modal-backdrop').remove();
                                $('body').removeClass('modal-open');
                                swal({
                                    title: 'Success',
                                    icon: 'success',
                                    text: data.pesan
                                });
                                loadData_kamar();
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

                $('.edit').click(function(){
                    let id = $(this).attr('value');
                    $.get('template/ajax/modal_edit.php?id='+id+'&& modal=kamar', function(data){
                        $('#viewEditKamar').html(data);
                    });

                    $('#modalEdit').submit(function(e){
                        e.preventDefault();
                        $.ajax({
                            url: 'proses/edit.php?modal=kamar',
                            method: $(this).attr('method'),
                            data: new FormData(this),
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(data){
                                if(data.hasil == true){
                                    $('#modal-editData').hide();
                                    $('.modal-backdrop').remove();
                                    $('body').removeClass('modal-open');
                                    swal({
                                        title: 'Success',
                                        icon: 'success',
                                        text: data.pesan
                                    });
                                    loadData_kamar();
                                } else {
                                    swal({
                                        title: 'Failed',
                                        icon: 'error',
                                        text: data.pesan
                                    });
                                }
                            }
                        })
                    })
                });

                $('.hapus').click(function(){
                    let id = $(this).attr('value');
                    swal({
                        title: 'Hapus?',
                        icon: 'warning',
                        text: 'Data yang dihapus tidak bisa dikembalikkan',
                        buttons: true,
                        dangerMode: true
                    }).then(function(willdelete){
                        if(willdelete){
                            $.ajax({
                                url: 'proses/hapus.php?id='+id+'&& hapus=kamar',
                                dataType: 'JSON',
                                success: function(data){
                                    if(data.hasil == true){
                                        swal({
                                            title: 'Success',
                                            icon: 'success',
                                            text: data.pesan
                                        });
                                        loadData_kamar();
                                    } else {
                                        swal({
                                            title: 'Failed',
                                            icon: 'error',
                                            text: data.pesan
                                        });
                                    }
                                }
                            })
                        }
                    });
                })
            });

        }

    });
</script>