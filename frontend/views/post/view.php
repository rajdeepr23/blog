<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (isset($model->image_path)) { ?>
        <div class="text-center">
            <img style="height: 100px;" class="img-fluid w-100" src="<?=\yii\helpers\Url::base().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$model->image_path?>" alt="">
        </div><br>
    <?php } ?>

    <?php if($model->user_id === Yii::$app->user->id) {?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php } ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute' => 'user.username', 'label' => 'User Name'],
            ['attribute' => 'category.name', 'label' => 'Category Name'],
            'title',
            'body',
            'image_path',
            'slug',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
