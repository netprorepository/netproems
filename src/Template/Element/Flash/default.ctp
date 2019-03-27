<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-secondary alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Nothing!</strong> <?= h($message) ?>.
</div>
