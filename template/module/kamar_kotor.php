<div id="viewData"></div>

<script>

    $(document).ready(function(){

        loadData_kamar();

        function loadData_kamar(){

            $.get('template/ajax/kamar_kotor.php', function(data){
                $('#viewData').html(data);

               $('#update').click(function(){
                   let id = $(this).attr('value');
                   $('#id').val(id);
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
               });
            });

        }

    });

</script>