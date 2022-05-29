<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220529182039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel ADD actividad_id INT NOT NULL, ADD telefono VARCHAR(9) DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED96014FACA FOREIGN KEY (actividad_id) REFERENCES actividad (id)');
        $this->addSql('CREATE INDEX IDX_3535ED96014FACA ON hotel (actividad_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED96014FACA');
        $this->addSql('DROP INDEX IDX_3535ED96014FACA ON hotel');
        $this->addSql('ALTER TABLE hotel DROP actividad_id, DROP telefono');
    }
}
