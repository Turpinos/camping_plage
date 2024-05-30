<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526200401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordonnees_map DROP FOREIGN KEY FK_EE4D5EB3B13C014A');
        $this->addSql('DROP INDEX IDX_EE4D5EB3B13C014A ON coordonnees_map');
        $this->addSql('ALTER TABLE coordonnees_map CHANGE id_locatifs_id locatifs_id INT NOT NULL');
        $this->addSql('ALTER TABLE coordonnees_map ADD CONSTRAINT FK_EE4D5EB3A92ECCBD FOREIGN KEY (locatifs_id) REFERENCES locatifs (id)');
        $this->addSql('CREATE INDEX IDX_EE4D5EB3A92ECCBD ON coordonnees_map (locatifs_id)');
        $this->addSql('ALTER TABLE locatifs DROP FOREIGN KEY FK_EC5A5E5B1BD4EFD');
        $this->addSql('ALTER TABLE locatifs DROP FOREIGN KEY FK_EC5A5E5B75C69458');
        $this->addSql('DROP INDEX UNIQ_EC5A5E5B75C69458 ON locatifs');
        $this->addSql('DROP INDEX IDX_EC5A5E5B1BD4EFD ON locatifs');
        $this->addSql('ALTER TABLE locatifs ADD type_locatifs_id INT NOT NULL, ADD tarifs_id INT NOT NULL, DROP id_type_locatifs_id, DROP id_tarifs_id');
        $this->addSql('ALTER TABLE locatifs ADD CONSTRAINT FK_EC5A5E5BE2371B2C FOREIGN KEY (type_locatifs_id) REFERENCES type_locatifs (id)');
        $this->addSql('ALTER TABLE locatifs ADD CONSTRAINT FK_EC5A5E5BF5F3287F FOREIGN KEY (tarifs_id) REFERENCES tarifs (id)');
        $this->addSql('CREATE INDEX IDX_EC5A5E5BE2371B2C ON locatifs (type_locatifs_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EC5A5E5BF5F3287F ON locatifs (tarifs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locatifs DROP FOREIGN KEY FK_EC5A5E5BE2371B2C');
        $this->addSql('ALTER TABLE locatifs DROP FOREIGN KEY FK_EC5A5E5BF5F3287F');
        $this->addSql('DROP INDEX IDX_EC5A5E5BE2371B2C ON locatifs');
        $this->addSql('DROP INDEX UNIQ_EC5A5E5BF5F3287F ON locatifs');
        $this->addSql('ALTER TABLE locatifs ADD id_type_locatifs_id INT NOT NULL, ADD id_tarifs_id INT NOT NULL, DROP type_locatifs_id, DROP tarifs_id');
        $this->addSql('ALTER TABLE locatifs ADD CONSTRAINT FK_EC5A5E5B1BD4EFD FOREIGN KEY (id_type_locatifs_id) REFERENCES type_locatifs (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE locatifs ADD CONSTRAINT FK_EC5A5E5B75C69458 FOREIGN KEY (id_tarifs_id) REFERENCES tarifs (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EC5A5E5B75C69458 ON locatifs (id_tarifs_id)');
        $this->addSql('CREATE INDEX IDX_EC5A5E5B1BD4EFD ON locatifs (id_type_locatifs_id)');
        $this->addSql('ALTER TABLE coordonnees_map DROP FOREIGN KEY FK_EE4D5EB3A92ECCBD');
        $this->addSql('DROP INDEX IDX_EE4D5EB3A92ECCBD ON coordonnees_map');
        $this->addSql('ALTER TABLE coordonnees_map CHANGE locatifs_id id_locatifs_id INT NOT NULL');
        $this->addSql('ALTER TABLE coordonnees_map ADD CONSTRAINT FK_EE4D5EB3B13C014A FOREIGN KEY (id_locatifs_id) REFERENCES locatifs (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EE4D5EB3B13C014A ON coordonnees_map (id_locatifs_id)');
    }
}
