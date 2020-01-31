<?php
require('header.php');
?>
<div style = "overflow-x: scroll; width: 500px; padding-left: 10px;">
<div id ="Server">
<p style = "color: orange">$_SERVER</p>
<?php
         foreach($_SERVER as $key=>$var){
          echo "<p>$key = $var<P>";
          echo "<hr/>";
         }
                echo "<br/>";
                echo "<hr/>";
       ?>
</div>
<div>
<p style = "color: orange">$_GET</p>
<?php
         foreach($_GET as $key=>$var){
          echo "<p>$key = $var<P>";
          echo "<hr/>";
         }
                echo "<br/>";
                echo "<hr/>";
       ?>
</div>
<div>
<p style = "color: orange">$_POST</p>
<?php
         foreach($_POST as $key=>$var){
          echo "<p>$key = $var<P>";
          echo "<hr/>";
         }
                echo "<br/>";
                echo "<hr/>";
       ?>
</div>
</div>
<?php
require('footer.php');
?>