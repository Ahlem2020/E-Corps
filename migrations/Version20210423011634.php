<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423011634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_A8D351B3EB78CFF1 ON repas');
        $this->addSql('CREATE FULLTEXT INDEX IDX_A8D351B33EB668B0EB78CFF1 ON repas (Titre, Description)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_A8D351B33EB668B0EB78CFF1 ON repas');
        $this->addSql('CREATE FULLTEXT INDEX IDX_A8D351B3EB78CFF1 ON repas (Description)');
    }
}
