<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260415120621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anime_mood (anime_id INT NOT NULL, mood_id INT NOT NULL, INDEX IDX_ACCC7CA2794BBE89 (anime_id), INDEX IDX_ACCC7CA2B889D33E (mood_id), PRIMARY KEY (anime_id, mood_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE anime_mood ADD CONSTRAINT FK_ACCC7CA2794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_mood ADD CONSTRAINT FK_ACCC7CA2B889D33E FOREIGN KEY (mood_id) REFERENCES mood (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3952D0CB5E237E06 ON platform (name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime_mood DROP FOREIGN KEY FK_ACCC7CA2794BBE89');
        $this->addSql('ALTER TABLE anime_mood DROP FOREIGN KEY FK_ACCC7CA2B889D33E');
        $this->addSql('DROP TABLE anime_mood');
        $this->addSql('DROP INDEX UNIQ_3952D0CB5E237E06 ON platform');
    }
}
