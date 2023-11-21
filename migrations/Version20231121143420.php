<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121143420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friend_request_status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE private_message_azerty DROP FOREIGN KEY FK_2513C97D56AE248B');
        $this->addSql('ALTER TABLE private_message_azerty DROP FOREIGN KEY FK_2513C97D441B8B65');
        $this->addSql('ALTER TABLE private_message_azezer DROP FOREIGN KEY FK_EF0B625D441B8B65');
        $this->addSql('ALTER TABLE private_message_azezer DROP FOREIGN KEY FK_EF0B625D56AE248B');
        $this->addSql('ALTER TABLE private_message_uioaze DROP FOREIGN KEY FK_614BE82E441B8B65');
        $this->addSql('ALTER TABLE private_message_uioaze DROP FOREIGN KEY FK_614BE82E56AE248B');
        $this->addSql('DROP TABLE private_message_azerty');
        $this->addSql('DROP TABLE private_message_azezer');
        $this->addSql('DROP TABLE private_message_uioaze');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE private_message_azerty (id INT AUTO_INCREMENT NOT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, message LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_2513C97D56AE248B (user1_id), INDEX IDX_2513C97D441B8B65 (user2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE private_message_azezer (id INT AUTO_INCREMENT NOT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, message LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_EF0B625D56AE248B (user1_id), INDEX IDX_EF0B625D441B8B65 (user2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE private_message_uioaze (id INT AUTO_INCREMENT NOT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, message LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_614BE82E56AE248B (user1_id), INDEX IDX_614BE82E441B8B65 (user2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE private_message_azerty ADD CONSTRAINT FK_2513C97D56AE248B FOREIGN KEY (user1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message_azerty ADD CONSTRAINT FK_2513C97D441B8B65 FOREIGN KEY (user2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message_azezer ADD CONSTRAINT FK_EF0B625D441B8B65 FOREIGN KEY (user2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message_azezer ADD CONSTRAINT FK_EF0B625D56AE248B FOREIGN KEY (user1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message_uioaze ADD CONSTRAINT FK_614BE82E441B8B65 FOREIGN KEY (user2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message_uioaze ADD CONSTRAINT FK_614BE82E56AE248B FOREIGN KEY (user1_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE friend_request_status');
    }
}
