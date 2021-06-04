<?php
/*
* @author Kely Weerasooriya
* @project Lecturer Part of PUSL2003
* @since 2020-02
*
*/
session_start();

$system_path = getcwd();
include $system_path.'/../admin/db.php';
$conn = $con;
$sdebug = FALSE;
$col_sql_arr = array(
    'id',
    'subject_id',
    'lecturer_id',
    'date_added',
);
$title = 'PUSL2003 IP - ';
 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br />");
} else {
    if ($sdebug == TRUE) {
       echo "<h2>Connected successfully</h2>";
    } 
}


if (!mysqli_set_charset($conn, "utf8mb4" )) {
    die(printf("Error loading character set utf8mb4: %s\n", mysqli_error($conn)));
} else {
       if($sdebug == TRUE){
        echo "<h2> Current character set: " . mysqli_character_set_name($conn).  "</h2>";
    }
}
       
//Functions
function get_column_names($conn, $table, $col_arr, $sdebug) {
    $rows = array();
    $sql = 'DESCRIBE ' . $table;
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        if (!in_array($row['Field'], $col_arr) == TRUE) {
            $rows[] = $row['Field'];
        }
    }
    mysqli_free_result($result);
    return $rows;
}

function get_user($conn, $table, $luser, $lpw, $sdebug) {
    $user = array();
    $luser = mysqli_real_escape_string($conn, $luser);
    $lpw = mysqli_real_escape_string($conn, $lpw);
    $sql = 'select * from ' . $table . ' where username="' . $luser . '" and password=MD5("' . $lpw . '") order by id DESC limit 1';
    if ($sdebug == TRUE) {
        echo $sql . "<br />";
    }
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    $user = mysqli_fetch_array($query, MYSQLI_ASSOC);
    mysqli_free_result($query);

    if (!empty($user) == TRUE && isset($user['username']) == TRUE && !empty($user['username']) == TRUE) {
        return $user;
    }
    return FALSE;
}

function get_all_data_from_table($conn, $table, $sdebug) {
    $sql = 'select * from ' . $table;
    $query = mysqli_query($conn, $sql);
    if ($sdebug == TRUE) {
        echo $sql . "<br />";
    }
    if (!$query) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
    mysqli_free_result($query);
    return $result;
}

function get_all_data_from_table_where($conn, $table, $where, $sdebug) {
    $sql = 'select * from ' . $table;
    $sql .= ' where ' . $where;
    if ($sdebug == TRUE) {
        echo $sql . "<br />";
    }
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
    mysqli_free_result($query);
    return $result;
}

function insert_data_array_to_table($conn, $table, $data, $sdebug) {
    $sql = 'insert into ' . $table;
    $d_arr = array();
    foreach ($data as $k => $v) {
        $k = mysqli_real_escape_string($conn, $k);
        $v = mysqli_real_escape_string($conn, $v);
        $d_arr[$k] = '"' . $v . '"';
    }
    $sql .= '(' . implode(',', array_keys($d_arr)) . ') values (' . implode(',', array_values($d_arr)) . ')';             
    if ($sdebug == TRUE) {
        echo $sql . "<br />";
    }
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
}

function update_data_array_to_table($conn, $table, $data, $where=NULL, $sdebug=FALSE) {
    $sql = 'update ' . $table . ' set ';    
    $d_arr = array();
    foreach ($data as $k => $v) {
        $k = mysqli_real_escape_string($conn, $k);
        $v = mysqli_real_escape_string($conn, $v);
        $d_arr[$k] = '"' . $v . '"';
        
    }
    $i = 0;
    foreach ($d_arr as $k => $v) {
        if ($i == 0) {
            $sql .= $k . '=' . $v;
        } else {
            $sql .= ', ' . $k . '=' . $v;
        }
        $i++;
    }
    if(!empty($where)){
        $sql .= ' where ' . $where;
    }
    if ($sdebug == TRUE) {
        echo $sql . "<br />";
    }
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }

}

function generate_code($how_many_letters) {
    $seed = str_split(
            'ABCDEFGHJKLMNPQRSTUVWXYZ'
            . '23456789'
    );
    shuffle($seed);
    $rand = '';
    foreach (array_rand($seed, $how_many_letters) as $k) { 
        $rand .= $seed[$k];
    }
    return $rand;
}

