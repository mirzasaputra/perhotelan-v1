<div class="container-fluid">

    <div id="viewData"></div>

</div>

<script>
    $(document).ready(function(){

        loadData_laundry();

        function loadData_laundry(){

            $.get('template/ajax/list_laundry.php', function(data){
                $('#viewData').html(data);

                $('#form').submit(function(e){
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
                                loadData_laundry();
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

                $('.hapus').click(function(){
                    let id = $(this).attr('value');
                    $.ajax({
                        url: 'proses/laundry.php?id='+id+'&act=delete',
                        dataType: 'json',
                        success: function(data){
                            if(data.hasil == true){
                                loadData_laundry();
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

                $('#formKonfirmasi').submit(function(e){
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
                                swal({
                                    title: 'Success',
                                    icon: 'success',
                                    text: data.pesan
                                }).then(function(){
                                    window.location.assign('?module=laundry');
                                });
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

        }

    })
</script>