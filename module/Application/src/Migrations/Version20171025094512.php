<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171025094512 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        if (!$schema->hasTable('prodution')) {
            $table = $schema->createTable('prodution');

            $table->addColumn('id', 'integer', ['notnull' => false, 'autoincrement' => true]);
            $table->setPrimaryKey(['id']);

            $table->addColumn('quantity', 'integer', ['notnull' => true]);

            $table->addColumn("product_id", "integer", ["notnull" => false]);
            $table->addIndex(["product_id"], 'fk_prodution_product_idx');
            $table->addForeignKeyConstraint('product', ['product_id'], ['id'], ['onUpdate' => 'NO ACTION', 'onDelete' => 'CASCADE'], 'fk_prodution_product_idx');


            $table->addColumn('created_at', 'datetime', ['notnull' => true]);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true]);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        if ($schema->hasTable('prodution'))
            $schema->dropTable('prodution');
    }
}
