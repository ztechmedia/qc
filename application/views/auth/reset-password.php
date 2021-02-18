<div class="login-container lightmode">

    <div class="login-box animated fadeInDown">
        <div class="login-body">
            <div class="login-title"><strong>Reset Password</strong></div>
            <h3 style="font-weight: bold; color: red; text-align: center;" id="token"></h3>
            <form class="form-horizontal auth-action"
                data-url="<?=base_url("auth/reset/$token_password")?>"
                data-btnclass=".reset-btn"
                data-btnname="Reset Password">
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="password" id="password" type="password" class="form-control" placeholder="Password" />
                        <span class="help-block form-error" id="password-error"><span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="confirm" id="confirm" type="password" class="form-control" placeholder="Ulangi Password" />
                        <span class="help-block form-error" id="confirm-error"><span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                     
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block reset-btn" type="submit">Rreset</button>
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