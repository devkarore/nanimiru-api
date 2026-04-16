<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260416120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Replace mood name with slug and label.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE mood ADD slug VARCHAR(100) DEFAULT NULL, ADD label VARCHAR(100) DEFAULT NULL');
        $this->addSql("UPDATE mood SET slug = LOWER(REPLACE(name, ' ', '-')), label = name");
        $this->addSql('DROP INDEX UNIQ_339AEF65E237E06 ON mood');
        $this->addSql('ALTER TABLE mood DROP name, CHANGE slug slug VARCHAR(100) NOT NULL, CHANGE label label VARCHAR(100) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_339AEF65989D9B62 ON mood (slug)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE mood ADD name VARCHAR(100) DEFAULT NULL');
        $this->addSql('UPDATE mood SET name = label');
        $this->addSql('DROP INDEX UNIQ_339AEF65989D9B62 ON mood');
        $this->addSql('ALTER TABLE mood DROP slug, DROP label, CHANGE name name VARCHAR(100) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_339AEF65E237E06 ON mood (name)');
    }
}
