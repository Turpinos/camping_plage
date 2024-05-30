<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526164232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarifs ADD dej_inclu TINYINT(1) DEFAULT NULL, DROP taxe_sejour, DROP tarif_dej, CHANGE hs_semaine hs_semaine INT DEFAULT NULL, CHANGE bs_nuitee bs_nuitee INT DEFAULT NULL, CHANGE bs_semaine bs_semaine INT DEFAULT NULL, CHANGE caution caution INT DEFAULT NULL, CHANGE arrhes_nuitee arrhes_nuitee INT DEFAULT NULL, CHANGE arrhes_semaine arrhes_semaine INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarifs ADD taxe_sejour DOUBLE PRECISION NOT NULL, ADD tarif_dej INT DEFAULT NULL, DROP dej_inclu, CHANGE hs_semaine hs_semaine INT NOT NULL, CHANGE bs_nuitee bs_nuitee INT NOT NULL, CHANGE bs_semaine bs_semaine INT NOT NULL, CHANGE caution caution INT NOT NULL, CHANGE arrhes_nuitee arrhes_nuitee INT NOT NULL, CHANGE arrhes_semaine arrhes_semaine INT NOT NULL');
    }
}
