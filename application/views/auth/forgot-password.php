<div class="login-container lightmode">

    <div class="login-box animated fadeInDown">        
        <div class="login-body">
            <div class="login-title"><strong>Lupa Password</strong></div>
            <form class="form-horizontal auth-action"
                data-url="<?=base_url("auth/send-link-forgot")?>"
                data-btnclass=".send-btn"
                data-btnname="Kirim Link">
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="email" id="email" type="email" class="form-control" placeholder="E-mail" />
                        <span class="help-block form-error" id="email-error"><span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <a href="<?=base_url("login")?>" class="btn btn-link btn-block">Kembali ke Login</a>
                    </div>  
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block send-btn" type="submit">Kirim Link</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<style>
    .login-container {
        height: 100vh;
    }
</style>