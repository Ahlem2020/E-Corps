<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423005313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX idx_a8d351b33eb668b0 ON repas');
        $this->addSql('CREATE FULLTEXT INDEX IDX_A8D351B3FF7747B4 ON repas (titre)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX idx_a8d351b3ff7747b4 ON repas');
        $this->addSql('CREATE FULLTEXT INDEX IDX_A8D351B33EB668B0 ON repas (Titre)');
    }
}
