<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200827025804 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD COLUMN original_time DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C53D045F8C9F3610');
        $this->addSql('CREATE TEMPORARY TABLE __temp__image AS SELECT id, title, file FROM image');
        $this->addSql('DROP TABLE image');
        $this->addSql('CREATE TABLE image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, file VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO image (id, title, file) SELECT id, title, file FROM __temp__image');
        $this->addSql('DROP TABLE __temp__image');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C53D045F8C9F3610 ON image (file)');
    }
}
