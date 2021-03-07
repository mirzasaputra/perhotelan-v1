<!DOCTYPE hmtl>
<html>
    <head>
        <title>Login to account</title>
        <?php include "template/header.php";?>
    </head>
    <body class="bg">
        <div class="container">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 bg-light rounded m-0 p-0 shadow mx-auto mt-4 mt-md-9">
                <form action="" method="post" id="login">
                    <div class="modal-header bg-primary text-white shadow">
                        <h5 class="modal-title"><i class="fas fa-user pr-3"></i> Login</h5>
                    </div>
                    <div class="modal-body"><br>
                        <div class="alert alert-danger" id="error"></div>
                        <div class="form-group has-feedback">
                            <input type="text" name="username" class="form-control" placeholder="Username">
                            <span class='fas fa-envelope feedback'></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="password" id="pass" class="form-control" placeholder="Password">
                            <span class="fas fa-lock feedback"></span>
                        </div>
                        <input type="checkbox" style="margin-left: 15px;" id="show">
                        <label for="show" id="value">Show Password</label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</button>
                    </div>
                </form>
            </div>
        </div>

        <?php include "template/footer.php";?>

        <?php include "template/script.php";?>

        <script>
            $(document).ready(function(){
                $("#show").click(function(e){
                        if(document.getElementById("show").checked){
                            pass.setAttribute("type", "text");
                            document.getElementById("value").innerHTML = "Hide Password";
                        } else {
                            pass.setAttribute("type", "password");
                            document.getElementById("value").innerHTML = "Show Password";
                        }
                });

                $("#error").hide();

                $("#login").submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        url: "proses/proses_login.php",
                        method: $(this).attr("method"),
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data.hasil == true){
                                swal({
                                    title: "Success",
                                    icon: "success",
                                    text: data.pesan
                                }).then(function(){
                                    window.location.assign("");
                                });
                            }
                            else {
                                $("#error").show();
                                $("#error").html(data.pesan);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>