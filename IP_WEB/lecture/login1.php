<?php 
/*
* @author Kely Weerasooriya
* @project Lecturer Part of PUSL2003
* @since 2020-02
*
*/
if(!isset($system_path)){ die('You shall not pass :)'); } 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <style type="text/css">
            body{
                background-image: url("wp2501108-cb-background-wallpapers.jpg");
                background-size: cover;
                height: 100%;
                overflow: hidden;
    
            }

        header
        {
            margin:0px;
            background:rgba(0, 0, 0, 0.8);
            height:100vh;
        }

    .h2div
    {
            border:none;

            border-bottom:1px solid green;
            border-width: 5px;
            width:200px;
            height: 60px;
            border-radius: 40px;

    
    
    }
        .div1{
            padding: 20px;
            transform: translate(0px,120px);
            color:white;
            border:none;
            border-top: 1px solid green;
            
            border-radius: 20px;
            border-bottom: 1px solid green;
            border-width: 5px;
            width:370px;
            height: 400px;
        }
        .div2{
            transform: translate(0px,50px);
            
            
        }
        .div3{
            width:200;
            height: 25px;
            border:2px solid white;
            border-radius: 5px;
            padding:2px;
            background-color: white;
            color:Black;
            font-family:arial black;  
            
        }
        #btn:hover
        {
        
            background-color: orange;
            color:white;
            border:transparent;
            transition: 0.6s ease;
            font-size: 1em;

        }
        
        .UPdiv{
            float:left;
            color:white;
            font-family: arial black;
        
        }
        .inputtext
        {padding: 5px;
        background:transparent;
        border:none;
        border-bottom:2px solid white;
        color:white;

    }  
    #inputtext:hover
    {
        color: black;
        background: orange;
        border:transparent;
        border-radius: 10px;
        font-size: 14px;
        transition: 0.9s ease;
    }
        
        </style>
    </head>
    <body>
        <div class="maindiv">
            <header>
                <form id="kelyform" method="post" name="kelyform" target="_self">
                    <center>
                        <div class="div1">&nbsp;
                            <div class="h2div">
                                <marquee>
                                    <h2>Login Here</h2>
                                </marquee>
                            </div>
                            &nbsp;
                            <div class="div2">&nbsp;
                                <div class="UPdiv">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password:
                                </div>
                                <br />
                                <br />
                                <input class="inputtext" id="inputtext" name="luser"placeholder="Enter Username" required="required" type="text"/>&nbsp;&nbsp;
                                <input class="inputtext" id="inputtext" name="lpw" placeholder="Enter Password" required="required" type="password" />
                                <br />
                                <input type="hidden" id="loginform" name="loginform" value="4348260098DD5" />
                                <br />
                                <br />
                                &nbsp;
                                <div>
                                    <button class="button" id="btn" value="Login">Login</button>
                                </div>
                            </div>
                        </div>
                    </center>
                </form>
            </header>
        </div>
    </body>
</html>