<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161104213446 extends AbstractMigration
{
    /**
     * links table renamed with discussion on slack channel.
     *
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE link_details (id INT AUTO_INCREMENT NOT NULL, thumbnail_media_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, title VARCHAR(140) DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX thumbnail_media_id_index (thumbnail_media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE link_details ADD CONSTRAINT FK_F40517FC364B086 FOREIGN KEY (thumbnail_media_id) REFERENCES medias (id)');
        $this->addSql('DROP TABLE links');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE links (id INT AUTO_INCREMENT NOT NULL, thumbnail_media_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, title VARCHAR(140) DEFAULT NULL COLLATE utf8_unicode_ci, description VARCHAR(500) DEFAULT NULL COLLATE utf8_unicode_ci, INDEX thumbnail_media_id_index (thumbnail_media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE links ADD CONSTRAINT FK_D182A118C364B086 FOREIGN KEY (thumbnail_media_id) REFERENCES medias (id)');
        $this->addSql('DROP TABLE link_details');
    }
}
