<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170915122424 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        if (!$schema->hasTable('users')) {
            $table = $schema->createTable('users');

            $table->addColumn('id', 'integer', ['notnull' => false, 'autoincrement' => true]);
            $table->setPrimaryKey(['id']);

            $table->addColumn('firstname', 'string', ['notnull' => true]);
            $table->addColumn('lastname', 'string', ['notnull' => false]);
            $table->addColumn('email', 'string', ['notnull' => true]);
            $table->addColumn('password', 'string', ['notnull' => true]);
            $table->addColumn('level', 'integer', ['notnull' => true]);
            $table->addColumn('active', 'integer', ['notnull' => true]);
            $table->addColumn('activation_key', 'string', ['notnull' => false]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true]);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true]);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        if ($schema->hasTable('users'))
            $schema->dropTable('users');
    }
}
