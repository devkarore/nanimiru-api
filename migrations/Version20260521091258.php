<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260521091258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anime (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, synopsis LONGTEXT DEFAULT NULL, year INT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, thumbnail_url VARCHAR(255) DEFAULT NULL, age_rating INT DEFAULT NULL, type VARCHAR(50) DEFAULT NULL, nb_episodes INT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE anime_genre (anime_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_EFF953C7794BBE89 (anime_id), INDEX IDX_EFF953C74296D31F (genre_id), PRIMARY KEY (anime_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE anime_mood (anime_id INT NOT NULL, mood_id INT NOT NULL, INDEX IDX_ACCC7CA2794BBE89 (anime_id), INDEX IDX_ACCC7CA2B889D33E (mood_id), PRIMARY KEY (anime_id, mood_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE anime_platform (anime_id INT NOT NULL, platform_id INT NOT NULL, INDEX IDX_DC9202E1794BBE89 (anime_id), INDEX IDX_DC9202E1FFE6496F (platform_id), PRIMARY KEY (anime_id, platform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_835033F85E237E06 (name), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE mood (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(100) NOT NULL, label VARCHAR(100) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_339AEF6989D9B62 (slug), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, icon_url VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_3952D0CB5E237E06 (name), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE anime_genre ADD CONSTRAINT FK_EFF953C7794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_genre ADD CONSTRAINT FK_EFF953C74296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_mood ADD CONSTRAINT FK_ACCC7CA2794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_mood ADD CONSTRAINT FK_ACCC7CA2B889D33E FOREIGN KEY (mood_id) REFERENCES mood (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_platform ADD CONSTRAINT FK_DC9202E1794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_platform ADD CONSTRAINT FK_DC9202E1FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime_genre DROP FOREIGN KEY FK_EFF953C7794BBE89');
        $this->addSql('ALTER TABLE anime_genre DROP FOREIGN KEY FK_EFF953C74296D31F');
        $this->addSql('ALTER TABLE anime_mood DROP FOREIGN KEY FK_ACCC7CA2794BBE89');
        $this->addSql('ALTER TABLE anime_mood DROP FOREIGN KEY FK_ACCC7CA2B889D33E');
        $this->addSql('ALTER TABLE anime_platform DROP FOREIGN KEY FK_DC9202E1794BBE89');
        $this->addSql('ALTER TABLE anime_platform DROP FOREIGN KEY FK_DC9202E1FFE6496F');
        $this->addSql('DROP TABLE anime');
        $this->addSql('DROP TABLE anime_genre');
        $this->addSql('DROP TABLE anime_mood');
        $this->addSql('DROP TABLE anime_platform');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE mood');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
