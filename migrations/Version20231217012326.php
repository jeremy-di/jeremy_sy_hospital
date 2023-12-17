<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217012326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, address LONGTEXT NOT NULL, zip_code INT NOT NULL, town VARCHAR(255) NOT NULL, insee_number VARCHAR(255) NOT NULL, medical_mutual VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, pathology VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_user (patient_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_4029B816B899279 (patient_id), INDEX IDX_4029B81A76ED395 (user_id), PRIMARY KEY(patient_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, staff_member_id INT NOT NULL, patient_id INT DEFAULT NULL, number VARCHAR(255) NOT NULL, service VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_729F519B44DB03B1 (staff_member_id), INDEX IDX_729F519B6B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transmission (id INT AUTO_INCREMENT NOT NULL, staff_member_id INT NOT NULL, title VARCHAR(255) NOT NULL, date DATETIME NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_7F87199F44DB03B1 (staff_member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE treatment (id INT AUTO_INCREMENT NOT NULL, staff_member_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, posology VARCHAR(255) NOT NULL, validation VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_98013C3144DB03B1 (staff_member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE treatment_patient (treatment_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_621C1527471C0366 (treatment_id), INDEX IDX_621C15276B899279 (patient_id), PRIMARY KEY(treatment_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, service VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, job_title VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient_user ADD CONSTRAINT FK_4029B816B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_user ADD CONSTRAINT FK_4029B81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B44DB03B1 FOREIGN KEY (staff_member_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE transmission ADD CONSTRAINT FK_7F87199F44DB03B1 FOREIGN KEY (staff_member_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE treatment ADD CONSTRAINT FK_98013C3144DB03B1 FOREIGN KEY (staff_member_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE treatment_patient ADD CONSTRAINT FK_621C1527471C0366 FOREIGN KEY (treatment_id) REFERENCES treatment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE treatment_patient ADD CONSTRAINT FK_621C15276B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient_user DROP FOREIGN KEY FK_4029B816B899279');
        $this->addSql('ALTER TABLE patient_user DROP FOREIGN KEY FK_4029B81A76ED395');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B44DB03B1');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B6B899279');
        $this->addSql('ALTER TABLE transmission DROP FOREIGN KEY FK_7F87199F44DB03B1');
        $this->addSql('ALTER TABLE treatment DROP FOREIGN KEY FK_98013C3144DB03B1');
        $this->addSql('ALTER TABLE treatment_patient DROP FOREIGN KEY FK_621C1527471C0366');
        $this->addSql('ALTER TABLE treatment_patient DROP FOREIGN KEY FK_621C15276B899279');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE patient_user');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE transmission');
        $this->addSql('DROP TABLE treatment');
        $this->addSql('DROP TABLE treatment_patient');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
