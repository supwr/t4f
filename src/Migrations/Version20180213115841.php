<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180213115841 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sector DROP FOREIGN KEY FK_4BA3D9E871F7E88B');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_ticket');
        $this->addSql('DROP TABLE sector');
        $this->addSql('ALTER TABLE ticket ADD show_id INT DEFAULT NULL, ADD quantity INT NOT NULL, ADD price DOUBLE PRECISION NOT NULL, ADD service_fee DOUBLE PRECISION NOT NULL, DROP description');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3D0C1FC64 FOREIGN KEY (show_id) REFERENCES shows (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3D0C1FC64 ON ticket (show_id)');
        $this->addSql('ALTER TABLE shows ADD artist_id INT DEFAULT NULL, ADD venue_id INT DEFAULT NULL, ADD show_date DATETIME NOT NULL, ADD sales_start_date DATE NOT NULL');
        $this->addSql('ALTER TABLE shows ADD CONSTRAINT FK_6C3BF144B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE shows ADD CONSTRAINT FK_6C3BF14440A73EBA FOREIGN KEY (venue_id) REFERENCES venue (id)');
        $this->addSql('CREATE INDEX IDX_6C3BF144B7970CF8 ON shows (artist_id)');
        $this->addSql('CREATE INDEX IDX_6C3BF14440A73EBA ON shows (venue_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, venue_id INT DEFAULT NULL, show_id INT DEFAULT NULL, event_date DATETIME NOT NULL, sales_start_date DATE NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_3BAE0AA7D0C1FC64 (show_id), INDEX IDX_3BAE0AA740A73EBA (venue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_ticket (id INT AUTO_INCREMENT NOT NULL, ticket_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_A539DAF1700047D2 (ticket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sector (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, seats INT NOT NULL, seat_price DOUBLE PRECISION NOT NULL, INDEX IDX_4BA3D9E871F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA740A73EBA FOREIGN KEY (venue_id) REFERENCES venue (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7D0C1FC64 FOREIGN KEY (show_id) REFERENCES shows (id)');
        $this->addSql('ALTER TABLE event_ticket ADD CONSTRAINT FK_A539DAF1700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE sector ADD CONSTRAINT FK_4BA3D9E871F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE shows DROP FOREIGN KEY FK_6C3BF144B7970CF8');
        $this->addSql('ALTER TABLE shows DROP FOREIGN KEY FK_6C3BF14440A73EBA');
        $this->addSql('DROP INDEX IDX_6C3BF144B7970CF8 ON shows');
        $this->addSql('DROP INDEX IDX_6C3BF14440A73EBA ON shows');
        $this->addSql('ALTER TABLE shows DROP artist_id, DROP venue_id, DROP show_date, DROP sales_start_date');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3D0C1FC64');
        $this->addSql('DROP INDEX IDX_97A0ADA3D0C1FC64 ON ticket');
        $this->addSql('ALTER TABLE ticket ADD description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, DROP show_id, DROP quantity, DROP price, DROP service_fee');
    }
}
