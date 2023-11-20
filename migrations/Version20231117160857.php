<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117160857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE friendsazerty DROP FOREIGN KEY FK_2109EFD66A62BC6F');
        $this->addSql('ALTER TABLE friendsazerty DROP FOREIGN KEY FK_2109EFD678D71381');
        $this->addSql('ALTER TABLE friendsazetyu DROP FOREIGN KEY FK_999CA10278D71381');
        $this->addSql('ALTER TABLE friendsazetyu DROP FOREIGN KEY FK_999CA1026A62BC6F');
        $this->addSql('ALTER TABLE private_messageazetyu DROP FOREIGN KEY FK_DB5C0A70441B8B65');
        $this->addSql('ALTER TABLE private_messageazetyu DROP FOREIGN KEY FK_DB5C0A7056AE248B');
        $this->addSql('ALTER TABLE private_message_azesdf DROP FOREIGN KEY FK_E31BBCEE441B8B65');
        $this->addSql('ALTER TABLE private_message_azesdf DROP FOREIGN KEY FK_E31BBCEE56AE248B');
        $this->addSql('ALTER TABLE private_message_azeuio DROP FOREIGN KEY FK_2BE406B556AE248B');
        $this->addSql('ALTER TABLE private_message_azeuio DROP FOREIGN KEY FK_2BE406B5441B8B65');
        $this->addSql('DROP TABLE friendsazerty');
        $this->addSql('DROP TABLE friendsazetyu');
        $this->addSql('DROP TABLE private_messageazetyu');
        $this->addSql('DROP TABLE private_message_azesdf');
        $this->addSql('DROP TABLE private_message_azeuio');
        $this->addSql('ALTER TABLE friends ADD private_message VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friendsazerty (id INT AUTO_INCREMENT NOT NULL, friend1_id INT NOT NULL, friend2_id INT NOT NULL, INDEX IDX_2109EFD66A62BC6F (friend2_id), INDEX IDX_2109EFD678D71381 (friend1_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE friendsazetyu (id INT AUTO_INCREMENT NOT NULL, friend1_id INT NOT NULL, friend2_id INT NOT NULL, INDEX IDX_999CA10278D71381 (friend1_id), INDEX IDX_999CA1026A62BC6F (friend2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE private_messageazetyu (id INT AUTO_INCREMENT NOT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, message LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_DB5C0A7056AE248B (user1_id), INDEX IDX_DB5C0A70441B8B65 (user2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE private_message_azesdf (id INT AUTO_INCREMENT NOT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, message LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E31BBCEE56AE248B (user1_id), INDEX IDX_E31BBCEE441B8B65 (user2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE private_message_azeuio (id INT AUTO_INCREMENT NOT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, message LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_2BE406B556AE248B (user1_id), INDEX IDX_2BE406B5441B8B65 (user2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE friendsazerty ADD CONSTRAINT FK_2109EFD66A62BC6F FOREIGN KEY (friend2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friendsazerty ADD CONSTRAINT FK_2109EFD678D71381 FOREIGN KEY (friend1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friendsazetyu ADD CONSTRAINT FK_999CA10278D71381 FOREIGN KEY (friend1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friendsazetyu ADD CONSTRAINT FK_999CA1026A62BC6F FOREIGN KEY (friend2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_messageazetyu ADD CONSTRAINT FK_DB5C0A70441B8B65 FOREIGN KEY (user2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_messageazetyu ADD CONSTRAINT FK_DB5C0A7056AE248B FOREIGN KEY (user1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message_azesdf ADD CONSTRAINT FK_E31BBCEE441B8B65 FOREIGN KEY (user2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message_azesdf ADD CONSTRAINT FK_E31BBCEE56AE248B FOREIGN KEY (user1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message_azeuio ADD CONSTRAINT FK_2BE406B556AE248B FOREIGN KEY (user1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message_azeuio ADD CONSTRAINT FK_2BE406B5441B8B65 FOREIGN KEY (user2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friends DROP private_message');
    }
}
