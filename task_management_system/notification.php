<?php
session_start();
if(isset($_POST["view"]))
{
    include("db_connect.php");
    if($_POST["view"] != '')
    {
        $update_query = $conn->query("UPDATE users_notifications SET status=1 WHERE status=0 and user_id = {$_SESSION['login_id']}");
    }
    $qry = $conn->query("SELECT * FROM users_notifications WHERE user_id = {$_SESSION['login_id']} ORDER BY id DESC LIMIT 5");
    $output = '';

    if($qry->num_rows > 0)
    {
        while($row = $qry->fetch_array())
        {
            $output .= '
    <a class="dropdown-item" href="./index.php?page=view_project&id='.$row["project_id"].'">Bạn được thêm vào dự án <strong>'.$row["project_name"].'</strong><br />
    </a>
   <div class="dropdown-divider"></div>
   ';
        }
    }
    else
    {
        $output .= '<li><a class="dropdown-item" ref="#" class="text-bold text-italic">Không có thông báo nào</a></li>';
    }

    $query_1 = $conn->query("SELECT * FROM users_notifications WHERE status=0 and user_id = {$_SESSION['login_id']}");
    $count = $query_1->num_rows;
    $data = array(
        'notification'   => $output,
        'unseen_notification' => $count
    );
    echo json_encode($data);
}
?>
