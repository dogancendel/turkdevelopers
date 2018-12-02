<?
// Baglanti include Ediyoruz.
include ("server.php"); 

if(isset($_POST['addcategory']) && !empty($_POST['title']))
{ 

   $title = $_POST['title'];
   $description = $_POST['description']; 

   mysql_query("insert into categories values('null', '$title', '$description')");
   echo "<b> The Category Was added Successfully.</b><br /> \n";
}
?>
<h1>Kategori Ekle</h1>
<form action="add_category.php" method="post">
Kategori Basligi:<br />
<input type="text" name="title" /><br />
Aciklamasi:<br />
<input type="text" name="description" /><br />
<input type="submit" value="Add Category" name="addcategory" />
</form>