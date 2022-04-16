<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412102151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel ADD ubicacion_id INT NOT NULL');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED957E759E8 FOREIGN KEY (ubicacion_id) REFERENCES ubicaciones (id)');
        $this->addSql('CREATE INDEX IDX_3535ED957E759E8 ON hotel (ubicacion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED957E759E8');
        $this->addSql('DROP INDEX IDX_3535ED957E759E8 ON hotel');
        $this->addSql('ALTER TABLE hotel DROP ubicacion_id');
    }
}
