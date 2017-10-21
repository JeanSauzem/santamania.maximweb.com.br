<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170916155203 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        if (!$schema->hasTable('product_status')) {
            $table = $schema->createTable('product_status');

            $table->addColumn('id', 'integer', ['notnull' => false, 'autoincrement' => true]);
            $table->setPrimaryKey(['id']);

            $table->addColumn('name', 'string', ['notnull' => true]);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        if ($schema->hasTable('product_status'))
            $schema->dropTable('product_status');
    }
}
