<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220622225847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) NOT NULL, slug VARCHAR(255) NOT NULL, body LONGTEXT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) NOT NULL, slug VARCHAR(255) NOT NULL, body LONGTEXT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) NOT NULL, is_active TINYINT(1) DEFAULT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery_images (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, gallery_id INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, order_row INT DEFAULT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, INDEX IDX_429C52C882F1BAF4 (language_id), INDEX IDX_429C52C84E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) NOT NULL, slug VARCHAR(255) NOT NULL, body LONGTEXT DEFAULT NULL, bg_image VARCHAR(255) DEFAULT NULL, body_image VARCHAR(255) NOT NULL, body_video VARCHAR(255) DEFAULT NULL, order_row INT DEFAULT NULL, is_core TINYINT(1) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) NOT NULL, slug VARCHAR(255) NOT NULL, body LONGTEXT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, code VARCHAR(140) NOT NULL, body LONGTEXT DEFAULT NULL, weight_grammage NUMERIC(6, 2) DEFAULT NULL, quantity_per_box INT DEFAULT NULL, storage_life_months INT DEFAULT NULL, is_new TINYINT(1) DEFAULT NULL, is_best_seller TINYINT(1) DEFAULT NULL, is_recommended TINYINT(1) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), INDEX IDX_D34A04AD44F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widget (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) DEFAULT NULL, body LONGTEXT DEFAULT NULL, bg_color VARCHAR(140) DEFAULT NULL, template VARCHAR(140) DEFAULT NULL, order_row INT DEFAULT NULL, is_core TINYINT(1) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created DATE NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gallery_images ADD CONSTRAINT FK_429C52C882F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE gallery_images ADD CONSTRAINT FK_429C52C84E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD44F5D008');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE gallery_images DROP FOREIGN KEY FK_429C52C84E7AF8F');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE gallery_images');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE presentation');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE widget');
    }
}
