<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230501085628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE civilisation (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom_civilisation VARCHAR(50) NOT NULL, nom_monument VARCHAR(50) NOT NULL, date_dbuit_civilisation DATE NOT NULL, date_fin_civilisation DATE NOT NULL, description_civilisation VARCHAR(6000) NOT NULL, image VARCHAR(344) NOT NULL, INDEX IDX_5FAD7309FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nourritures (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, civilisation_id INT DEFAULT NULL, nom_nourriture VARCHAR(50) NOT NULL, origine_nourriture VARCHAR(50) NOT NULL, ingrediant VARCHAR(500) NOT NULL, prix_nourriture DOUBLE PRECISION NOT NULL, description_nourriture VARCHAR(5000) NOT NULL, type_nourriture VARCHAR(255) NOT NULL, image VARCHAR(344) NOT NULL, INDEX IDX_9FC4C933FB88E14F (utilisateur_id), INDEX IDX_9FC4C933C5E50B80 (civilisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, nom_user VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE civilisation ADD CONSTRAINT FK_5FAD7309FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE nourritures ADD CONSTRAINT FK_9FC4C933FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE nourritures ADD CONSTRAINT FK_9FC4C933C5E50B80 FOREIGN KEY (civilisation_id) REFERENCES civilisation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE civilisation DROP FOREIGN KEY FK_5FAD7309FB88E14F');
        $this->addSql('ALTER TABLE nourritures DROP FOREIGN KEY FK_9FC4C933FB88E14F');
        $this->addSql('ALTER TABLE nourritures DROP FOREIGN KEY FK_9FC4C933C5E50B80');
        $this->addSql('DROP TABLE civilisation');
        $this->addSql('DROP TABLE nourritures');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
