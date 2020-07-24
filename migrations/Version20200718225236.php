<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200718225236 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dog_walks.places ALTER latitude TYPE NUMERIC(20, 17)');
        $this->addSql('ALTER TABLE dog_walks.places ALTER longitude TYPE NUMERIC(20, 17)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dog_walks.places ALTER latitude TYPE NUMERIC(10, 6)');
        $this->addSql('ALTER TABLE dog_walks.places ALTER longitude TYPE NUMERIC(10, 6)');
    }
}
