<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628172610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE widget_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(140) NOT NULL, body LONGTEXT NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_8A73CFE32C2AC5D3 (translatable_id), UNIQUE INDEX widget_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE widget_translation ADD CONSTRAINT FK_8A73CFE32C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES widget (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE avatar avatar VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE widget DROP name, DROP body');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE widget_translation');
        $this->addSql('ALTER TABLE user CHANGE avatar avatar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE widget ADD name VARCHAR(140) DEFAULT NULL, ADD body LONGTEXT DEFAULT NULL');
    }
}
