<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524060238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ubicaciones DROP FOREIGN KEY FK_584D9A3598260155');
        $this->addSql('DROP INDEX IDX_584D9A3598260155 ON ubicaciones');
        $this->addSql('ALTER TABLE ubicaciones DROP region_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ubicaciones ADD region_id INT NOT NULL');
        $this->addSql('ALTER TABLE ubicaciones ADD CONSTRAINT FK_584D9A3598260155 FOREIGN KEY (region_id) REFERENCES regiones (id)');
        $this->addSql('CREATE INDEX IDX_584D9A3598260155 ON ubicaciones (region_id)');
    }
}
