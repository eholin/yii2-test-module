<?php

namespace app\modules\test\migrations;

use yii\db\Migration;

class M230522150811CreateOrdersTable extends Migration
{
    private string $table = 'orders';
    private string $foreignKey = 'fk-orders_relations_statuses';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'created_at' => $this->datetime()->notNull(),
            'name' => $this->string()->notNull(),
            'status_id' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->addForeignKey(
            $this->foreignKey,
            $this->table,
            'status_id',
            'statuses',
            'id',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey($this->foreignKey, $this->table);
        $this->dropTable($this->table);
    }
}
