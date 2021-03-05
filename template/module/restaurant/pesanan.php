<div id="viewData"></div>

<script>
    $(document).ready(function(){

        loadData_pesanan();

        function loadData_pesanan(){
            $.get('template/ajax/restaurant/pesanan.php', function(data){
                $('#viewData').html(data);

                $('.lihat').click(function(){
                    let id = $(this).attr('value');
                    $.get('template/ajax/restaurant/view_pesanan.php?id='+id, function(data){
                        $('#viewDataModal').html(data);

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
                                        $('#myModal').modal('hide');
                                        $('.modal-backdrop').remove();
                                        $('body').removeClass('modal-open');
                                        swal({
                                            title: 'Success',
                                            icon: 'success',
                                            text: data.pesan
                                        });
                                        loadData_pesanan();
                                    }
                                    else {
                                        swal({
                                            title: 'Failed',
                                            icon: 'error',
                                            text: data.pesan
                                        });
                                    }
                                }
                            })
                        })
                    })
                })
            });
        }

    })
</script>