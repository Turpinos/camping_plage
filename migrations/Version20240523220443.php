<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523220443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarifs ADD bs_nuitee_2 INT DEFAULT NULL, ADD bs_nuitee_3 INT DEFAULT NULL, ADD bs_nuitee_4 INT DEFAULT NULL, ADD hs_nuitee_2 INT DEFAULT NULL, ADD hs_nuitee_3 INT DEFAULT NULL, ADD hs_nuitee_4 INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarifs DROP bs_nuitee_2, DROP bs_nuitee_3, DROP bs_nuitee_4, DROP hs_nuitee_2, DROP hs_nuitee_3, DROP hs_nuitee_4');
    }
}
