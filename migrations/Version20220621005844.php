<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220621005844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE country ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE language ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP created, DROP updated');
        $this->addSql('ALTER TABLE country DROP created, DROP updated');
        $this->addSql('ALTER TABLE language DROP created, DROP updated');
    }
}
