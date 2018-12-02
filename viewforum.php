<?
// Baglanti include.
include ("server.php"); 

$f = $_GET['f']; 

$result = mysql_query("select title from forums where id = '$f'"); 

$result2 = mysql_query("select * from topics where fid = '$f' order by timestamp desc"); 

$r = mysql_fetch_array($result); 

$forum_title = $r['title'];
?> 

<b>Görüntüleme: <? echo $forum_title; ?></b><br /><br /> 

<a href="addthread.php?f=<? echo $f; ?>">Cevap Yaz</a><br /> 

<table cellpadding="5" cellspacing="1" border="0" style="width:90%;border:1px solid #000;">
  <tr>
    <td style="background-color:#eee;">Baslatan</td>
    <td style="background-color:#eee;">Son Mesaj</td>
    <td style="background-color:#eee;">Cevaplar</td>
    <td style="background-color:#eee;">Görüntüleme</td>
  </tr>
<? 

while($r2 = mysql_fetch_array($result2))
{ 

   $thread_id = $r2['id'];
   $thread_title = $r2['title'];
   $thread_username = $r2['username'];
   $thread_last_post_username = $r2['last_post_username'];
   $thread_replies = $r2['replies'];
   $thread_views = $r2['views'];
?>
  <tr>
    <td style="width:50%;background-color:#fafafa;">
    <a href="viewthread.php?t=<? echo $thread_id; ?>"><? echo $thread_title; ?></a>
    <br />started by: <b><? echo $thread_username; ?></b>
    </td>
    <td style="width:30%;background-color:#fafafa;"><? echo $thread_last_post_username; ?></td>
    <td style="width:10%;background-color:#fafafa;"><? echo $thread_replies; ?></td>
    <td style="width:10%;background-color:#fafafa;"><? echo $thread_views; ?></td>
  </tr>
<?
}
?>
  <tr>
    <td style="background-color:#eee;font-size:0;height:15px;" colspan="4">&nbsp;</td>
  </tr>
</table>