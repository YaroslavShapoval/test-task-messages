<?php

/**
 * @var \source\core\view\View $this
 */

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                </div>

                <div class="panel-body">
                    <form action="/login" method="post" id="login_form" data-validate_url="/login/validate">
                        <div id="alerts"></div>

                        <div class="form-group">
                            <label for="loginInputLogin">Login</label>
                            <input type="text" name="login" class="form-control" id="loginInputLogin" placeholder="Login">
                        </div>

                        <div class="form-group">
                            <label for="loginInputPassword">Password</label>
                            <input type="password" name="password" class="form-control" id="loginInputPassword" placeholder="Password">
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>