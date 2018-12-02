<?
// Baglanti include.
include ("server.php"); 

$t = $_GET['t']; 

$result = mysql_query("select title, fid from topics where id = '$t'");
$r = mysql_fetch_array($result);
$f = $r['fid'];
?>
<? 

if(isset($_POST['preview']))
{
?>
<table cellpadding="5" cellspacing="1" border="0" style="width:90%;border:1px solid #000;">
  <tr>
    <td colspan="2" style="background-color:#eee;">re: <? echo $_POST['title']; ?></td>
  </tr>
  <tr>
    <td style="width:25%;background-color:#fafafa;" valign="top">
    <? echo $_POST['username']; ?></td>
    <td style="width:75%;background-color:#fafafa;" valign="top">
    <? 

    echo nl2br(htmlspecialchars($_POST['post']));
    ?>
    </td>
  </tr>
  <tr>
    <td style="background-color:#eee;font-size:0;height:15px;" colspan="4">&nbsp;</td>
  </tr>
</table>
<br />
<?
}
?>
<? 

if(isset($_POST['addreply']) && !empty($_POST['username'])
   && !empty($_POST['post']))
{ 

   $t = $_POST['t'];
   $f = $_POST['f'];
   $username = addslashes(htmlspecialchars($_POST['username']));
   $post = addslashes(htmlspecialchars($_POST['post'])); 

   $timestamp = time(); 

   mysql_query("insert into replies (id, tid, username, post)
      values('null', '$t', '$username', '$post')"); 

   $add_count_forum_result = mysql_query("select replies from forums where id = '$f'");
   $add_count_topic_result = mysql_query("select replies from topics where id = '$t'");
   $add_count_forum_row = mysql_fetch_array($add_count_forum_result);
   $add_count_topic_row = mysql_fetch_array($add_count_topic_result);
   $add_count_forum = $add_count_forum_row['replies']+1;
   $add_count_topic = $add_count_topic_row['replies']+1; 

   mysql_query("update forums set replies = '$add_count_forum' where id = '$f'");
   mysql_query("update topics set replies = '$add_count_topic', timestamp = '$timestamp'
                where id = '$t'");
?>
<table cellpadding="5" cellspacing="1" border="0" style="width:90%;border:1px solid #000;">
  <tr>
    <td style="background-color:#eee;">Mesaj Eklendi</td>
  </tr>
  <tr>
    <td style="width:75%;background-color:#fafafa;" valign="top">
    Cevabiniz Basariyla Eklanmistir.<br />
    <a href="viewthread.php?t=<? echo $t; ?>">Görüntülemek icin tiklayiniz.</a>
    </td>
  </tr>
  <tr>
    <td style="background-color:#eee;font-size:0;height:15px;" colspan="4">&nbsp;</td>
  </tr>
</table>
<?
}
else{ 

<form action="addreply.php" method="post">
<input type="hidden"
value="<? if(isset($_POST['t'])){ echo $_POST['t']; } else{ echo $t; } ?>" name="t" />
<input type="hidden"
value="<? if(isset($_POST['f'])){ echo $_POST['f']; } else{ echo $f; } ?>" name="f" />
<table cellpadding="5" cellspacing="1" border="0" style="width:90%;border:1px solid #000;">
  <tr>
    <td colspan="2"style="background-color:#eee;">Mesaj Buraya Ekleniyor: <? echo $r['title']; ?></td>
  </tr>
  <tr>
    <td style="width:15%;background-color:#fafafa;">isim:</td>
    <td style="width:85%;background-color:#fafafa;">
    <input type="text" name="username"
    value="<? if(isset($_POST['username'])){ echo $_POST['username']; } ?>" />
    </td>
  </tr>
  <tr>
    <td style="width:15%;background-color:#fafafa;" valign="top">Mesajiniz:</td>
    <td style="width:85%;background-color:#fafafa;">
<textarea name="post" cols="" rows="" style="width:80%;height:200px;">
<? if(isset($_POST['post'])){ echo $_POST['post']; } ?>
</textarea>
    </td>
  </tr>
  <tr>
    <td style="width:15%;background-color:#fafafa;" valign="top">&nbsp;</td>
    <td style="width:85%;background-color:#fafafa;">
    <input type="submit" name="preview" value="Önizleme" />
    <input type="submit" name="addreply" value="Postala" />
    </td>
  </tr>
  <tr>
    <td style="background-color:#eee;font-size:0;height:15px;" colspan="4">&nbsp;</td>
  </tr>
</table>
</form>
<?
}
?>