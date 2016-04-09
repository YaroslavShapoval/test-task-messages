<?php

/**
 * @var \source\core\view\View $this
 * @var \source\models\Message[] $list
 */

$list = $this->getField('list');
?>

<div class="container">
    <?php foreach ($list as $message): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-6">
                        <strong><?= $message->name ?> (<?= $message->email ?>)</strong>
                    </div>

                    <div class="col-sm-6 text-right">
                        <?= $message->created_at ?>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <p>
                    <?= $message->text ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-heading">
                <h3 class="panel-title">Add new message</h3>
            </div>
        </div>

        <div class="panel-body">
            <form id="new_message_form">
                <div class="form-group">
                    <label for="formInputName">Your name</label>
                    <input type="text" class="form-control" id="formInputName" placeholder="Name">
                </div>

                <div class="form-group">
                    <label for="formInputEmail">Email address</label>
                    <input type="email" class="form-control" id="formInputEmail" placeholder="Your email">
                </div>

                <div class="form-group">
                    <label for="formInputText">Message</label>
                    <textarea class="form-control" name="text" id="formInputText"
                              rows="4" placeholder="Message"></textarea>
                </div>

                <div class="text-right">
                    <button id="message_preview_button" type="button" class="btn btn-primary">Preview</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
