<div id="viewUser"></div>
<div id="tambahUser"></div>
<div id="editUser"></div>

<script>
    $(document).ready(function(){
        loadData_user();
        
        function loadData_user(){

            $('#tambahUser').hide();
            
            $.get('template/ajax/user.php', function(data){
                
                $('#viewUser').html(data);

                $('.tambah').click(function(){
                    $('#viewUser').hide();
                    $('#tambahUser').show(); 
                });

                $.get('template/module/tambah_user.php', function(data){
                    $('#tambahUser').html(data);

                    $('#upload-image').change(function(){
                        readURL(this);
                    })

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
                                if(data.hasil==true){
                                    $('#tambahUser').hide()
                                    $('#viewUser').show();
                                    swal({
                                        title: 'Success',
                                        icon: 'success',
                                        text: data.pesan
                                    });
                                    loadData_user();
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
                });

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
                                url: 'proses/hapus.php?id='+id+'&&hapus=user',
                                dataType: 'json',
                                success: function(data){
                                    if(data.hasil == true){
                                        swal({
                                            title: 'Success',
                                            icon: 'success',
                                            text: data.pesan
                                        });
                                        loadData_user();
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

                $('.edit').click(function(){
                    let id = $(this).attr('value');
                    $.get('template/ajax/edit_user.php?id='+id, function(data){
                        $('#editUser').html(data);

                        $('#upload-file').change(function(){
                            readURL(this);
                        });

                        $('#formEditUser').submit(function(e){
                            e.preventDefault();
                            $.ajax({
                                url: 'proses/edit.php?modal=user',
                                method: $(this).attr('method'),
                                data: new FormData(this),
                                dataType: 'json',
                                contentType: false,
                                processData: false,
                                success: function(data){
                                    if(data.hasil == true){
                                        $('#editUser').hide();
                                        $('#viewUser').show();
                                        swal({
                                            title: 'Success',
                                            icon: 'success',
                                            text: data.pesan
                                        });
                                        loadData_user();
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
                    });

                    $('#editUser').show();
                    $('#viewUser').hide();
                    $('tambahUser').hide();
                });

            });

        }

    });
</script>