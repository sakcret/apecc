<?php $this->load->library('utl_apecc');?>
<table width="100%" >
<tr>
    <td colspan="3" align="center"><img src="./images/separator.png"></td>
</tr>
    <tr>
        <td width="29%" rowspan="2"><img src="./images/apecc_min.png"></td>
        <td width="42%"  ><center><?php echo " ".  date('d').' de '.$this->utl_apecc->getMesStr(date('m')).' del '.date('Y');?></center></td>
        <td width="29%" align="right" rowspan="2">Página {PAGENO} de {nbpg}</td>
</tr>
</table>
