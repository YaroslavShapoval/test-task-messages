<?php

/**
 * @var \source\core\view\View $this
 * @var \source\models\Message[] $list
 * @var boolean $afterCreate
 */

$userComponent = \source\core\components\UserComponent::getInstance();

$list = $this->getField('list');
$afterCreate = $this->getField('after_create');
?>

<div class="container">
    <?php if ($afterCreate): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <strong>Well done!</strong> Your message will be displayed after moderation.
        </div>
    <?php endif; ?>

    <div class="dropdown dropdown-order">
        <button class="btn btn-default dropdown-toggle" type="button" id="orderBydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Order by field
            <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" aria-labelledby="orderBydropdown">
            <li><a href="/index/created_at-DESC">By adding date (new first)</a></li>
            <li><a href="/index/created_at-ASC">By adding date (old first)</a></li>
            <li><a href="/index/name-ASC">By author name</a></li>
            <li><a href="/index/email-ASC">By author email</a></li>
        </ul>
    </div>

    <?php foreach ($list as $message): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-6">
                        <strong><?= $message->name ?> (<?= $message->email ?>)</strong>

                        <?php if ($message->is_edited): ?>
                            <span class="label label-default">Changed By Moderator</span>
                        <?php endif ?>
                    </div>

                    <div class="col-sm-6 text-right">
                        <?= $message->created_at ?>

                        <?php if (!$userComponent->isGuest()): ?>
                            <?php
                            $messageLabel = \source\helpers\MessageHelper::getMessageLabel($message);
                            $messageText = \source\helpers\MessageHelper::getMessageText($message);
                            ?>
                            <span class="label label-<?= $messageLabel ?>">
                                <?= $messageText ?>
                            </span>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="panel-body editable">
                <?php if (!empty($message->image_path)): ?>
                    <p>
                        <img src="/images/<?= $message->image_path ?>" alt="<?= $message->email ?>">
                    </p>
                <?php endif ?>

                <p class="editable-text"><?= $message->text ?></p>

                <form action="/edit/<?= $message->id ?>" method="post" data-validate_url="/validate/<?= $message->id ?>">
                    <div class="form-group editable-area">
                        <label>Update message</label>
                        <textarea class="form-control" name="text" rows="4" placeholder="Message">
                            <?= $message->text ?>
                        </textarea>
                    </div>
                </form>

                <?php if (!$userComponent->isGuest()): ?>
                    <p class="text-right">
                        <button type="button" class="btn btn-success btn-sm editable-button__save">Edit</button>
                    </p>

                    <p class="text-right">
                        <button type="button" class="btn btn-primary btn-xs editable-button__edit">Edit</button>

                        <?php if ($message->status !== \source\models\Message::$statuses['APPROVED']): ?>
                            <button type="button" class="btn btn-success btn-xs message-set-status"
                                    data-url="/set-status/<?= $message->id ?>/<?= \source\models\Message::$statuses['APPROVED'] ?>">
                                Approve
                            </button>
                        <?php endif ?>

                        <?php if ($message->status !== \source\models\Message::$statuses['DECLINED']): ?>
                            <button type="button" class="btn btn-danger btn-xs message-set-status"
                                    data-url="/set-status/<?= $message->id ?>/<?= \source\models\Message::$statuses['DECLINED'] ?>">
                                Decline
                            </button>
                        <?php endif ?>
                    </p>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="panel panel-success hidden" id="new_message_preview">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-6">
                    <strong id="new_message_title"></strong>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <p id="new_message_text"></p>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-heading">
                <h3 class="panel-title">Add new message</h3>
            </div>
        </div>

        <div class="panel-body">
            <?php
            /** @var \source\models\User $user */
            $user = $userComponent->getUserModel();
            ?>

            <form action="/create" method="post" enctype="multipart/form-data" id="new_message_form" data-validate_url="/validate">
                <div id="alerts"></div>

                <div class="form-group">
                    <label for="formInputName">Your name</label>
                    <input type="text" name="name" class="form-control" id="formInputName"
                           placeholder="Name" value="<?= $user ? $user->name : '' ?>">
                </div>

                <div class="form-group">
                    <label for="formInputEmail">Email address</label>
                    <input type="email" name="email" class="form-control" id="formInputEmail"
                           placeholder="Your email" value="<?= $user ? $user->email : '' ?>">
                </div>

                <div class="form-group">
                    <label for="formInputText">Message</label>
                    <textarea class="form-control" name="text" id="formInputText"
                              rows="4" placeholder="Message"></textarea>
                </div>

                <div class="form-group">
                    <label for="formInputImage">Image</label>
                    <input name="image" type="file" id="formInputImage">
                </div>

                <div class="text-right">
                    <button id="message_preview_button" type="button" class="btn btn-primary">Preview</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
