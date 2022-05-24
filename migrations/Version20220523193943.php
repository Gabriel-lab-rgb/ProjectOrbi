<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523193943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedido_reserva ADD pedido_id INT NOT NULL');
        $this->addSql('ALTER TABLE pedido_reserva ADD CONSTRAINT FK_7AF4A6554854653A FOREIGN KEY (pedido_id) REFERENCES reserva (id)');
        $this->addSql('CREATE INDEX IDX_7AF4A6554854653A ON pedido_reserva (pedido_id)');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B3243BB18');
        $this->addSql('DROP INDEX IDX_188D2E3B3243BB18 ON reserva');
        $this->addSql('ALTER TABLE reserva DROP hotel_id, DROP llegada, DROP salida');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedido_reserva DROP FOREIGN KEY FK_7AF4A6554854653A');
        $this->addSql('DROP INDEX IDX_7AF4A6554854653A ON pedido_reserva');
        $this->addSql('ALTER TABLE pedido_reserva DROP pedido_id');
        $this->addSql('ALTER TABLE reserva ADD hotel_id INT NOT NULL, ADD llegada DATE NOT NULL, ADD salida DATE NOT NULL');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_188D2E3B3243BB18 ON reserva (hotel_id)');
    }
}
