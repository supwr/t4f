<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180220021927 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE25271AD5CDBF');
        $this->addSql('CREATE TABLE sale_item (id INT AUTO_INCREMENT NOT NULL, sale_id INT DEFAULT NULL, show_id INT DEFAULT NULL, price NUMERIC(10, 0) NOT NULL, create_time DATETIME NOT NULL, INDEX IDX_A35551FB4A7E4868 (sale_id), INDEX IDX_A35551FBD0C1FC64 (show_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, create_time DATETIME NOT NULL, payment_method VARCHAR(255) NOT NULL, credit_card_id INT NOT NULL, billet_id INT NOT NULL, charging_time DATETIME NOT NULL, total_price NUMERIC(10, 0) NOT NULL, cancellation_time DATETIME NOT NULL, INDEX IDX_E54BC0059395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sale_item ADD CONSTRAINT FK_A35551FB4A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id)');
        $this->addSql('ALTER TABLE sale_item ADD CONSTRAINT FK_A35551FBD0C1FC64 FOREIGN KEY (show_id) REFERENCES shows (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC0059395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_item');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sale_item DROP FOREIGN KEY FK_A35551FB4A7E4868');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, create_time DATETIME NOT NULL, INDEX IDX_BA388B79395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_item (id INT AUTO_INCREMENT NOT NULL, cart_id INT DEFAULT NULL, unity_price NUMERIC(10, 0) NOT NULL, total_price NUMERIC(10, 0) NOT NULL, quantity INT NOT NULL, create_time DATETIME NOT NULL, INDEX IDX_F0FE25271AD5CDBF (cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE25271AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('DROP TABLE sale_item');
        $this->addSql('DROP TABLE sale');
    }
}
