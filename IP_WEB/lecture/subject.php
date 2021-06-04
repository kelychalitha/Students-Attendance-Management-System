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
        <style>
            body{
                background-image: url("wp4108468-deep-learning-wallpapers.jpg"); 
                background-color: #cccccc;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
            }

            .dropdown{
                display:table-row;
                position:relative;
            }

            .dropdown button{
                border:none;
                padding:8px 16px;
                background-color:Red;
                color:white;
                transition:.3s;
                cursor:pointer;
                min-width:200px;
            }

            .dropdown:hover button{
                background-color:DarkGreen;
            }

            .dropdown div{
                background-color:#fff;
                box-shadow:0 4px 8px rgba(0,0,0,0.2);
                z-index:1;
                visibility:hidden;
                position:absolute;
                min-width:200px;
                opacity:0;
                transition:.3s;
                position:top;
            }

            #table1 {
                border-collapse: separate;
                border-spacing: 15px;
                display: table;
            }

            .dropdown:hover div{
                visibility:visible;
                opacity:1;
            }

            .dropdown div a{
                display:block;
                text-decoration:none;
                padding:8px;
                color:#000;
                transition:.1s;
                white-space:nowrap;
            }

            .dropdown div a:hover{
                background-color:DarkBlue;
                color:#fff;
            }
        </style>
    </head>
    <body>
        <?php echo $m_menu; ?>
        <center>
            <?php if(!isset($_GET['sub_id'])==TRUE || empty($_GET['sub_id'])==TRUE){ ?>
                <h1>Select Module</h1>
            <?php }else{ ?>
                <h1>Select subject for <?php echo $subjects[$_GET['sub_id']]['subject_name'].((!empty($subjects[$_GET['sub_id']]['descr'])==TRUE)?' - '.$subjects[$_GET['sub_id']]['descr']:''); ?></h1>
            <?php } ?>
            <br /><br /><br /><br />
            <b>
                <div id="table1">
                    <?php if(!isset($_GET['sub_id'])==TRUE || empty($_GET['sub_id'])==TRUE){ ?>
                        <div class="dropdown">
                            <button><b>Select module</b></button>
                            <div>
                                <?php
                                    foreach ($subjects as $v) {
										if(in_array($v['id'], unserialize($_SESSION['kelylogin']['sub']))){
											echo '<a href="?sub_id=' . $v['id'] . '">' . $v['subject_name'] . ((!empty($v['descr'])==TRUE)?' - '.$v['descr']:'') . '</a>';
										}
                                    }
                                ?>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="dropdown">
                            <button><b>Generate code</b></button>
                            <div>
                                <?php
                                    foreach ($cn as $v) {
                                        echo '<a href="?sub_id='.$_GET['sub_id'].'&sub=' . $v . '">' . str_replace('_', ' ', $v) . '</a>';
                                    }
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <br /><br /><br /><br />       
            </b>
        </center>
    </body>
</html>