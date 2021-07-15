<?php
use yii\helpers\Url;
$user_id = Yii::$app->user->id;
?>

<div class="container">
    <?php if (Yii::$app->session->hasFlash('successful')): ?>
        <div class="alert alert-success alert-dismissable">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <?= Yii::$app->session->getFlash('danger') ?>
        </div>
    <?php endif; ?>

    <h2>List of contacts</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Phone number</th>
            <th>is active</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $contact):?>
        <tr>
            <td><?=$contact->name?></td>
            <td><?=$contact->number?></td>
            <td>
                <div class="alert alert-<?=$contact->is_active==1?'success':'danger'?>">
                    <strong><?=$contact->is_active==1?'Active':'Not active'?>!</strong>
                </div>
            </td>
            <td class="text-center">
                <a href="<?=Url::to(['contact-favourite',
                    'user_id'=>$user_id,
                    'contact_id'=>$contact->id
                ])?>">
                <i class="fa<?=\app\models\Favourites::checkFavourite($user_id,$contact->id)?> fa-heart"></i>
                </a>
            </td>
        </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>
