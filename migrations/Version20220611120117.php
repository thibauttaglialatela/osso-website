<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220611120117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_content (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compositor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, category_content_id INT NOT NULL, title VARCHAR(255) NOT NULL, body LONGTEXT DEFAULT NULL, identifier VARCHAR(255) NOT NULL, fct_id VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_FEC530A9CCA06B90 (fct_id), INDEX IDX_FEC530A9A2BEF393 (category_content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, summary VARCHAR(400) NOT NULL, body LONGTEXT NOT NULL, date DATE NOT NULL, category VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, fct_id VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_3CBF69DDCCA06B90 (fct_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musical_work (id INT AUTO_INCREMENT NOT NULL, compositor_id INT DEFAULT NULL, event_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_6B399CF2E74E5782 (compositor_id), INDEX IDX_6B399CF271F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musician (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, status VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musician_instrument (musician_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_2F94EB1A9523AA8A (musician_id), INDEX IDX_2F94EB1ACF11D9C (instrument_id), PRIMARY KEY(musician_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poster (id INT AUTO_INCREMENT NOT NULL, gallery_id INT NOT NULL, image_file VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATE NOT NULL, author VARCHAR(255) DEFAULT NULL, alt VARCHAR(255) NOT NULL, INDEX IDX_2D710CF24E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE press (id INT AUTO_INCREMENT NOT NULL, newspaper VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, article_date DATE NOT NULL, article_link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9A2BEF393 FOREIGN KEY (category_content_id) REFERENCES category_content (id)');
        $this->addSql('ALTER TABLE musical_work ADD CONSTRAINT FK_6B399CF2E74E5782 FOREIGN KEY (compositor_id) REFERENCES compositor (id)');
        $this->addSql('ALTER TABLE musical_work ADD CONSTRAINT FK_6B399CF271F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE musician_instrument ADD CONSTRAINT FK_2F94EB1A9523AA8A FOREIGN KEY (musician_id) REFERENCES musician (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musician_instrument ADD CONSTRAINT FK_2F94EB1ACF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poster ADD CONSTRAINT FK_2D710CF24E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9A2BEF393');
        $this->addSql('ALTER TABLE musical_work DROP FOREIGN KEY FK_6B399CF2E74E5782');
        $this->addSql('ALTER TABLE musical_work DROP FOREIGN KEY FK_6B399CF271F7E88B');
        $this->addSql('ALTER TABLE poster DROP FOREIGN KEY FK_2D710CF24E7AF8F');
        $this->addSql('ALTER TABLE musician_instrument DROP FOREIGN KEY FK_2F94EB1ACF11D9C');
        $this->addSql('ALTER TABLE musician_instrument DROP FOREIGN KEY FK_2F94EB1A9523AA8A');
        $this->addSql('DROP TABLE category_content');
        $this->addSql('DROP TABLE compositor');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE musical_work');
        $this->addSql('DROP TABLE musician');
        $this->addSql('DROP TABLE musician_instrument');
        $this->addSql('DROP TABLE poster');
        $this->addSql('DROP TABLE press');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
