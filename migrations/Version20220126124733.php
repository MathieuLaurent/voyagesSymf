<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126124733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voyage_tags (voyage_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_FF2E5CA868C9E5AF (voyage_id), INDEX IDX_FF2E5CA88D7B4FB4 (tags_id), PRIMARY KEY(voyage_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_user (voyage_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1D011EC768C9E5AF (voyage_id), INDEX IDX_1D011EC7A76ED395 (user_id), PRIMARY KEY(voyage_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voyage_tags ADD CONSTRAINT FK_FF2E5CA868C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_tags ADD CONSTRAINT FK_FF2E5CA88D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_user ADD CONSTRAINT FK_1D011EC768C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_user ADD CONSTRAINT FK_1D011EC7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_3F9D895512469DE2 ON voyage (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE voyage_tags');
        $this->addSql('DROP TABLE voyage_user');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D895512469DE2');
        $this->addSql('DROP INDEX IDX_3F9D895512469DE2 ON voyage');
        $this->addSql('ALTER TABLE voyage DROP category_id');
    }
}
