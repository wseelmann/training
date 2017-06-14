<?php
if (file_exists(__DIR__ . '/AdditionalConfiguration')) {
	foreach(glob(__DIR__ . '/AdditionalConfiguration/*Configuration.php') as $configFile) {
		include($configFile);
	}
}
