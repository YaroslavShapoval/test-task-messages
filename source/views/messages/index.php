<?php

/**
 * @var \source\core\view\View $this
 * @var \source\models\Message[] $list
 */

$list = $this->getField('list');
?>

<?php foreach ($list as $message): ?>
    <p>
        <?= $message->text ?>
    </p>
<?php endforeach; ?>
