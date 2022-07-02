<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702145203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE office (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, province VARCHAR(140) DEFAULT NULL, city VARCHAR(140) DEFAULT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(100) DEFAULT NULL, is_main TINYINT(1) DEFAULT NULL, phone_main VARCHAR(140) DEFAULT NULL, phone_sales VARCHAR(140) DEFAULT NULL, phone_support VARCHAR(140) DEFAULT NULL, email_main VARCHAR(140) DEFAULT NULL, email_sales VARCHAR(140) DEFAULT NULL, email_support VARCHAR(140) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_74516B02F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE office_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(140) NOT NULL, hours VARCHAR(255) DEFAULT NULL, days VARCHAR(255) DEFAULT NULL, body LONGTEXT DEFAULT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_8E8307DD2C2AC5D3 (translatable_id), UNIQUE INDEX office_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE office ADD CONSTRAINT FK_74516B02F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE office_translation ADD CONSTRAINT FK_8E8307DD2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES office (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office_translation DROP FOREIGN KEY FK_8E8307DD2C2AC5D3');
        $this->addSql('DROP TABLE office');
        $this->addSql('DROP TABLE office_translation');
    }
}
