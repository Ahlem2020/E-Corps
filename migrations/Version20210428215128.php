<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428215128 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, content LONGTEXT NOT NULL, active TINYINT(1) NOT NULL, email VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, rgpd TINYINT(1) NOT NULL, ID_Event INT DEFAULT NULL, INDEX IDX_5F9E962A22213F59 (ID_Event), INDEX IDX_5F9E962A727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A22213F59 FOREIGN KEY (ID_Event) REFERENCES event (ID_Event)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A727ACA70 FOREIGN KEY (parent_id) REFERENCES comments (id)');
        $this->addSql('DROP TABLE comment');
        $this->addSql('ALTER TABLE compte CHANGE compteLogin compteLogin VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY Categorie');
        $this->addSql('ALTER TABLE event DROP Localisation, CHANGE categorieE categorieE INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7F549D3F1 FOREIGN KEY (categorieE) REFERENCES categorieevent (categorieE)');
        $this->addSql('ALTER TABLE participante DROP FOREIGN KEY ParticicpantE');
        $this->addSql('ALTER TABLE participante ADD CONSTRAINT FK_85BDC5C322213F59 FOREIGN KEY (ID_Event) REFERENCES event (ID_Event)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A727ACA70');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, author_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE comments');
        $this->addSql('ALTER TABLE compte CHANGE compteLogin compteLogin VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7F549D3F1');
        $this->addSql('ALTER TABLE event ADD Localisation VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE categorieE categorieE INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT Categorie FOREIGN KEY (categorieE) REFERENCES categorieevent (categorieE) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participante DROP FOREIGN KEY FK_85BDC5C322213F59');
        $this->addSql('ALTER TABLE participante ADD CONSTRAINT ParticicpantE FOREIGN KEY (ID_Event) REFERENCES event (ID_Event) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
