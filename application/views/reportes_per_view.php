<?php 
$erfecha=$head='';
//$reserv=$datos->result_array();
$reserv_aux=$datos->result_array(0);
for ($i=0;$i<count($reserv);$i++) {
    $row=$reserv->result_array($i);
    if($resrv_aux==$row['fecha']){
       $head.='<th>'.'</th>';
    }
}

?>