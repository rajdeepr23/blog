<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss("<style>
        @media only screen and (max-width : 767px) {
            .panel-body,.panel-heading {
                height: auto !important;
            }
        }
    </style>");
?>
<br>
<div class="post-index">

    <?php Pjax::begin(['id' => 'post_pjax']); ?>
    <div class="row">
        <div class="col-sm-8">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-sm-4">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
         'itemOptions' => ['class' => 'item'],
        'itemView' => '_posts',
        'layout' => '<div class="row">{items}</div>{pager}'
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>
<?php
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js", [
    'depends' => [yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]);
$this->registerJs("$('.panel-body').matchHeight();$('.panel-heading').matchHeight();");
 $this->registerJs("
         $('.reset-button').on('click', function(e) {                 
             $.pjax.reload({container: '#post_pjax',timeout: 3000,async: false,url:'/post/index'});   
         });
 ");
?>

