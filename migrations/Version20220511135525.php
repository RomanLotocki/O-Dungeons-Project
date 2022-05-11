<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511135525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ability (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, quick_description VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, incantation_time VARCHAR(255) NOT NULL, ability_range VARCHAR(255) NOT NULL, component VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE armor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, armor_type VARCHAR(255) NOT NULL, armor_class VARCHAR(255) DEFAULT NULL, strength INT DEFAULT 0 NOT NULL, discretion VARCHAR(50) DEFAULT NULL, weight DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE background (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, capacities VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, nb_language INT DEFAULT 0 NOT NULL, nb_golds INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE background_item (background_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_E689382FC93D69EA (background_id), INDEX IDX_E689382F126F525E (item_id), PRIMARY KEY(background_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, weight DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playable_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, life_dice VARCHAR(50) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, quick_description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playable_class_ability (playable_class_id INT NOT NULL, ability_id INT NOT NULL, INDEX IDX_35087487D401D3D6 (playable_class_id), INDEX IDX_350874878016D8B2 (ability_id), PRIMARY KEY(playable_class_id, ability_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playable_class_armor (playable_class_id INT NOT NULL, armor_id INT NOT NULL, INDEX IDX_F2344A87D401D3D6 (playable_class_id), INDEX IDX_F2344A87F5AA3663 (armor_id), PRIMARY KEY(playable_class_id, armor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playable_class_weapon (playable_class_id INT NOT NULL, weapon_id INT NOT NULL, INDEX IDX_AEA91CE6D401D3D6 (playable_class_id), INDEX IDX_AEA91CE695B82273 (weapon_id), PRIMARY KEY(playable_class_id, weapon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playable_class_item (id INT AUTO_INCREMENT NOT NULL, playable_class_id INT NOT NULL, item_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_BECE067ED401D3D6 (playable_class_id), INDEX IDX_BECE067E126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, full_description LONGTEXT NOT NULL, quick_description LONGTEXT NOT NULL, image_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subclass (id INT AUTO_INCREMENT NOT NULL, playable_class_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_97F8F645D401D3D6 (playable_class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subrace (id INT AUTO_INCREMENT NOT NULL, race_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image_url VARCHAR(255) NOT NULL, strength INT DEFAULT 0 NOT NULL, dexterity INT DEFAULT 0 NOT NULL, constitution INT DEFAULT 0 NOT NULL, wisdom INT DEFAULT 0 NOT NULL, intelligence INT DEFAULT 0 NOT NULL, charisma INT DEFAULT 0 NOT NULL, trait LONGTEXT DEFAULT NULL, INDEX IDX_3DAC9246E59D40D (race_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, avatar_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64986383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, damage_dice VARCHAR(50) NOT NULL, damage_type VARCHAR(50) NOT NULL, weight DOUBLE PRECISION DEFAULT \'0\' NOT NULL, property VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE background_item ADD CONSTRAINT FK_E689382FC93D69EA FOREIGN KEY (background_id) REFERENCES background (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE background_item ADD CONSTRAINT FK_E689382F126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_ability ADD CONSTRAINT FK_35087487D401D3D6 FOREIGN KEY (playable_class_id) REFERENCES playable_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_ability ADD CONSTRAINT FK_350874878016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_armor ADD CONSTRAINT FK_F2344A87D401D3D6 FOREIGN KEY (playable_class_id) REFERENCES playable_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_armor ADD CONSTRAINT FK_F2344A87F5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_weapon ADD CONSTRAINT FK_AEA91CE6D401D3D6 FOREIGN KEY (playable_class_id) REFERENCES playable_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_weapon ADD CONSTRAINT FK_AEA91CE695B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playable_class_item ADD CONSTRAINT FK_BECE067ED401D3D6 FOREIGN KEY (playable_class_id) REFERENCES playable_class (id)');
        $this->addSql('ALTER TABLE playable_class_item ADD CONSTRAINT FK_BECE067E126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE subclass ADD CONSTRAINT FK_97F8F645D401D3D6 FOREIGN KEY (playable_class_id) REFERENCES playable_class (id)');
        $this->addSql('ALTER TABLE subrace ADD CONSTRAINT FK_3DAC9246E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64986383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE playable_class_ability DROP FOREIGN KEY FK_350874878016D8B2');
        $this->addSql('ALTER TABLE playable_class_armor DROP FOREIGN KEY FK_F2344A87F5AA3663');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64986383B10');
        $this->addSql('ALTER TABLE background_item DROP FOREIGN KEY FK_E689382FC93D69EA');
        $this->addSql('ALTER TABLE background_item DROP FOREIGN KEY FK_E689382F126F525E');
        $this->addSql('ALTER TABLE playable_class_item DROP FOREIGN KEY FK_BECE067E126F525E');
        $this->addSql('ALTER TABLE playable_class_ability DROP FOREIGN KEY FK_35087487D401D3D6');
        $this->addSql('ALTER TABLE playable_class_armor DROP FOREIGN KEY FK_F2344A87D401D3D6');
        $this->addSql('ALTER TABLE playable_class_weapon DROP FOREIGN KEY FK_AEA91CE6D401D3D6');
        $this->addSql('ALTER TABLE playable_class_item DROP FOREIGN KEY FK_BECE067ED401D3D6');
        $this->addSql('ALTER TABLE subclass DROP FOREIGN KEY FK_97F8F645D401D3D6');
        $this->addSql('ALTER TABLE subrace DROP FOREIGN KEY FK_3DAC9246E59D40D');
        $this->addSql('ALTER TABLE playable_class_weapon DROP FOREIGN KEY FK_AEA91CE695B82273');
        $this->addSql('DROP TABLE ability');
        $this->addSql('DROP TABLE armor');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE background');
        $this->addSql('DROP TABLE background_item');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE playable_class');
        $this->addSql('DROP TABLE playable_class_ability');
        $this->addSql('DROP TABLE playable_class_armor');
        $this->addSql('DROP TABLE playable_class_weapon');
        $this->addSql('DROP TABLE playable_class_item');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE subclass');
        $this->addSql('DROP TABLE subrace');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE weapon');
    }
}
