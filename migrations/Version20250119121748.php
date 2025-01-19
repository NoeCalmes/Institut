<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250119121748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574ABAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('DROP INDEX `primary` ON matiere_stage');
        $this->addSql('ALTER TABLE matiere_stage ADD CONSTRAINT FK_4EDC3D1C2298D193 FOREIGN KEY (stage_id) REFERENCES stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_stage ADD CONSTRAINT FK_4EDC3D1CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_stage ADD PRIMARY KEY (stage_id, matiere_id)');
        $this->addSql('ALTER TABLE stagiaire_stage ADD CONSTRAINT FK_979FD2C5BBA93DD6 FOREIGN KEY (stagiaire_id) REFERENCES stagiaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stagiaire_stage ADD CONSTRAINT FK_979FD2C52298D193 FOREIGN KEY (stage_id) REFERENCES stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE role role VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d6493b8f601a TO UNIQ_8D93D649AA08CB10');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574ABAB22EE9');
        $this->addSql('ALTER TABLE user CHANGE role role VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649aa08cb10 TO UNIQ_8D93D6493B8F601A');
        $this->addSql('ALTER TABLE matiere_stage DROP FOREIGN KEY FK_4EDC3D1C2298D193');
        $this->addSql('ALTER TABLE matiere_stage DROP FOREIGN KEY FK_4EDC3D1CF46CD258');
        $this->addSql('DROP INDEX `PRIMARY` ON matiere_stage');
        $this->addSql('ALTER TABLE matiere_stage ADD PRIMARY KEY (matiere_id, stage_id)');
        $this->addSql('ALTER TABLE stagiaire_stage DROP FOREIGN KEY FK_979FD2C5BBA93DD6');
        $this->addSql('ALTER TABLE stagiaire_stage DROP FOREIGN KEY FK_979FD2C52298D193');
    }
}
