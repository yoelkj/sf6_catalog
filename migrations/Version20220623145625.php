<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623145625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brand ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE category ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE company ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE country ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE gallery ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE gallery_images ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE language ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE page ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE presentation ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE product ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
        $this->addSql('ALTER TABLE widget ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP created, DROP updated');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brand ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE category ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE company ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE country ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE gallery ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE gallery_images ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE language ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE page ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE presentation ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE product ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE user ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE widget ADD created DATE NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at');
    }
}
