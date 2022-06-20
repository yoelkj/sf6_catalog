<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620174954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, phone_main VARCHAR(255) DEFAULT NULL, phone_sales VARCHAR(255) DEFAULT NULL, phone_support VARCHAR(255) DEFAULT NULL, email_main VARCHAR(255) DEFAULT NULL, email_sales VARCHAR(255) DEFAULT NULL, email_support VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(140) DEFAULT NULL, tax_ident VARCHAR(50) DEFAULT NULL, tax_number VARCHAR(60) DEFAULT NULL, tax_porcent NUMERIC(5, 2) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, favicon VARCHAR(255) DEFAULT NULL, bg_color_main VARCHAR(60) DEFAULT NULL, bg_color_secondary VARCHAR(60) DEFAULT NULL, province VARCHAR(140) DEFAULT NULL, city VARCHAR(140) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX IDX_4FBF094F82F1BAF4 (language_id), INDEX IDX_4FBF094FF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, name VARCHAR(140) DEFAULT NULL, code VARCHAR(10) DEFAULT NULL, flag VARCHAR(140) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX IDX_5373C96682F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) DEFAULT NULL, code VARCHAR(10) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, order_row INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C96682F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE user ADD is_active TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF92F3E70');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F82F1BAF4');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C96682F1BAF4');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE language');
        $this->addSql('ALTER TABLE user DROP is_active');
    }
}
