<?php

define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ACTION', 'index');
define('DEFAULT_VIEW', 'index');
define('DEFAULT_LAYOUT', 'default');

define('DB_HOST', 'mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/');
define('DB_USER', 'adminjWmr7ne');
define('DB_PASS', 'RVADr8tdqDFA');
define('DB_NAME', 'diy');

define('INFO_MESSAGES_SESSION_KEY', 'infoMessages');
define('ERROR_MESSAGES_SESSION_KEY', 'errorMessages');

define('USERNAME_MIN_LENGTH', 4);
define('USERNAME_MAX_LENGTH', 24);
define('PASSWORD_MIN_LENGTH', 8);
define('PASSWORD_MAX_LENGTH', 24);

define('COMMENT_MIN_LENGTH', 1);
define('COMMENT_MAX_LENGTH', 1000);

define('TITLE_MIN_LENGTH', 1);
define('TITLE_MAX_LENGTH', 100);

define('TAG_MIN_LENGTH', 1);
define('TAG_MAX_LENGTH', 60);

define('DEFAULT_PAGE_SIZE', 5);
