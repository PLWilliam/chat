<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115163330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE private_message (id INT AUTO_INCREMENT NOT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_4744FC9B56AE248B (user1_id), INDEX IDX_4744FC9B441B8B65 (user2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE private_message ADD CONSTRAINT FK_4744FC9B56AE248B FOREIGN KEY (user1_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE private_message ADD CONSTRAINT FK_4744FC9B441B8B65 FOREIGN KEY (user2_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE friendstest DROP FOREIGN KEY FK_463460E96A62BC6F');
        $this->addSql('ALTER TABLE friendstest DROP FOREIGN KEY FK_463460E978D71381');
        $this->addSql('DROP TABLE friendstest');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friendstest (id INT AUTO_INCREMENT NOT NULL, friend1_id INT NOT NULL, friend2_id INT NOT NULL, INDEX IDX_463460E978D71381 (friend1_id), INDEX IDX_463460E96A62BC6F (friend2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE friendstest ADD CONSTRAINT FK_463460E96A62BC6F FOREIGN KEY (friend2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friendstest ADD CONSTRAINT FK_463460E978D71381 FOREIGN KEY (friend1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message DROP FOREIGN KEY FK_4744FC9B56AE248B');
        $this->addSql('ALTER TABLE private_message DROP FOREIGN KEY FK_4744FC9B441B8B65');
        $this->addSql('DROP TABLE private_message');
    }
}
