<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260416153145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mood ADD image_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE mood RENAME INDEX uniq_339aef65989d9b62 TO UNIQ_339AEF6989D9B62');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mood DROP image_url');
        $this->addSql('ALTER TABLE mood RENAME INDEX uniq_339aef6989d9b62 TO UNIQ_339AEF65989D9B62');
    }
}
