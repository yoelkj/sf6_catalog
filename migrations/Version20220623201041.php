<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623201041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE page_gallery');
        $this->addSql('ALTER TABLE page ADD gallery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6204E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('CREATE INDEX IDX_140AB6204E7AF8F ON page (gallery_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE page_gallery (page_id INT NOT NULL, gallery_id INT NOT NULL, INDEX IDX_BD4B93AFC4663E4 (page_id), INDEX IDX_BD4B93AF4E7AF8F (gallery_id), PRIMARY KEY(page_id, gallery_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE page_gallery ADD CONSTRAINT FK_BD4B93AF4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_gallery ADD CONSTRAINT FK_BD4B93AFC4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6204E7AF8F');
        $this->addSql('DROP INDEX IDX_140AB6204E7AF8F ON page');
        $this->addSql('ALTER TABLE page DROP gallery_id');
    }
}
