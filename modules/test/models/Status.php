<?php

namespace app\modules\test\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "statuses".
 *
 * @property int $id
 * @property string $name
 *
 * @property Order[] $orders
 */
class Status extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'statuses';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getOrders(): ActiveQuery
    {
        return $this->hasMany(Order::class, ['status_id' => 'id']);
    }
}
