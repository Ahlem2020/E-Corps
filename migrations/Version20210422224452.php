<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210422224452 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repas DROP FOREIGN KEY FK_A8D351B38CB1FF91');
        $this->addSql('CREATE FULLTEXT INDEX IDX_A8D351B33EB668B0 ON repas (Titre)');
        $this->addSql('DROP INDEX id_regime ON repas');
        $this->addSql('CREATE INDEX IDX_A8D351B38CB1FF91 ON repas (id_regime)');
        $this->addSql('ALTER TABLE repas ADD CONSTRAINT FK_A8D351B38CB1FF91 FOREIGN KEY (id_regime) REFERENCES regimes (ID) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_A8D351B33EB668B0 ON repas');
        $this->addSql('ALTER TABLE repas DROP FOREIGN KEY FK_A8D351B38CB1FF91');
        $this->addSql('DROP INDEX idx_a8d351b38cb1ff91 ON repas');
        $this->addSql('CREATE INDEX id_regime ON repas (id_regime)');
        $this->addSql('ALTER TABLE repas ADD CONSTRAINT FK_A8D351B38CB1FF91 FOREIGN KEY (id_regime) REFERENCES regimes (ID) ON DELETE CASCADE');
    }
}
