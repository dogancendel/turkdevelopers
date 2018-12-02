<?
// Baglantiyi include ediyoruz.
include ("server.php"); 

// Bu kisimda Baglantigi kurdukdan Sonra tablomuza Baglanip kategori tablomuza baglaniyoruz
$result = mysql_query("select * from categories order by id asc") or die(mysql_error()); 

   while($r = mysql_fetch_array($result))
   {
      // redefine our category row variables.
      $category_id = $r['id'];
      $category_title = $r['title'];
      $category_description = $r['description'];
?>
<table cellpadding="5" cellspacing="1" border="0" style="width:90%;border:1px solid #000;">
  <tr>
    <td colspan="4" style="background-color:#eee;"><? echo $category_title; ?><br />
    <? echo $category_description; ?></td>
  </tr>
<? 

     $result2 = mysql_query("select * from forums where cid = '$category_id'"); 

     while($r2 = mysql_fetch_array($result2))
     { 

        $forum_id = $r2['id'];
        $forum_title = $r2['title'];
        $forum_description = $r2['description'];
        $forum_last_post_title = $r2['last_post_title'];
        $forum_last_post_username = $r2['last_post_username'];
        $forum_topics = $r2['topics'];
        $forum_replies = $r2['replies'];
?>
  <tr>
    <td style="width:50%;background-color:#fafafa;">
    <a href="viewforum.php?f=<? echo $forum_id; ?>"><? echo $forum_title; ?></a><br />
    <? echo $forum_description; ?>
    </td>
    <td style="width:30%;background-color:#fafafa;">
    <? echo $forum_last_post_title; ?><br />
    <? echo $forum_last_post_username; ?>
    </td>
    <td style="width:10%;background-color:#fafafa;"><? echo $forum_topics; ?></td>
    <td style="width:10%;background-color:#fafafa;"><? echo $forum_replies; ?></td>
  </tr>
<?
      }
?>
  <tr>
    <td style="background-color:#eee;font-size:0;height:15px;" colspan="4">&nbsp;</td>
  </tr>
</table>
<?
}
?>