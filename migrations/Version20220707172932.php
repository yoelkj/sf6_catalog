<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707172932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presentation_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(140) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_F85A4D4B2C2AC5D3 (translatable_id), UNIQUE INDEX presentation_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE presentation_translation ADD CONSTRAINT FK_F85A4D4B2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES presentation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category DROP bg_image');
        $this->addSql('ALTER TABLE category_translation DROP slug, DROP body');
        $this->addSql('ALTER TABLE presentation ADD order_row INT DEFAULT NULL, DROP name, DROP slug, DROP body');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE presentation_translation');
        $this->addSql('ALTER TABLE category ADD bg_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE category_translation ADD slug VARCHAR(255) NOT NULL, ADD body LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE presentation ADD name VARCHAR(140) NOT NULL, ADD slug VARCHAR(255) NOT NULL, ADD body LONGTEXT DEFAULT NULL, DROP order_row');
    }
}
