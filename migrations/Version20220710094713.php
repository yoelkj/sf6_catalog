<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220710094713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widget ADD use_related_products_component TINYINT(1) DEFAULT NULL, ADD use_new_products_component TINYINT(1) DEFAULT NULL, ADD use_best_seller_component TINYINT(1) DEFAULT NULL, ADD use_recommended_products TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widget DROP use_related_products_component, DROP use_new_products_component, DROP use_best_seller_component, DROP use_recommended_products');
    }
}
