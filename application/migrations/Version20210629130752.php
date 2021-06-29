<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629130752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, flag VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE difficulty_level CHANGE colour color VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `lines` ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE `lines` ADD CONSTRAINT FK_4F018C96F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_4F018C96F92F3E70 ON `lines` (country_id)');
        $this->addSql('ALTER TABLE user CHANGE apiToken apiToken VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX apitoken ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E22488D7 ON user (apiToken)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `lines` DROP FOREIGN KEY FK_4F018C96F92F3E70');
        $this->addSql('DROP TABLE country');
        $this->addSql('ALTER TABLE difficulty_level CHANGE color colour VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_4F018C96F92F3E70 ON `lines`');
        $this->addSql('ALTER TABLE `lines` DROP country_id');
        $this->addSql('ALTER TABLE user CHANGE apiToken apiToken VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX uniq_8d93d649e22488d7 ON user');
        $this->addSql('CREATE UNIQUE INDEX apiToken ON user (apiToken)');
    }
}
