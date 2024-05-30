<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518125705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acces_pmr (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordonnees_map (id INT AUTO_INCREMENT NOT NULL, id_locatifs_id INT NOT NULL, emplacement INT DEFAULT NULL, svg LONGTEXT DEFAULT NULL, INDEX IDX_EE4D5EB3B13C014A (id_locatifs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaires (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, horaire_debut TIME NOT NULL, horaire_fin TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, id_locatifs_id INT NOT NULL, img_url VARCHAR(100) NOT NULL, INDEX IDX_E01FBE6AB13C014A (id_locatifs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE informations (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, contenu LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locatifs (id INT AUTO_INCREMENT NOT NULL, id_type_locatifs_id INT NOT NULL, id_tarifs_id INT NOT NULL, libelle VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, capacite VARCHAR(50) DEFAULT NULL, superficie INT DEFAULT NULL, mode_paiement VARCHAR(100) DEFAULT NULL, pmr TINYINT(1) NOT NULL, INDEX IDX_EC5A5E5B1BD4EFD (id_type_locatifs_id), UNIQUE INDEX UNIQ_EC5A5E5B75C69458 (id_tarifs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ouvertures (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, actif TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saisons (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarifs (id INT AUTO_INCREMENT NOT NULL, hs_nuitee INT NOT NULL, hs_semaine INT NOT NULL, bs_nuitee INT NOT NULL, bs_semaine INT NOT NULL, hv_nuitee INT NOT NULL, hv_semaine INT NOT NULL, caution INT NOT NULL, arrhes_nuitee INT NOT NULL, arrhes_semaine INT NOT NULL, taxe_sejour INT NOT NULL, tv_jour INT DEFAULT NULL, tv_semaine INT DEFAULT NULL, animaux INT DEFAULT NULL, tarif_dej INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarifs_globaux (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) DEFAULT NULL, valeurs INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coordonnees_map ADD CONSTRAINT FK_EE4D5EB3B13C014A FOREIGN KEY (id_locatifs_id) REFERENCES locatifs (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AB13C014A FOREIGN KEY (id_locatifs_id) REFERENCES locatifs (id)');
        $this->addSql('ALTER TABLE locatifs ADD CONSTRAINT FK_EC5A5E5B1BD4EFD FOREIGN KEY (id_type_locatifs_id) REFERENCES type_locatifs (id)');
        $this->addSql('ALTER TABLE locatifs ADD CONSTRAINT FK_EC5A5E5B75C69458 FOREIGN KEY (id_tarifs_id) REFERENCES tarifs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordonnees_map DROP FOREIGN KEY FK_EE4D5EB3B13C014A');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AB13C014A');
        $this->addSql('ALTER TABLE locatifs DROP FOREIGN KEY FK_EC5A5E5B1BD4EFD');
        $this->addSql('ALTER TABLE locatifs DROP FOREIGN KEY FK_EC5A5E5B75C69458');
        $this->addSql('DROP TABLE acces_pmr');
        $this->addSql('DROP TABLE coordonnees_map');
        $this->addSql('DROP TABLE horaires');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE informations');
        $this->addSql('DROP TABLE locatifs');
        $this->addSql('DROP TABLE ouvertures');
        $this->addSql('DROP TABLE saisons');
        $this->addSql('DROP TABLE tarifs');
        $this->addSql('DROP TABLE tarifs_globaux');
    }
}
