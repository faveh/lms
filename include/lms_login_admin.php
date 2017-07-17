<?php 
if( !(isset($ld)) ) {
    $ld = "./";
}
?>
                        <span class="clearfix">
                            <form action="<?php echo $ld; ?>processor/login_admin.php" method="POST">
                                <fieldset>
                                    <legend>Admin Login Here</legend>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="email-uname" type="text" class="form-control" value="<?php echo $admin_name; ?>" placeholder="Email OR Username" required autocomplete="off" />
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input name="pword" type="password" class="form-control" placeholder="Password" required />
                                    </div>
                                    <label><input type="checkbox" name="remember" checked /> remember me <span class="text-warning">(password excluded)</span></label>
                                    <br>
                                    <div class="pull-right">
                                        <input id="login" type="submit" class="btn btn-info btn-sm" value="Login" /> | <a id="register" class="btn btn-warning btn-sm" href="../register/">Register</a>
                                    </div>
                                </fieldset>
                            </form>
                        </span>