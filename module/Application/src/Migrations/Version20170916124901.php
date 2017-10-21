<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170916124901 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        if (!$schema->hasTable('product_categories')) {
            $table = $schema->createTable('product_categories');

            $table->addColumn('id', 'integer', ['notnull' => false, 'autoincrement' => true]);
            $table->setPrimaryKey(['id']);

            $table->addColumn('name', 'string', ['notnull' => true]);
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
        if ($schema->hasTable('product_categories'))
            $schema->dropTable('product_categories');
    }
}
