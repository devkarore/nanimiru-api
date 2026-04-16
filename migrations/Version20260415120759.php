<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260415120759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anime_platform (anime_id INT NOT NULL, platform_id INT NOT NULL, INDEX IDX_DC9202E1794BBE89 (anime_id), INDEX IDX_DC9202E1FFE6496F (platform_id), PRIMARY KEY (anime_id, platform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE anime_platform ADD CONSTRAINT FK_DC9202E1794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_platform ADD CONSTRAINT FK_DC9202E1FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime_platform DROP FOREIGN KEY FK_DC9202E1794BBE89');
        $this->addSql('ALTER TABLE anime_platform DROP FOREIGN KEY FK_DC9202E1FFE6496F');
        $this->addSql('DROP TABLE anime_platform');
    }
}
