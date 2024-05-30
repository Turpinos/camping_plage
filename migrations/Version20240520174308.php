<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240520174308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acces_pmr ADD slug VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE horaires ADD slug VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE informations ADD slug VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE locatifs ADD slug VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE ouvertures ADD slug VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE tarifs_globaux ADD slug VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE type_locatifs ADD slug VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acces_pmr DROP slug');
        $this->addSql('ALTER TABLE type_locatifs DROP slug');
        $this->addSql('ALTER TABLE horaires DROP slug');
        $this->addSql('ALTER TABLE ouvertures DROP slug');
        $this->addSql('ALTER TABLE informations DROP slug');
        $this->addSql('ALTER TABLE tarifs_globaux DROP slug');
        $this->addSql('ALTER TABLE locatifs DROP slug');
    }
}
