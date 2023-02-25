<style>
    #uni_modal .modal-content>.modal-footer,#uni_modal .modal-content>.modal-header{
        display:none;
    }
</style>
<div class="container-fluid" style="background: #D68AB2 ;">
    <form action="" id="registration">
        <div class="row">
        
        <h3 class="text-center" style="font-family: Script MT Bold;">Create New Account
            <span class="float-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </span>
        </h3>
            <hr>
        </div>
        <div class="row  align-items-center h-100">
            
            <div class="col-lg-5 border-right">
                
                <div class="form-group">
                    <label for="" class="control-label" style="font-family: Script MT Bold;">Firstname</label>
                    <input type="text" class="form-control form-control-sm form" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label" style="font-family: Script MT Bold;">Lastname</label>
                    <input type="text" class="form-control form-control-sm form" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label" style="font-family: Script MT Bold;">Contact</label>
                    <input type="text" class="form-control form-control-sm form" name="contact" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label" style="font-family: Script MT Bold;">Gender</label>
                    <select name="gender" id="" class="custom-select select" required>
                        <option style="font-family: Script MT Bold;">Male</option>
                        <option style="font-family: Script MT Bold;">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="form-group">
                    <label for="" class="control-label" style="font-family: Script MT Bold;">Default Delivery Address</label>
                    <textarea class="form-control form" rows='3' name="default_delivery_address"></textarea>
                </div>
                <div class="form-group">
                    <label for="" class="control-label" style="font-family: Script MT Bold;">Email</label>
                    <input type="text" class="form-control form-control-sm form" name="email" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label" style="font-family: Script MT Bold;">Password</label>
                    <input type="password" class="form-control form-control-sm form" name="password" required>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <a href="javascript:void()" id="login-show" style="color: black; font-family: Script MT Bold;">Already have an Account</a>
                    <button class="btn btn-secondary btn-flat" style="font-family: Script MT Bold;">Register</button>
                </div>
            </div>
        </div>
    </form>

</div>
<script>
    $(function(){
        $('#login-show').click(function(){
            uni_modal("","login.php")
        })
        $('#registration').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=register",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("Account succesfully registered",'success')
                        setTimeout(function(){
                            location.reload()
                        },2000)
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                        $('[name="password"]').after(_err_el)
                        end_loader()
                        
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                        end_loader()
                    }
                }
            })
        })
       
    })
</script>