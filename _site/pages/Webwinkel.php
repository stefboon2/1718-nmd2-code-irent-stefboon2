<?php

session_start();


$page = 'winkelwagen.php';

mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('cart') or die(mysql_error());

if (isset($_GET['add'])) {
       if(!isset($_SESSION['cart_'.(int)$_GET['add']]))
{$_SESSION['cart_'.(int)$_GET['add']] = 0;}

    
    $quantity = mysql_query('SELECT id, quantity FROM products WHERE id='.mysql_real_escape_string((int)$_GET['add']));  
    while($quantity_row = mysql_fetch_assoc($quantity)) {
        if ($quantity_row['quantity']!=$_SESSION['cart_'.(int)$_GET['add']]) {
    $_SESSION['cart_'.(int)$_GET['add']]+='1';
     }
}
header('Location: '.$page);
}
if (isset($_GET['remove'])) {
  $_SESSION['cart_'.(int)$_GET['remove']]--;
  header('Location: '.$page);  
}

if (isset($_GET['delete'])) {
    $_SESSION['cart_'.(int)$_GET['delete']]='0';
     header('Location: '.$page);
}

function products() {
     $get = mysql_query('SELECT id, name, description, price FROM products WHERE quantity > 0 ORDER BY id DESC');
     if (mysql_num_rows($get)==0) {
        echo"there are no products to display!";
}
    else {
    while ($get_row = mysql_fetch_assoc($get)) {
        echo '<p>'.$get_row['name'].'<br />'.$get_row['description'].'<br />&euro;'.number_format($get_row['price'], 2).'<a href="cart.php?add='.$get_row['id'].'">In winkelwagentje</a></p>';
        }
    }
}

  
 function cart() {
      $sub = "";
      $total="";
    
      
     foreach($_SESSION as $name => $value){
       if ($value>0){
         if(substr($name, 0, 5)=='cart_'){
         $id = substr($name, 5, (strlen($name)-5));
         $get = mysql_query('SELECT id, name, price FROM products WHERE id='.mysql_real_escape_string((int)$id));
          while ($get_row = mysql_fetch_assoc($get)) {
              $sub = $get_row['price']*$value;
              echo $get_row['name'].' '.$value.' stuk(s)    prijs &euro;'.number_format($get_row['price'], 2).' = &euro;'.number_format($sub, 2). ' <a href="cart.php?remove='.$id.'">[-]</a> <a href="cart.php?add='.$id.'">[+]</a> <a href="cart.php?delete='.$id.'">[Delete]</a><br />';
          }  
     }
       $total += $sub;  
     }
 }
   if ($total==0) {
       echo"Uw winkelwagen is leeg." ;
   }
  else {
      echo '<div class="style1" style="margin:34px 39px 20px 39px">';
      echo 'Subtotaal: &euro;'.number_format($total, 2);

      
 }
 }  
?>