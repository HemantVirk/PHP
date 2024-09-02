<?php
// close the open service resources
if (defined('WRITE_CONN')) {
    WRITE_CONN->disconnect();
}

if (defined('READ_CONN')) {
    READ_CONN->disconnect();
}

if (defined('DB_CONN')) {
    DB_CONN->disconnect();
}