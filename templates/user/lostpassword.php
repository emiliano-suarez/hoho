<form action="">
<span id="lostPasswordActionStatus"></span>
                <table>
                    <tr>
                        <td>
                            Please enter your email :
                        </td>
                        <td>
                            <input type="text" id="emailaddress">
                        </td>
                        <td rowspan = "2">
                            <input type="button" value = "Send" id="btnPassword">
                        </td>
                    </tr>
                                        
                </table>
            </form>
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/login.js"); ?>