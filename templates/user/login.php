<form action="">
<span id="loginActionStatus"></span>
                <table>
                    <tr>
                        <th colspan="3">
                            You are not logged in.  Please log in to continue. 
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Username:
                        </td>
                        <td>
                            <input type="text" id="username">
                        </td>
                        <td rowspan = "2">
                            <input type="button" value = "Login" id="btnLogin">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password: 
                        </td>
                        <td>
                            <input type="password" id="password">
                        </td>
                    </tr>
                    <tr><td colspan="2"><br /><a href="/lostpassword">Lost Password?</a></td></tr>
                    <?php if ($this->denied == true) { ?>
                    <tr>
                        <th colspan="3">
                            Incorrect username or password, please try again.
                        </th>
                    </tr>
                    <?php } ?>
                    
                </table>
            </form>
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/login.js"); ?>