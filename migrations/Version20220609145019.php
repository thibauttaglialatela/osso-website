<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609145019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE instrument_instrument (instrument_source INT NOT NULL, instrument_target INT NOT NULL, INDEX IDX_F3725ADD6B3C7C3B (instrument_source), INDEX IDX_F3725ADD72D92CB4 (instrument_target), PRIMARY KEY(instrument_source, instrument_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instrument_instrument ADD CONSTRAINT FK_F3725ADD6B3C7C3B FOREIGN KEY (instrument_source) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_instrument ADD CONSTRAINT FK_F3725ADD72D92CB4 FOREIGN KEY (instrument_target) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content ADD category_content_id INT NOT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9A2BEF393 FOREIGN KEY (category_content_id) REFERENCES category_content (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A9A2BEF393 ON content (category_content_id)');
        $this->addSql('ALTER TABLE event ADD event_type_id INT NOT NULL, ADD poster_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7401B253C FOREIGN KEY (event_type_id) REFERENCES event_type (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA75BB66C05 FOREIGN KEY (poster_id) REFERENCES poster (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7401B253C ON event (event_type_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA75BB66C05 ON event (poster_id)');
        $this->addSql('ALTER TABLE `member` ADD poster_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `member` ADD CONSTRAINT FK_70E4FA785BB66C05 FOREIGN KEY (poster_id) REFERENCES poster (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E4FA785BB66C05 ON `member` (poster_id)');
        $this->addSql('ALTER TABLE musical_work ADD compositor_id INT DEFAULT NULL, ADD event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE musical_work ADD CONSTRAINT FK_6B399CF2E74E5782 FOREIGN KEY (compositor_id) REFERENCES compositor (id)');
        $this->addSql('ALTER TABLE musical_work ADD CONSTRAINT FK_6B399CF271F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_6B399CF2E74E5782 ON musical_work (compositor_id)');
        $this->addSql('CREATE INDEX IDX_6B399CF271F7E88B ON musical_work (event_id)');
        $this->addSql('ALTER TABLE poster ADD gallery_id INT NOT NULL');
        $this->addSql('ALTER TABLE poster ADD CONSTRAINT FK_2D710CF24E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('CREATE INDEX IDX_2D710CF24E7AF8F ON poster (gallery_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE instrument_instrument');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9A2BEF393');
        $this->addSql('DROP INDEX IDX_FEC530A9A2BEF393 ON content');
        $this->addSql('ALTER TABLE content DROP category_content_id');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7401B253C');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA75BB66C05');
        $this->addSql('DROP INDEX IDX_3BAE0AA7401B253C ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA75BB66C05 ON event');
        $this->addSql('ALTER TABLE event DROP event_type_id, DROP poster_id');
        $this->addSql('ALTER TABLE `member` DROP FOREIGN KEY FK_70E4FA785BB66C05');
        $this->addSql('DROP INDEX UNIQ_70E4FA785BB66C05 ON `member`');
        $this->addSql('ALTER TABLE `member` DROP poster_id');
        $this->addSql('ALTER TABLE musical_work DROP FOREIGN KEY FK_6B399CF2E74E5782');
        $this->addSql('ALTER TABLE musical_work DROP FOREIGN KEY FK_6B399CF271F7E88B');
        $this->addSql('DROP INDEX IDX_6B399CF2E74E5782 ON musical_work');
        $this->addSql('DROP INDEX IDX_6B399CF271F7E88B ON musical_work');
        $this->addSql('ALTER TABLE musical_work DROP compositor_id, DROP event_id');
        $this->addSql('ALTER TABLE poster DROP FOREIGN KEY FK_2D710CF24E7AF8F');
        $this->addSql('DROP INDEX IDX_2D710CF24E7AF8F ON poster');
        $this->addSql('ALTER TABLE poster DROP gallery_id');
    }
}
