<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630142500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_translation ADD translatable_id INT DEFAULT NULL, ADD locale VARCHAR(5) NOT NULL');
        $this->addSql('ALTER TABLE menu_translation ADD CONSTRAINT FK_DC955B232C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_DC955B232C2AC5D3 ON menu_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX menu_translation_unique_translation ON menu_translation (translatable_id, locale)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE menu_translation DROP FOREIGN KEY FK_DC955B232C2AC5D3');
        $this->addSql('DROP INDEX IDX_DC955B232C2AC5D3 ON menu_translation');
        $this->addSql('DROP INDEX menu_translation_unique_translation ON menu_translation');
        $this->addSql('ALTER TABLE menu_translation DROP translatable_id, DROP locale');
    }
}
