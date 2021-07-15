<?php
use yii\helpers\Url;
$user_id = Yii::$app->user->id;
?>

    <h2>List of contacts</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Phone number</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($favourites as $contact):?>
            <tr>
                <td><?=$contact->contact->name?></td>
                <td><?=$contact->contact->number?></td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>
