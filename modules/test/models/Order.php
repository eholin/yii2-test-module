<?php

namespace app\modules\test\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $created_at
 * @property string $name
 * @property int $status_id
 *
 * @property Status $status
 */
class Order extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'orders';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'status_id'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'string'],
            [['status_id'], 'integer'],
            [
                ['status_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Status::class,
                'targetAttribute' => ['status_id' => 'id']
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'name' => 'Название',
            'status_id' => 'Статус',
        ];
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getStatus(): ActiveQuery
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * @return array
     */
    public function getStatusesArray(): array
    {
        $statuses = Status::find()->all();

        return ArrayHelper::map($statuses, 'id', 'name');
    }
}
