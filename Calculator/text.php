<?php
    $array = Array(); 
    $i = 0;
    
    // Merge the lower and upper case alphabetic 
    // characters and store it into an array 
    $alphachar = array_merge(range('A', 'Z'), range('a', 'z')); 
    
    // Loop executes upto all array elements 
    foreach ($alphachar as $element) { 
        // Display the array elements 
        $array[] = chr($i); 
    } 
    
?>
<!doctype html>
<html>
    <head>
    	<?php

        ?>
    </head>
    <body>
        <?php
            
        ?>
    </body>
</html>