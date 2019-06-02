<!doctype html>
<html>
<head>
<link rel="stylesheet" href="view/style.css" type="text/css"> 
<!-- <meta content="text/html; charset=windows-1251" http-equiv="Content-Type"> -->
<title>Главная страница</title>
</head>

<body background="view/img/2.jpg">

<table class="main" align="center">
  
 <tr>
  <td class="mainhead" colspan="2">
   <a href="/">
   <div class="mybutton"><img src="view/img/g.gif" align="left"></div>
   </a>
   <font size="6"><a href="/" class="mainh">Блог</a></font>&nbsp;<br> 
   <font size="5">разработка блога на php</font>
  </td>
 </tr>
        
 <tr>
  <td class="mainlinks" align="left" valign="top">

   <p align="center"> <font size="3" color="#000000">Меню</font></p> 

 

       <a title="Главная страница" href="/">Главная страница</a>
   <p> <a title="Добавить статью" href="add">Добавить статью</a></p>
       <a title="Авторизоваться\выйти" href="login">Авторизоваться\выйти</a>

   <hr align="center" size="1" width="130px">
  
  </td>

 <td class="frame" width="710"> 
 <font size="2">

<h3>Главная страница</h3>

<?=$content?>

</font>

   </td>
 </tr>

</table> 
</body>
</html>