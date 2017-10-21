<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171009124648 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        if (!$schema->hasTable('warehouses')) {
            $table = $schema->createTable('warehouses');

            $table->addColumn('id', 'integer', ['notnull' => false, 'autoincrement' => true]);
            $table->setPrimaryKey(['id']);

            $table->addColumn('code', 'string', ['notnull' => true, 'length' => 45]);
            $table->addColumn('name', 'string', ['notnull' => true, 'length' => 100]);
            $table->addColumn('active', 'integer', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true]);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true]);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        if ($schema->hasTable('warehouses'))
            $schema->dropTable('warehouses');
    }
}
