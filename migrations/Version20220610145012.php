<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610145012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA75BB66C05');
        $this->addSql('DROP INDEX IDX_3BAE0AA75BB66C05 ON event');
        $this->addSql('ALTER TABLE event DROP poster_id');
        $this->addSql('ALTER TABLE musician DROP FOREIGN KEY FK_317141275BB66C05');
        $this->addSql('DROP INDEX UNIQ_317141275BB66C05 ON musician');
        $this->addSql('ALTER TABLE musician DROP poster_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD poster_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA75BB66C05 FOREIGN KEY (poster_id) REFERENCES poster (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3BAE0AA75BB66C05 ON event (poster_id)');
        $this->addSql('ALTER TABLE musician ADD poster_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE musician ADD CONSTRAINT FK_317141275BB66C05 FOREIGN KEY (poster_id) REFERENCES poster (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_317141275BB66C05 ON musician (poster_id)');
    }
}
