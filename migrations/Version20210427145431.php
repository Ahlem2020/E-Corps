<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427145431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, author_name VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentairee CHANGE ID_Event ID_Event INT DEFAULT NULL, CHANGE compteLogin compteLogin VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE compte CHANGE compteLogin compteLogin VARCHAR(20) NOT NULL, CHANGE isClosed isClosed TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE participante CHANGE ID_Event ID_Event INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reaction CHANGE ID_Event ID_Event INT DEFAULT NULL, CHANGE compteLogin compteLogin VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE comment');
        $this->addSql('ALTER TABLE commentairee CHANGE ID_Event ID_Event INT NOT NULL, CHANGE compteLogin compteLogin VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE compte CHANGE compteLogin compteLogin VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE isClosed isClosed TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE participante CHANGE ID_Event ID_Event INT NOT NULL');
        $this->addSql('ALTER TABLE reaction CHANGE ID_Event ID_Event INT NOT NULL, CHANGE compteLogin compteLogin VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
    }
}
