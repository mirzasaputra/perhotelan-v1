<div id="view"></div>

<script>
    $(document).ready(function(){
        loadData_perusahaan();


        function loadData_perusahaan(){

            $.get('template/ajax/perusahaan.php', function(data){
                $('#view').html(data);

                $('#imgFile').change(function(){
                    imgPreview(this);
                })

                $('#form').submit(function(e){
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
                                swal({
                                    title: 'Success',
                                    icon: 'success',
                                    text: data.pesan
                                });
                                loadData_perusahaan();
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

        }

    })

    function imgPreview(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#imgPreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>