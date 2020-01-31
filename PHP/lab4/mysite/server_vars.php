<div style="overflow-x: scroll; width: 500px;">
		<div>
            <p style="color: green">$_SERVER</p>
			<?php
				 foreach($_SERVER as $key=>$var){
					echo "<p>$key = $var<P>";
					echo "<hr/>";
				 }
                echo "<br/>";
                echo "<hr/>";
			 ?>
        </div>
		 <div >
             <p style="color: green">$_GET</p>
             <?php
				 foreach($_GET as $key=>$var){
                     echo "<p>$key = $var<P>";
                     echo "<hr/>";
				 }
                echo "<br/>";
                echo "<hr/>";
			 ?>
         </div>
		 <div >
             <p style="color: green">$_POST</p>
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