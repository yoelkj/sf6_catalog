<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630131134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gallery_images_translation');
        $this->addSql('ALTER TABLE gallery_images ADD body LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gallery_images_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, body LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, locale VARCHAR(5) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX gallery_images_translation_unique_translation (translatable_id, locale), INDEX IDX_B75D7E7C2C2AC5D3 (translatable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE gallery_images_translation ADD CONSTRAINT FK_B75D7E7C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES gallery_images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallery_images DROP body');
    }
}
