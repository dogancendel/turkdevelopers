<?
// Her Zamanki gibi baglanti include ediyoruz.
include ("server.php"); 

if(isset($_POST['addforum']) && !empty($_POST['title']))
{ 

   $title = $_POST['title'];
   $description = $_POST['description'];
   $cid = $_POST['cid']; 

   mysql_query("insert into forums (id, cid, title, description)
      values('null', '$cid', '$title', '$description')");
   echo "<b> The forum was added successfully.</b><br /> \n";
}
?>
<h1>Forum Ekle</h1>
<? 

$result = mysql_query("select id, title from categories order by title asc"); 

if(mysql_num_rows($result) < 1)
{
   echo "You need to add categories first. \n";
}
// else, display the form.
else
{
?>
<form action="add_forum.php" method="post">
Add to which category?<br />
<select name="cid">
<? 

   while($r = mysql_fetch_array($result))
   {
      echo "<option value=\"". $r['id'] ."\">". $r['title'] ."</option> \n";
   }
?>
</select><br />
FORUM Baslik:<br />
<input type="text" name="title" /><br />
FORUM Aciklama:<br />
<input type="text" name="description" /><br />
<input type="submit" value="Add Category" name="addforum" />
</form>
<?
}
?>