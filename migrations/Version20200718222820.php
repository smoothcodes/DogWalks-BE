<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200718222820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA dog_walks');
        $this->addSql('CREATE SCHEMA core');
        $this->addSql('CREATE SEQUENCE dog_walks.places_photos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE dog_walks.places (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, longitude NUMERIC(10, 6) NOT NULL, latitude NUMERIC(10, 6) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX coords_search_idx ON dog_walks.places (longitude, latitude)');
        $this->addSql('CREATE TABLE dog_walks.places_photos (id INT NOT NULL, place_id VARCHAR(255) NOT NULL, content BYTEA NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8203DD46DA6A219 ON dog_walks.places_photos (place_id)');
        $this->addSql('CREATE TABLE "core"."users" (id UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_827C5A6DE7927C74 ON "core"."users" (email)');
        $this->addSql('COMMENT ON COLUMN "core"."users".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('LOCK TABLE messenger_messages;');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE dog_walks.places_photos ADD CONSTRAINT FK_8203DD46DA6A219 FOREIGN KEY (place_id) REFERENCES dog_walks.places (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dog_walks.places_photos DROP CONSTRAINT FK_8203DD46DA6A219');
        $this->addSql('DROP SEQUENCE dog_walks.places_photos_id_seq CASCADE');
        $this->addSql('DROP TABLE dog_walks.places');
        $this->addSql('DROP TABLE dog_walks.places_photos');
        $this->addSql('DROP TABLE "core"."users"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
