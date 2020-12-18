<?php

use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
$categoryList = ArrayHelper::map(Category::find()->all(), 'id', 'name');

?>


<div class="post-search">

    <?php $form = ActiveForm::begin([
            'id' => 'post-search-form',
            'action' => ['index'],
            'method' => 'get',
            'options' => [],
    ]); ?>

    <?= $form->field($model, 'category_id')
        ->dropDownList(
            $categoryList,           // Flat array ('id'=>'label')
            ['prompt'=>'All Categories...','id' => 'category-select']    // options
        )->label('Filter By Category');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary reset-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
