<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630105425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, slogan VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_ADB8FDF72C2AC5D3 (translatable_id), UNIQUE INDEX company_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery_images_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, body LONGTEXT DEFAULT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_B75D7E7C2C2AC5D3 (translatable_id), UNIQUE INDEX gallery_images_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company_translation ADD CONSTRAINT FK_ADB8FDF72C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallery_images_translation ADD CONSTRAINT FK_B75D7E7C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES gallery_images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallery_images ADD link VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE company_translation');
        $this->addSql('DROP TABLE gallery_images_translation');
        $this->addSql('ALTER TABLE gallery_images DROP link');
    }
}