//rest of code
if (!empty($_POST) == TRUE && is_array($_POST) == TRUE) {
    if ($sdebug == TRUE) {
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        echo '<hr>';
    }

    if (isset($_POST['loginform']) == TRUE && $_POST['loginform'] == '4348260098DD5') {
        $user = get_user($conn, 'lecturer_login', $_POST['luser'], $_POST['lpw'], $sdebug);
        if ($user != FALSE) {
            $_SESSION['kelylogin'] = array(
                'u-name' => $user['username'],
                'name'  => $user['name'],
                'faculty'  => $user['faculty'],
                'u-id'  => $user['uhash'],
				'sub'	=> $user['subjects'],
            );
        }
        $_POST = array();
        echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
    } else {
        
    }
}

if (!empty($_GET) == TRUE && is_array($_GET) == TRUE) {
    if (isset($_GET['logout']) == TRUE && !empty($_GET['logout']) == TRUE) {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
    } else {
        
    }
}

if ($sdebug == TRUE) {
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
    echo '<hr>';
}

if (!isset($_SESSION['kelylogin']) == TRUE || empty($_SESSION['kelylogin'] == TRUE)) {
    $title .= 'Lecturer Login page';
    include './login1.php';
} else {
	$cl = 'subject_code';
    $cn = get_column_names($conn, $cl, $col_sql_arr, $sdebug);    
    $subject_data = get_all_data_from_table($conn, 'subject', $sdebug);
    $subjects = array();
    foreach($subject_data as $v){
        $subjects[$v['id']] = $v;
    }

    if ($sdebug == TRUE) {
        echo "<pre>";
        var_dump(get_all_data_from_table($conn, 'subject', $sdebug));
        echo '</pre>';
    }
    $m_menu = '<div style="width:100%; color:white; background-color:DarkGray; text-align:center; padding:20px 0px 20px 0px;">
    Welcome, ' . $_SESSION['kelylogin']['name'] . ' | <a href="index.php">HomePage</a> | <a href="?logout=1">Log out</a> 
    </div>';
    if (isset($_GET['sub_id'])==TRUE && !empty($_GET['sub_id'])==TRUE && isset($_GET['sub']) == TRUE && !empty($_GET['sub']) == TRUE) {   
        $g_sub_id =  mysqli_real_escape_string($conn, $_GET['sub_id']);
        if ($sdebug == TRUE) {
            echo "<pre>";
            var_dump(get_all_data_from_table($conn, $cl, $sdebug));
            echo '</pre>';
        }     
        $timegone = strtotime('-5 WEEKS', time());
        $coden = '';
        $user_helper = get_all_data_from_table_where($conn, 'lecturer_login', 'uhash="'.$_SESSION['kelylogin']['u-id'].'" limit 1', $sdebug);
        $user_helper = $user_helper[0];        
        $code_array_from_database = get_all_data_from_table_where($conn, $cl, 'subject_id="'.$g_sub_id.'" and lecturer_id="' . $user_helper['id'] . '" and date_added>="' . date('Y-m-d H:i:s', $timegone) . '"', $sdebug);
        if (!empty($code_array_from_database) == TRUE && !empty($code_array_from_database[0]) == TRUE && !empty($code_array_from_database[0]['subject_id']) == TRUE && !empty($code_array_from_database[0]['lecturer_id']) == TRUE && !empty($code_array_from_database[0][$_GET['sub']]) == TRUE) {
            $coden = $code_array_from_database[0][$_GET['sub']];
        } elseif (!empty($code_array_from_database) == TRUE && !empty($code_array_from_database[0]) == TRUE  && !empty($code_array_from_database[0]['subject_id']) == TRUE && !empty($code_array_from_database[0]['lecturer_id']) == TRUE && empty($code_array_from_database[0][$_GET['sub']]) == TRUE) {
            $coden = generate_code(6);
            $x = update_data_array_to_table($conn, $cl, array($_GET['sub'] => $coden), 'subject_id="'.$g_sub_id.'" and lecturer_id="' . $user_helper['id'] . '" and date_added>="' . date('Y-m-d H:i:s', $timegone) . '"', $sdebug);
        } else {
            $coden = generate_code(6);
            $x = insert_data_array_to_table($conn, $cl, array('subject_id' => $g_sub_id, 'lecturer_id' => $user_helper['id'], $_GET['sub'] => $coden), $sdebug);
        }
        $title .= 'Subject Code page';
        include './subjectCode.php';
    } else {
        $title .= 'Subject page';
        include './subject.php';
    }
}

mysqli_close($conn);
?>