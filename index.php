<?php 
// phpinfo(INFO_VARIABLES);
header('Location: '. ( (isset($_REQUEST["redirect"])? $_REQUEST["redirect"] : "./src/index.php") ));
