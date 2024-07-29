<?php

//Send Image to Blur API
function Blur()
{
$blur    = exec("curl --location --request GET 'http://localhost:5500'");
return $blur;

}
//END Blur API

Blur();

?>
