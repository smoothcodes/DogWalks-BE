<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720213139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE dog_walks.place_types_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE dog_walks.place_types (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE dog_walks.place_place_type (place_id VARCHAR(255) NOT NULL, place_type_id INT NOT NULL, PRIMARY KEY(place_id, place_type_id))');
        $this->addSql('CREATE INDEX IDX_68ABB1CDDA6A219 ON dog_walks.place_place_type (place_id)');
        $this->addSql('CREATE INDEX IDX_68ABB1CDF1809B68 ON dog_walks.place_place_type (place_type_id)');
        $this->addSql('ALTER TABLE dog_walks.place_place_type ADD CONSTRAINT FK_68ABB1CDDA6A219 FOREIGN KEY (place_id) REFERENCES dog_walks.places (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dog_walks.place_place_type ADD CONSTRAINT FK_68ABB1CDF1809B68 FOREIGN KEY (place_type_id) REFERENCES dog_walks.place_types (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place_place_type DROP CONSTRAINT FK_68ABB1CDF1809B68');
        $this->addSql('DROP SEQUENCE dog_walks.place_types_id_seq CASCADE');
        $this->addSql('DROP TABLE dog_walks.place_types');
        $this->addSql('DROP TABLE dog_walks.place_place_type');
    }
}
