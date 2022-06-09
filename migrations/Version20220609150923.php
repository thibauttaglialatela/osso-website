<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609150923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE musician_instrument (musician_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_2F94EB1A9523AA8A (musician_id), INDEX IDX_2F94EB1ACF11D9C (instrument_id), PRIMARY KEY(musician_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE musician_instrument ADD CONSTRAINT FK_2F94EB1A9523AA8A FOREIGN KEY (musician_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musician_instrument ADD CONSTRAINT FK_2F94EB1ACF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE instrument_instrument');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE instrument_instrument (instrument_source INT NOT NULL, instrument_target INT NOT NULL, INDEX IDX_F3725ADD6B3C7C3B (instrument_source), INDEX IDX_F3725ADD72D92CB4 (instrument_target), PRIMARY KEY(instrument_source, instrument_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE instrument_instrument ADD CONSTRAINT FK_F3725ADD6B3C7C3B FOREIGN KEY (instrument_source) REFERENCES instrument (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_instrument ADD CONSTRAINT FK_F3725ADD72D92CB4 FOREIGN KEY (instrument_target) REFERENCES instrument (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE musician_instrument');
    }
}
