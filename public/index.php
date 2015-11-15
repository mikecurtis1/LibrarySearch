<?php 
/**
 * @example /index.php?module=modname&user_id=user1
 */

try {
    include(dirname(__FILE__) . '/../application/bootstrap.php');
} catch (Exception $e) {
    $exception_handler->logException($e);
    die('Could not load bootstrap file.');
}
