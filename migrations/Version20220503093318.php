<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503093318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE background_item (background_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_E689382FC93D69EA (background_id), INDEX IDX_E689382F126F525E (item_id), PRIMARY KEY(background_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playable_class_item (playable_class_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_BECE067ED401D3D6 (playable_class_id), INDEX IDX_BECE067E126F525E (item_id), PRIMARY KEY(playable_class_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playable_class_ability (playable_class_id INT NOT NULL, ability_id INT NOT NULL, INDEX IDX_35087487D401D3D6 (playable_class_id), INDEX IDX_350874878016D8B2 (ability_id), PRIMARY KEY(playable_class_id, ability_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playable_class_armor (playable_class_id INT NOT NULL, armor_id INT NOT NULL, INDEX IDX_F2344A87D401D3D6 (playable_class_id), INDEX IDX_F2344A87F5AA3663 (armor_id), PRIMARY KEY(playable_class_id, armor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playable_class_weapon (playable_class_id INT NOT NULL, weapon_id INT NOT NULL, INDEX IDX_AEA91CE6D401D3D6 (playable_class_id), INDEX IDX_AEA91CE695B82273 (weapon_id), PRIMARY KEY(playable_class_id, weapon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE background_item ADD CONSTRAINT FK_E689382FC93D69EA FOREIGN KEY (background_id) REFERENCES background (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE background_item ADD CONSTRAINT FK_E689382F126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_item ADD CONSTRAINT FK_BECE067ED401D3D6 FOREIGN KEY (playable_class_id) REFERENCES playable_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_item ADD CONSTRAINT FK_BECE067E126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_ability ADD CONSTRAINT FK_35087487D401D3D6 FOREIGN KEY (playable_class_id) REFERENCES playable_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_ability ADD CONSTRAINT FK_350874878016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_armor ADD CONSTRAINT FK_F2344A87D401D3D6 FOREIGN KEY (playable_class_id) REFERENCES playable_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_armor ADD CONSTRAINT FK_F2344A87F5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_weapon ADD CONSTRAINT FK_AEA91CE6D401D3D6 FOREIGN KEY (playable_class_id) REFERENCES playable_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_weapon ADD CONSTRAINT FK_AEA91CE695B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subclass ADD playable_class_id INT NOT NULL');
        $this->addSql('ALTER TABLE subclass ADD CONSTRAINT FK_97F8F645D401D3D6 FOREIGN KEY (playable_class_id) REFERENCES playable_class (id)');
        $this->addSql('CREATE INDEX IDX_97F8F645D401D3D6 ON subclass (playable_class_id)');
        $this->addSql('ALTER TABLE subrace ADD race_id INT NOT NULL');
        $this->addSql('ALTER TABLE subrace ADD CONSTRAINT FK_3DAC9246E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('CREATE INDEX IDX_3DAC9246E59D40D ON subrace (race_id)');
        $this->addSql('ALTER TABLE user ADD avatar_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64986383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64986383B10 ON user (avatar_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE background_item');
        $this->addSql('DROP TABLE playable_class_item');
        $this->addSql('DROP TABLE playable_class_ability');
        $this->addSql('DROP TABLE playable_class_armor');
        $this->addSql('DROP TABLE playable_class_weapon');
        $this->addSql('ALTER TABLE subclass DROP FOREIGN KEY FK_97F8F645D401D3D6');
        $this->addSql('DROP INDEX IDX_97F8F645D401D3D6 ON subclass');
        $this->addSql('ALTER TABLE subclass DROP playable_class_id');
        $this->addSql('ALTER TABLE subrace DROP FOREIGN KEY FK_3DAC9246E59D40D');
        $this->addSql('DROP INDEX IDX_3DAC9246E59D40D ON subrace');
        $this->addSql('ALTER TABLE subrace DROP race_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64986383B10');
        $this->addSql('DROP INDEX IDX_8D93D64986383B10 ON user');
        $this->addSql('ALTER TABLE user DROP avatar_id');
    }
}
