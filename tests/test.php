<html>
<body>

<?php
$base='/ekiplab--schedule';
include_once $base.'/backend/DataAccess/LaunchData.php';

if ( $_GET["action"] == "test" )
{
  $pippo = new LaunchData();
}
?><br>

</body>
</html>