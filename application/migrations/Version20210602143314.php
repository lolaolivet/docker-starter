<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210602143314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `lines` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lines_difficulty_level (lines_id INT NOT NULL, difficulty_level_id INT NOT NULL, INDEX IDX_3FAF3E4D7FEEE6EC (lines_id), INDEX IDX_3FAF3E4D64890943 (difficulty_level_id), PRIMARY KEY(lines_id, difficulty_level_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lines_difficulty_level ADD CONSTRAINT FK_3FAF3E4D7FEEE6EC FOREIGN KEY (lines_id) REFERENCES `lines` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lines_difficulty_level ADD CONSTRAINT FK_3FAF3E4D64890943 FOREIGN KEY (difficulty_level_id) REFERENCES difficulty_level (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lines_difficulty_level DROP FOREIGN KEY FK_3FAF3E4D7FEEE6EC');
        $this->addSql('DROP TABLE `lines`');
        $this->addSql('DROP TABLE lines_difficulty_level');
    }
}
