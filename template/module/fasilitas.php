<div id="viewData"></div>

<script>
    $(document).ready(function(){
        loadData()

        function loadData(){
            $.ajax({
                url: 'template/ajax/fasilitas.php',
                dataType: 'html',
                success: function(data){
                    $('#viewData').html(data);

                    $('.edit').click(function(){
                        let id = $(this).attr('value');

                        $.ajax({
                            url: 'template/ajax/modal_edit.php?modal=fasilitas&&id='+ id,
                            dataType: 'html',
                            success: function(data){
                                $('#modal-edit-fasilitas').html(data);
                            }
                        })
                    })

                    $('.hapus').click(function(){
                        let id = $(this).attr('value');
                        swal({
                            title: 'Delete?',
                            icon: 'warning',
                            text: 'Are you sure to delete item?',
                            dangerMode: true,
                            buttons: true,
                        }).then(function(result){
                            if(result){
                                $.ajax({
                                    url: 'proses/fasilitas.php?delete&&id='+ id,
                                    dataType: 'json',
                                    success: function(data){
                                        if(data.hasil == true){
                                            swal({
                                                title: 'Success',
                                                icon: 'success',
                                                text: data.pesan
                                            });
                                            loadData();
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
                        })
                    })
    
                    $('#formTambah').submit(function(e){
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
                                    $('#modal-tambah').modal('hide');
                                    $('.modal-backdrop').remove();
                                    $('body').removeClass('modal-open');
                                    swal({
                                        title: 'Success',
                                        icon: 'success',
                                        text: data.pesan
                                    })
                                    loadData();
                                } else {
                                    swal({
                                        title: 'Failed',
                                        icon: 'error',
                                        text: data.pesan
                                    })
                                }
                            }
                        })
                    })

                    $('#formEdit').submit(function(e){
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
                                    $('#modal-edit').modal('hide');
                                    $('.modal-backdrop').remove();
                                    $('body').removeClass('modal-open');
                                    swal({
                                        title: 'Success',
                                        icon: 'success',
                                        text: data.pesan
                                    })
                                    loadData();
                                } else {
                                    swal({
                                        title: 'Failed',
                                        icon: 'error',
                                        text: data.pesan
                                    })
                                }
                            }
                        })
                    })
                }
            })
        }
    })
</script>