<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $body
 * @property string $slug
 * @property string $image_path
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'immutable' => true
                // 'slugAttribute' => 'slug',
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['category_id'], 'required','message' => 'Category cannot be blank.'],
            [['id','user_id','category_id'], 'integer'],
            [['body'], 'string'],
            [['image_path'],'file','skipOnEmpty'=>true,'extensions'=>'png,jpg'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 50],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'body' => 'Body',
            'slug' => 'Slug',
            'image_path' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function imageUploadThenSave()
    {
        $path = Yii::$app->basePath.DIRECTORY_SEPARATOR."web".DIRECTORY_SEPARATOR."uploads";
        if ($this->validate())
        {
            if(!empty($this->image_path)) {

                if(!is_dir($path)) {
                     mkdir($path,0755, true);
                }

                $this->image_path->saveAs('uploads/'.$this->image_path->baseName.'.'.$this->image_path->extension);
            }
            return $this->save(false);
        }
        return false;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
