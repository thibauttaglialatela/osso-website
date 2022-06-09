<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609140608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A9CCA06B90 ON content (fct_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3CBF69DDCCA06B90 ON instrument (fct_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_FEC530A9CCA06B90 ON content');
        $this->addSql('DROP INDEX UNIQ_3CBF69DDCCA06B90 ON instrument');
    }
}
