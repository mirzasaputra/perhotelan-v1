<div id="viewTamu"></div>
<div id="tambahTamu"></div>
<div id="editTamu"></div>
<script>
    $(document).ready(function(){
        loadData_tamu();

        function loadData_tamu(){
            $.get('template/ajax/tamu.php', function(data){
                $('#viewTamu').html(data);

                $.get('template/module/tambah_tamu.php?module=tambah_tamu', function(data){
                    $('#tambahTamu').html(data);

                    $('.edit').click(function(){
                        let id = $(this).attr('value');
                        $.get('template/ajax/edit_tamu.php?id='+id, function(data){
                            $('#editTamu').html(data);
                            $('#viewTamu').hide();
                            
                            $('#formEditTamu').submit(function(e){
                                e.preventDefault();
                                $.ajax({
                                    url: 'proses/edit.php?modal=tamu',
                                    method: $(this).attr('method'),
                                    data: new FormData(this),
                                    dataType: 'JSON',
                                    contentType: false,
                                    processData: false,
                                    success: function(data){
                                        if(data.hasil == true){
                                            $('#viewTamu').show();
                                            $('#editTamu').hide();
                                            $('#tambahTamu').hide();
                                            swal({
                                                title: 'Success',
                                                icon: 'success',
                                                text: data.pesan
                                            });
                                            loadData_tamu();
                                        }
                                        else {
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
                                    url: 'proses/hapus.php?id='+id+'&&hapus=tamu',
                                    dataType: 'JSON',
                                    success: function(data){
                                        if(data.hasil == true){
                                            swal({
                                                title: 'Success',
                                                icon: 'success'
                                            });
                                            loadData_tamu();
                                        }
                                        else {
                                            swal({
                                                title: 'Failed',
                                                icon: 'error'
                                            });
                                        }
                                    }
                                });
                            }
                        });
                    });
                });

                $('#tambahTamu').hide();

                $('.edit').click(function(){
                    $('#editTamu').show();
                    $('#viewTamu').hide();
                    $('#tambahTamu').hide();
                })

                $(".tambah").click(function(){
                    $('#tambahTamu').show();
                    $('#viewTamu').hide();
                });
            });
        }

    });
</script>