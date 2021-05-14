<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210514142459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE food ADD familyfood_id INT NOT NULL, ADD preservation_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F78A8D3752 FOREIGN KEY (familyfood_id) REFERENCES family_food (id)');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F7B806376B FOREIGN KEY (preservation_id) REFERENCES preservation (id)');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D43829F78A8D3752 ON food (familyfood_id)');
        $this->addSql('CREATE INDEX IDX_D43829F7B806376B ON food (preservation_id)');
        $this->addSql('CREATE INDEX IDX_D43829F7A76ED395 ON food (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F78A8D3752');
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F7B806376B');
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F7A76ED395');
        $this->addSql('DROP INDEX IDX_D43829F78A8D3752 ON food');
        $this->addSql('DROP INDEX IDX_D43829F7B806376B ON food');
        $this->addSql('DROP INDEX IDX_D43829F7A76ED395 ON food');
        $this->addSql('ALTER TABLE food DROP familyfood_id, DROP preservation_id, DROP user_id');
    }
}
