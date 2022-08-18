<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220809071633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musical_work DROP FOREIGN KEY FK_6B399CF271F7E88B');
        $this->addSql('DROP INDEX IDX_6B399CF271F7E88B ON musical_work');
        $this->addSql('ALTER TABLE musical_work DROP event_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musical_work ADD event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE musical_work ADD CONSTRAINT FK_6B399CF271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6B399CF271F7E88B ON musical_work (event_id)');
    }
}
