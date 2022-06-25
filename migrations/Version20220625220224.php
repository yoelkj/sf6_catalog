<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220625220224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, body LONGTEXT DEFAULT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_3F207042C2AC5D3 (translatable_id), UNIQUE INDEX category_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_translation ADD CONSTRAINT FK_3F207042C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category DROP name, DROP slug, DROP body');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category_translation');
        $this->addSql('ALTER TABLE category ADD name VARCHAR(140) NOT NULL, ADD slug VARCHAR(255) NOT NULL, ADD body LONGTEXT DEFAULT NULL');
    }
}
