<form action="">
<span id="profileActionStatus"></span>
	<h3>Claim your Company Profile Process</h3>
                <table>
                    <tr>
                        <td>
                            First Name:
                         </td>
                        <td>
                            <input type="text" id="firstName">
                        </td>
                        <td rowspan = "2">
                            <input type="button" value = "Submit" id="btnClaim">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Last Name: 
                        </td>
                        <td>
                            <input type="txt" id="lastName">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Company Name: 
                        </td>
                        <td>
                            <input type="txt" id="companyName">
                        </td>
                    </tr>
                    
                </table>
            </form>
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/profile.js"); ?>