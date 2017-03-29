<?php
//Put your routes here
//route("URL_Location","filename_in_views_directory");
$a = new mainRouter();
  $a->route("form","form.html");
  $a->route("form/post","post.php");
  $a->routeWrite("test","This is a test routeWrite!1");
