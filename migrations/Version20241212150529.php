<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241212150529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AB13C014A');
        $this->addSql('DROP INDEX IDX_E01FBE6AB13C014A ON images');
        $this->addSql('ALTER TABLE images CHANGE id_locatifs_id locatifs_id INT NOT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AA92ECCBD FOREIGN KEY (locatifs_id) REFERENCES locatifs (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6AA92ECCBD ON images (locatifs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AA92ECCBD');
        $this->addSql('DROP INDEX IDX_E01FBE6AA92ECCBD ON images');
        $this->addSql('ALTER TABLE images CHANGE locatifs_id id_locatifs_id INT NOT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AB13C014A FOREIGN KEY (id_locatifs_id) REFERENCES locatifs (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E01FBE6AB13C014A ON images (id_locatifs_id)');
    }
}
