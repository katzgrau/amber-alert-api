<?php

require '../AmberAlert.php';

print_r(AmberAlert::getMostRecentAlertByState($argv[1], true));
