<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629155400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page DROP body_image, DROP body_video');
        $this->addSql('ALTER TABLE page_translation ADD body_image VARCHAR(255) DEFAULT NULL, ADD body_video VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE widget ADD bg_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE widget_translation ADD body_video VARCHAR(255) DEFAULT NULL, ADD body_image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page ADD body_image VARCHAR(255) DEFAULT NULL, ADD body_video VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE page_translation DROP body_image, DROP body_video');
        $this->addSql('ALTER TABLE widget DROP bg_image');
        $this->addSql('ALTER TABLE widget_translation DROP body_video, DROP body_image');
    }
}
