<?php

namespace app\modules\test\migrations;

use yii\db\Migration;

class M230522150534CreateStatusesTable extends Migration
{
    private string $table = 'statuses';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->insert($this->table, ['name' => 'В работе']);
        $this->insert($this->table, ['name' => 'Выполнен']);
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
