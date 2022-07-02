<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702152749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE office ADD CONSTRAINT FK_74516B02979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_74516B02979B1AD6 ON office (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office DROP FOREIGN KEY FK_74516B02979B1AD6');
        $this->addSql('DROP INDEX IDX_74516B02979B1AD6 ON office');
        $this->addSql('ALTER TABLE office DROP company_id');
    }
}
