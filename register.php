<html>
    <head>
        <title>Authentication System</title>
        <meta http-equiv="Content_Type" content="text/html; charset=utf-8" />
        <style>
            #container{width:400px;
            margin: 0 auto;}
        </style>
        <script type="text/javascript" language="javascript">
            function check_password(){
                if(document.getElementById("password").value != document.getElementById("repassword").value){
                    document.getElementById("lberrmsg").innerHTML="Password does not match.";
                    document.getElementById("repassword").value="";
                    document.getElementById("repassword").focus();
                    return false;
                }else{
                    document.getElementById("lberrmsg").innerHTML="";
                }

            }
        </script>
    </head>
    <body>
        <span style="font-family: 'Courier 10 Pitch', Courier, monospace; font-size: 13px; font-style: normal; line-height: 1.5;">
            <div id="container">
        </span>
        <h2>Registration for new member</h2>
        <form action="RegistrationController.php" method="post" name="register">
            <table padding="10">
                <tbody>
                    <tr>
                        <td><input type="text" size="80" id="custcode" name="custcode" placeholder="Customer Code" required="true"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" size="80" id="username" name="username" placeholder="Username" required="true"/></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    <tr>
                        <td><input type="password" size="80" id="password" name="password" placeholder="Password" required="true"/></td>
                    </tr>
                    <tr>
                        <td><input type="password" size="80" id="repassword" name="repassword" placeholder="Confirm Password" required="true" onfocusout="check_password()"/>
                            <br>
                            <label id="lberrmsg" style="color:red;" ></label>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    <tr>
                    <tr>
                        <td><input type="text" size="80" id="custname" name="custname" placeholder="Customer Name" required="true"/></td>
                    </tr>
                    <tr>
                        <td><input type="tel" size="80" id="mobile" name="mobile" pattern="[0-9]{3}-[0-9]{7}" placeholder="099-9999999" maxlength="11" required="true"/></td>
                    </tr>
                    <tr>
                        <td><input type="email" size="80" id="email" name="email" placeholder="Email Address" required="true"/></td>
                    </tr>
                    <tr>
                        <td>Birthdate<br><input type="date" size="80" id="birthdate" name="birthdate"/></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="submit" size="50" value="Save" />
                        &nbsp; &nbsp;<input type="reset" size="50" value="Clear" />
                        </td>
                    </tr>
                </tbody>   
            </table>
        </form></div>
    </body>
</html>



