<?php include "config.php"; ?>
<?php include "user_query.php"; ?>
<?php include "leave_query.php"; ?>

<?php
function debug_log($log_msg) {
    if (!ENV_DEBUG) {
        return;
    }
    $log_filename = getenv("HOMEDRIVE").getenv("HOMEPATH")."\Desktop"."\log";
    if (!file_exists($log_filename)) {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.txt';
    // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
} 
?>
