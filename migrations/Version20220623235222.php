<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623235222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE page_widget (page_id INT NOT NULL, widget_id INT NOT NULL, INDEX IDX_EA2FE8CEC4663E4 (page_id), INDEX IDX_EA2FE8CEFBE885E2 (widget_id), PRIMARY KEY(page_id, widget_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page_widget ADD CONSTRAINT FK_EA2FE8CEC4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_widget ADD CONSTRAINT FK_EA2FE8CEFBE885E2 FOREIGN KEY (widget_id) REFERENCES widget (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE widget ADD gallery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE widget ADD CONSTRAINT FK_85F91ED04E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('CREATE INDEX IDX_85F91ED04E7AF8F ON widget (gallery_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE page_widget');
        $this->addSql('ALTER TABLE widget DROP FOREIGN KEY FK_85F91ED04E7AF8F');
        $this->addSql('DROP INDEX IDX_85F91ED04E7AF8F ON widget');
        $this->addSql('ALTER TABLE widget DROP gallery_id');
    }
}
