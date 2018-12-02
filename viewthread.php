<?
// baglanti.
include ("server.php"); 

$t = $_GET['t']; 

$result = mysql_query("select * from topics where id = '$t'"); 

$result2 = mysql_query("select * from replies where tid = '$t'"); 

$r = mysql_fetch_array($result); 

$topic_title = $r['title']; 

$add_count = $r['views']+1;
mysql_query("update topics set views = '$add_count' where id = '$t'");
?> 

<a href="addreply.php?t=<? echo $t; ?>">Cevap Ekle</a><br />
<table cellpadding="5" cellspacing="1" border="0" style="width:90%;border:1px solid #000;">
  <tr>
    <td style="background-color:#eee;" colspan="2"><? echo $topic_title; ?></td>
  </tr>
  <tr>
    <td style="width:20%;background-color:#fafafa;" valign="top">
    <? 

    echo stripslashes($r['username']); ?></td>
    <td style="width:80%;background-color:#fafafa;">
    <?  

    echo nl2br(stripslashes($r['post'])); ?></td>
  </tr>
</table> 

<? 

while($r2 = mysql_fetch_array($result2))
{
?>
<br />
<table cellpadding="5" cellspacing="1" border="0" style="width:90%;border:1px solid #000;">
  <tr>
    <td style="background-color:#eee;" colspan="2">re: <? echo $topic_title; ?></td>
  </tr>
  <tr>
    <td style="width:20%;background-color:#fafafa;" valign="top">
    <? echo stripslashes($r2['username']); ?></td>
    <td style="width:80%;background-color:#fafafa;">
    <? echo nl2br(stripslashes($r2['post'])); ?></td>
  </tr>
</table>
<?
}
?>