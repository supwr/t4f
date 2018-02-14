<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180214011208 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE show_ticket (id INT AUTO_INCREMENT NOT NULL, show_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, service_fee DOUBLE PRECISION NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_18C78238D0C1FC64 (show_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE show_ticket ADD CONSTRAINT FK_18C78238D0C1FC64 FOREIGN KEY (show_id) REFERENCES shows (id)');
        $this->addSql('DROP TABLE ticket');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, show_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, active TINYINT(1) NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, service_fee DOUBLE PRECISION NOT NULL, INDEX IDX_97A0ADA3D0C1FC64 (show_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3D0C1FC64 FOREIGN KEY (show_id) REFERENCES shows (id)');
        $this->addSql('DROP TABLE show_ticket');
    }
}
