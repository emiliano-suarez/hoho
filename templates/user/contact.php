<h3>Send Contact Message</h3>

<form action="">
<span id="contactActionStatus"></span>
                <table>
                    <tr>
                        <td>
                            Send Message To (username):
                        </td>
                        <td>
                            <input type="text" id="username">
                        </td>
                        <td rowspan = "2">
                            <input type="button" value = "Login" id="btnContact">
                        </td>
                        
                    </tr>
                </table>
            </form>
            
<hr />
  <h4>(test using direct link...)</h4>
  <li>Send Direct Message to User : <a href="/user/senddirect?uid=4">Test 4</a></li>
  <li>Send Direct Message to User : <a href="/user/senddirect?uid=5">Test 5</a></li>
<hr />
[<a href="/user/myaccount">Back</a>]            
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/user.js"); ?>