<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220419203354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AFD574BC5');
        $this->addSql('DROP INDEX IDX_E01FBE6AFD574BC5 ON images');
        $this->addSql('ALTER TABLE images DROP alojamiento_id, DROP image_file, DROP image_size, DROP updated_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD alojamiento_id INT NOT NULL, ADD image_file VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD image_size INT NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AFD574BC5 FOREIGN KEY (alojamiento_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6AFD574BC5 ON images (alojamiento_id)');
    }
}
