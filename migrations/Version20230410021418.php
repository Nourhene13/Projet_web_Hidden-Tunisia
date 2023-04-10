<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230410021418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE circuits (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, point_depat_circuit VARCHAR(255) NOT NULL, date_debut_circuit DATE NOT NULL, date_fin_circuit DATE NOT NULL, nbr_place_dispo INT NOT NULL, description_circuit VARCHAR(8000) NOT NULL, nbr_jour_circuit INT NOT NULL, nom_circuit VARCHAR(255) NOT NULL, INDEX IDX_24A8EC25FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenements (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, titre_evenement VARCHAR(255) NOT NULL, type_evenement VARCHAR(255) NOT NULL, date_evenement DATE NOT NULL, lieux_evenement VARCHAR(255) NOT NULL, prix_evenement DOUBLE PRECISION NOT NULL, description_evenement VARCHAR(8000) NOT NULL, image VARCHAR(300) NOT NULL, INDEX IDX_E10AD400FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invites (id INT AUTO_INCREMENT NOT NULL, nom_invite VARCHAR(255) NOT NULL, prenom_invite VARCHAR(255) NOT NULL, type_invite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom_utilisateur VARCHAR(255) NOT NULL, prenom_utilisateur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE circuits ADD CONSTRAINT FK_24A8EC25FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE evenements ADD CONSTRAINT FK_E10AD400FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE circuits DROP FOREIGN KEY FK_24A8EC25FB88E14F');
        $this->addSql('ALTER TABLE evenements DROP FOREIGN KEY FK_E10AD400FB88E14F');
        $this->addSql('DROP TABLE circuits');
        $this->addSql('DROP TABLE evenements');
        $this->addSql('DROP TABLE invites');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
