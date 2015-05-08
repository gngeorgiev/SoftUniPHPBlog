<div class="blog-header">

<?php 
renderMessages(INFO_MESSAGES_SESSION_KEY, 'alert alert-success');
renderMessages(ERROR_MESSAGES_SESSION_KEY, 'alert alert-danger');

function renderMessages($messagesKey, $cssClass) {
    if (isset($_SESSION[$messagesKey]) && count($_SESSION[$messagesKey]) > 0) {
        foreach ($_SESSION[$messagesKey] as $msg) {
            echo "<div class='$cssClass'>" . htmlspecialchars($msg) . '</div>';
        }
    }
    $_SESSION[$messagesKey] = array();
}
?>

</div>