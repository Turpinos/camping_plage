<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114123723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventaire ADD locatif_id INT NOT NULL');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E05BF2CCE2 FOREIGN KEY (locatif_id) REFERENCES locatifs (id)');
        $this->addSql('CREATE INDEX IDX_338920E05BF2CCE2 ON inventaire (locatif_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E05BF2CCE2');
        $this->addSql('DROP INDEX IDX_338920E05BF2CCE2 ON inventaire');
        $this->addSql('ALTER TABLE inventaire DROP locatif_id');
    }
}
