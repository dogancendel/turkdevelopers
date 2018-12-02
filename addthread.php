<?
// Baglanti include
include ("server.php"); 

$f = $_GET['f']; 

$result = mysql_query("select title from forums where id = '$f'");
$r = mysql_fetch_array($result);
?>
<? 

if(isset($_POST['preview']))
{
?>
<table cellpadding="5" cellspacing="1" border="0" style="width:90%;border:1px solid #000;">
  <tr>
    <td colspan="2" style="background-color:#eee;"><? echo $_POST['title']; ?></td>
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

if(isset($_POST['addthread']) && !empty($_POST['title']) && !empty($_POST['username'])
   && !empty($_POST['post']))
{ 

   $f = $_POST['f'];
   $title = addslashes(htmlspecialchars($_POST['title']));
   $username = addslashes(htmlspecialchars($_POST['username']));
   $post = addslashes(htmlspecialchars($_POST['post'])); 

   $timestamp = time(); 

   mysql_query("insert into topics (id, fid, title, username, post, last_post_username, timestamp)
      values('null', '$f', '$title', '$username', '$post', '$username', '$timestamp')"); 

   $add_count_result = mysql_query("select topics from forums where id = '$f'");
   $add_count_row = mysql_fetch_array($add_count_result);
   $add_count = $add_count_row['topics']+1; 


   mysql_query("update forums set topics = '$add_count' where id = '$f'"); 

   $thread_id_result = mysql_query("select id from topics order by id desc limit 1");
   $thread_id_row = mysql_fetch_array($thread_id_result);
   $t = $thread_id_row['id'];
?>
<table cellpadding="5" cellspacing="1" border="0" style="width:90%;border:1px solid #000;">
  <tr>
    <td style="background-color:#eee;">Mesajiniz Eklendi</td>
  </tr>
  <tr>
    <td style="width:75%;background-color:#fafafa;" valign="top">
    Mesajiniz Basariyla Eklandi.<br />
    <a href="viewthread.php?t=<? echo $t; ?>">Görüntülemek icin tiklayin</a>
    </td>
  </tr>
  <tr>
    <td style="background-color:#eee;font-size:0;height:15px;" colspan="4">&nbsp;</td>
  </tr>
</table>
<?
}
else{ 

<form action="addthread.php" method="post">
<input type="hidden" value="<? if(isset($_POST['f'])){ echo $_POST['f']; } else{ echo $f; } ?>"
name="f" />
<table cellpadding="5" cellspacing="1" border="0" style="width:90%;border:1px solid #000;"> 
  <tr>
    <td colspan="2"style="background-color:#eee;">Adding Forum to: <? echo $r['title']; ?></td>
  </tr>
  <tr>
    <td style="width:15%;background-color:#fafafa;">isim:</td>
    <td style="width:85%;background-color:#fafafa;">
    <input type="text" name="username"
    value="<? if(isset($_POST['username'])){ echo $_POST['username']; } ?>" />
    </td>
  </tr>
  <tr>
    <td style="width:15%;background-color:#fafafa;">Cevap Basligi:</td>
    <td style="width:85%;background-color:#fafafa;">
    <input type="text" name="title"
     value="<? if(isset($_POST['title'])){ echo $_POST['title']; } ?>" />
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
    <input type="submit" name="addthread" value="Gönder" />
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