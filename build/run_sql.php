<?php
require_once(realpath(dirname(__FILE__).'/../Config.php'));
passthru (sprintf('export PGPASSWORD=%s ; psql -h %s -d %s -U %s -f '.$argv[1],
		DB_PASSWORD,
		DB_SERVER_MASTER,
		DB_NAME,
		DB_USER
	)
);

?>
