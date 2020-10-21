<?php
require_once './connect.php';
$allamforma= filter_input(INPUT_GET, "allamforma",);
$sql='SELECT `orszag`,`foldr_hely`,`allamforma` FROM `orszagok` WHERE `allamforma`="'.$allamforma.'" ORDER By 1';
$result=$conn->query($sql);
$table="";
if($result->num_rows>0){
    //rekordok feldolgozása
                $index=1;
             $result=$conn->query($sql);
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {
                    $table .= '<tr><td>'.$index++.'</td>';
                    $table .= '<td>'.$row["orszag"].'</td>';
                   $table .= '<td>'.$row["foldr_hely"].'</td>';
                    $table .= '<td>'.$row["allamforma"].'</td>';
                    $table .= '</tr>';
                }
            }
}else{
    $table='<tr><td colspan=3>valami</td>';
}
echo 'allamforma';
?>