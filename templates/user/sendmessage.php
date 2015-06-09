<h3>Send Direct Message</h3>

<form action="">
<span id="contactActionStatus"></span>
                <table>
                    <tr>
                        <td>
                            Send Message To : <?php echo $this->userName; ?>
                        </td>
                        <td rowspan = "2">
                            <input type="button" value = "Send" id="btnSendDirect">
                        </td>
                        <td rowspan = "2">
                            <textarea cols="50" rows="5" id="txtMessageBody"></textarea>
                        </td>
                        <input type="hidden" id="uid" value="<?php echo $this->userId; ?>">
                    </tr>
                </table>
            </form>
            
[<a href="/user/myaccount">Back</a>]            
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/user.js"); ?>