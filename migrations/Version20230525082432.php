<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525082432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bank DROP FOREIGN KEY FK_D860BF7AC325A696');
        $this->addSql('ALTER TABLE abonne DROP FOREIGN KEY FK_76328BF0A76ED395');
        $this->addSql('DROP TABLE abonne');
        $this->addSql('DROP INDEX UNIQ_D860BF7AC325A696 ON bank');
        $this->addSql('ALTER TABLE bank CHANGE abonne_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE bank ADD CONSTRAINT FK_D860BF7AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D860BF7AA76ED395 ON bank (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonne (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_76328BF0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE abonne ADD CONSTRAINT FK_76328BF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bank DROP FOREIGN KEY FK_D860BF7AA76ED395');
        $this->addSql('DROP INDEX UNIQ_D860BF7AA76ED395 ON bank');
        $this->addSql('ALTER TABLE bank CHANGE user_id abonne_id INT NOT NULL');
        $this->addSql('ALTER TABLE bank ADD CONSTRAINT FK_D860BF7AC325A696 FOREIGN KEY (abonne_id) REFERENCES abonne (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D860BF7AC325A696 ON bank (abonne_id)');
    }
}
