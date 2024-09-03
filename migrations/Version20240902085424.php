<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240902085424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE scholarship (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, reference BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', school VARCHAR(255) NOT NULL, program VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, level INT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students_scholarships (student_id INT NOT NULL, scholarship_id INT NOT NULL, INDEX IDX_4531AE22CB944F1A (student_id), INDEX IDX_4531AE2228722836 (scholarship_id), PRIMARY KEY(student_id, scholarship_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE students_scholarships ADD CONSTRAINT FK_4531AE22CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE students_scholarships ADD CONSTRAINT FK_4531AE2228722836 FOREIGN KEY (scholarship_id) REFERENCES scholarship (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE students_scholarships DROP FOREIGN KEY FK_4531AE22CB944F1A');
        $this->addSql('ALTER TABLE students_scholarships DROP FOREIGN KEY FK_4531AE2228722836');
        $this->addSql('DROP TABLE scholarship');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE students_scholarships');
    }
}
