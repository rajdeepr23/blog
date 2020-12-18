<?php

use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */

$categoryList = ArrayHelper::map(Category::find()->all(), 'id', 'name');

?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options'=> ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')
        ->dropDownList(
            $categoryList,           // Flat array ('id'=>'label')
            ['prompt'=>'Select Category...','id' => 'category-select']    // options
        )->label('Filter By Category');
    ?>

    <?= $form->field($model,'image_path')->fileInput() ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
