<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170916173037 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        if (!$schema->hasTable('products')) {
            $table = $schema->createTable('products');

            $table->addColumn('id', 'integer', ['notnull' => false, 'autoincrement' => true]);
            $table->setPrimaryKey(['id']);

            $table->addColumn('name', 'string', ['notnull' => true]);
            $table->addColumn('active', 'integer', ['notnull' => true]);

            $table->addColumn("product_category_id", "integer", ["notnull" => false]);
            $table->addIndex(["product_category_id"], 'fk_products_product_categories1_idx');
            $table->addForeignKeyConstraint('product_categories', ['product_category_id'], ['id'], ['onUpdate' => 'NO ACTION', 'onDelete' => 'CASCADE'], 'fk_products_product_categories1_id');

            $table->addColumn("units_measure_id", "integer", ["notnull" => false]);
            $table->addIndex(["units_measure_id"], 'fk_products_unit_measures1_idx');
            $table->addForeignKeyConstraint('units_measure', ['units_measure_id'], ['id'], ['onUpdate' => 'NO ACTION', 'onDelete' => 'CASCADE'], 'fk_products_unit_measures1_id');

            $table->addColumn('created_at', 'datetime', ['notnull' => true]);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true]);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        if ($schema->hasTable('products'))
            $schema->dropTable('products');
    }
}
