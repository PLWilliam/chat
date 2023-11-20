<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115144405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friends (id INT AUTO_INCREMENT NOT NULL, friend1_id INT NOT NULL, friend2_id INT NOT NULL, INDEX IDX_21EE706978D71381 (friend1_id), INDEX IDX_21EE70696A62BC6F (friend2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE global_message (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, message LONGTEXT NOT NULL, send_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DD39F09EF624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_21EE706978D71381 FOREIGN KEY (friend1_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_21EE70696A62BC6F FOREIGN KEY (friend2_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE global_message ADD CONSTRAINT FK_DD39F09EF624B39D FOREIGN KEY (sender_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE friends DROP FOREIGN KEY FK_21EE706978D71381');
        $this->addSql('ALTER TABLE friends DROP FOREIGN KEY FK_21EE70696A62BC6F');
        $this->addSql('ALTER TABLE global_message DROP FOREIGN KEY FK_DD39F09EF624B39D');
        $this->addSql('DROP TABLE friends');
        $this->addSql('DROP TABLE global_message');
    }
}
