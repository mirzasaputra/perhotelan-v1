<div id="viewLaundry"></div>

<script>
    $(document).ready(function(){
        loadData_laundry();
        

        function loadData_laundry(){
            <?php if(isset($_GET['cari'])){ ?>
            $.get('template/ajax/laundry.php?cari=<?=$_GET['cari'];?>&&page=<?=(isset($_GET['page'])) ? (int)$_GET['page'] : 1;?>', function(data){
                $('#viewLaundry').html(data);
            <?php } else { ?>
            $.get('template/ajax/laundry.php?page=<?=(isset($_GET['page'])) ? (int)$_GET['page'] : 1;?>', function(data){
                $('#viewLaundry').html(data);
            <?php } ?>

                $.get('template/ajax/modal_edit.php?modal=laundry&id=', function(data){
                    $('#viewDataTab').html(data);
                });

                $('#formSet').submit(function(e){
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

    });
</script>