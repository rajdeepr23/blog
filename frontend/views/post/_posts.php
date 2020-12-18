<?php
use yii\helpers\StringHelper;

$trimmedText = (StringHelper::countWords($model->body) > 5) ? StringHelper::truncateWords($model->body,5)
    ." <a href='/post/view/". $model->id ."' class='page-link'>Read More</a>" : $model->body;
?>

<div class="col-sm-4">
    <div class="panel panel-default">
        <div class="panel-heading"><a href="/post/view/<?=$model->id?>"><?=$model->title?></a></div>
        <div class="panel-body">
            <?php if (isset($model->image_path)) { ?>
                <div class="text-center">
                    <img style="height: 100px;" class="img-fluid w-100" src="<?=\yii\helpers\Url::base().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$model->image_path?>" alt="">
                </div>
            <?php } ?>
            <br>
            <p><?=$trimmedText?></p>
        </div>
        <div class="panel-footer text-right">
            <em class="text-muted">Last Updated at: </em><small> <?= Yii::$app->formatter->asDate($model->updated_at)  ?></small>
        </div>
    </div>
</div>