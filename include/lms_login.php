<?php 
if( !(isset($ld)) ) {
    $ld = "./";
}
?>
                        <span class="clearfix">
                            <form action="<?php echo $ld; ?>processor/login.php" method="POST">
                                <fieldset>
                                    <legend>Login Here</legend>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="email-uname" type="text" class="form-control" value="<?php echo $user_name; ?>" placeholder="Email OR Username" required />
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input name="pword" type="password" class="form-control" value="<?php echo $user_password; ?>" placeholder="Password" required />
                                    </div>
                                    <label><input type="checkbox" name="remember" checked /> remember me</label>
                                    <br>
                                    <div class="pull-right">
                                        <input id="login" type="submit" class="btn btn-primary btn-sm" value="Login" /> | <a id="register" class="btn btn-warning btn-sm" href="register/">Register</a> | <a id="as-admin" class="btn btn-info btn-sm" href="admin/">Admin</a>
                                    </div>
                                </fieldset>
                            </form>
                        </span>

                        <hr>