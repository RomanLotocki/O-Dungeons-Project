<?php

namespace App\DataFixtures;

use App\Entity\Ability;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AbilityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $aide = new Ability;
        $aide->setName("Aide");
        $aide->setQuickDescription("Abjuration du 2ème niveau");
        $aide->setDescription("Abjuration du 2ème niveau
Votre sort raffermit la robustesse et la détermination de vos alliés. Choisissez jusqu'à trois créatures à portée. Le maximum de points de vie de chaque cible et ses points de vie augmentent de 5 pour toute la durée.
À plus haut niveau. Lorsque vous lancez ce sort par un emplacement du 3° niveau ou supérieur, les points de vie de la cible augmentent de 5 de plus par niveau d'emplacement au-delà du 2°.");
        $aide->setIncantationTime("1 action");
        $aide->setAbilityRange("9m");
        $aide->setComponent("V, S, M (une bandelette de tissu blanc)");
        $aide->setDuration("8 heures");
        
        $manager->persist($aide);
    
        $armeMagique = new Ability;
        $armeMagique->setName("Arme magique");
        $armeMagique->setQuickDescription("Transmutation du 2ème niveau");
        $armeMagique->setDescription("Transmutation du 2ème niveau
Vous touchez une arme non magique. Jusqu'à la fin du sort, l'arme devient magique, dotée d'un bonus de +1 aux jets d'attaque et aux jets de dégâts.
À plus haut niveau. Lorsque vous lancez ce sort par un emplacement du 4° ou 5° niveau, le bonus passe à +2. Avec un emplacement du 6° niveau ou supérieur, le bonus passe à +3.");
        $armeMagique->setIncantationTime("1 action bonus");
        $armeMagique->setAbilityRange("contact");
        $armeMagique->setComponent("V, S");
        $armeMagique->setDuration("concentration, jusqu'à 1 heure");
        
        $manager->persist($armeMagique);
    
        $armeSpirituelle = new Ability;
        $armeSpirituelle->setName("Arme spirituelle");
        $armeSpirituelle->setQuickDescription("Évocation du 2ème niveau");
        $armeSpirituelle->setDescription("Évocation du 2ème niveau
Vous créez une arme spectrale et flottante à portée, qui persiste pour toute la durée ou jusqu'à ce que vous relanciez ce sort.
À l'incantation, vous pouvez effectuer une attaque de sort au corps à corps contre une créature située dans un rayon de 1,50 m de l'arme. Si l'attaque touche, la cible subit des dégâts de force égaux à 1d8 + votre modificateur de caractéristique d'incantation.
Par une action bonus à votre tour, vous pouvez déplacer l'arme d'un maximum de 6 m et répéter l'attaque contre une cible située dans un rayon de 1,50 m de l'arme.
L'arme prend la forme de votre choix. Les clercs de divinités associées à une arme donnée (saint Cuthbert est par exemple connu pour sa masse d'armes et Thor pour son marteau) donnent l'aspect de cet objet à leur arme spirituelle.
À plus haut niveau. Lorsque vous lancez ce sort par un emplacement du 3° niveau ou supérieur, les dégâts augmentent de 1d8 par tranche de deux niveaux d'emplacement au-delà du 2°.");
        $armeSpirituelle->setIncantationTime("1 action bonus");
        $armeSpirituelle->setAbilityRange("18m");
        $armeSpirituelle->setComponent("V, S");
        $armeSpirituelle->setDuration("1 minute");
        
        $manager->persist($armeSpirituelle);
    
        $armureMage = new Ability;
        $armureMage->setName("Armure du mage");
        $armureMage->setQuickDescription("Abjuration du 1er niveau");
        $armureMage->setDescription("Abjuration du 1er niveau
Vous touchez une créature consentante qui ne porte pas d'armure et une force magique protectrice l'enveloppe jusqu'à la fin du sort. La CA de base de la cible devient 13 + son modificateurde Dextérité. Le sort prend fin si la cible enfile une armureou si vous le révoquez au prix d'une action.");
        $armureMage->setIncantationTime("1 action");
        $armureMage->setAbilityRange("contact");
        $armureMage->setComponent("V, S, M (un morceau de cuir traité)");
        $armureMage->setDuration("8 heures");
        
        $manager->persist($armureMage);
    
        $aspirationAcide = new Ability;
        $aspirationAcide->setName("Aspiration acide");
        $aspirationAcide->setQuickDescription("Sort mineur d'invocation");
        $aspirationAcide->setDescription("Sort mineur d'invocation
Vous projetez une bulle d'acide. Choisissez une ou deux créatures que vous voyez à portée. Si vous en choisissez deux, elles doivent être dans un rayon de 1,50 m l'une de l'autre. Chaque cible doit réussir un jet de sauvegarde de Dextérité sous peine de subir 1d6 dégâts d'acide.
Les dégâts du sort augmentent de 1d6 lorsque vous atteignez le niveau 5 (2d6), le niveau 11 (3d6) et le niveau 17 (4d6).");
        $aspirationAcide->setIncantationTime("1 action");
        $aspirationAcide->setAbilityRange("18m");
        $aspirationAcide->setComponent("V, S");
        $aspirationAcide->setDuration("instantanée");
        
        $manager->persist($aspirationAcide);
    
        $assistance = new Ability;
        $assistance->setName("Assistance");
        $assistance->setQuickDescription("Sort mineur de divination");
        $assistance->setDescription("Sort mineur de divination
Vous touchez une créature consentante. Une fois avant la fin du sort, la cible peut lancer un d4 et en ajouter le résultat au test de caractéristique de son choix. Elle peut lancer ce dé avant ou après avoir effectué le test de caractéristique. Le sort prend alors fin.");
        $assistance->setIncantationTime("1 action");
        $assistance->setAbilityRange("contact");
        $assistance->setComponent("V, S");
        $assistance->setDuration("concentration, jusqu'à 1 minute");
        
        $manager->persist($assistance);
    
        $augure = new Ability;
        $augure->setName("Augure");
        $augure->setQuickDescription("Divination du 2éme niveau (rituel)");
        $augure->setDescription("Divination du 2éme niveau (rituel)
Vous lancez des bâtonnets sertis de gemmes, des osselets de dragon ou des cartes ouvragées, ou bien vous recourez à un autre instrument divinatoire, et recevez un présage d'une entité urnaturelle vous renseignant sur l'issue d'une opération que vous comptez mener dans les 30 minutes. Le MD choisit l'un des présages suivants :
Fortune, pour une issue favorable
Misère, pour une issue défavorable
Fortune et misère, pour une issue à la fois favorable et défavorable
Rien, pour une issue qui n'est ni vraiment favorable ni défavorable
Le sort ne tient pas compte des conjonctures qui pourraient peser dans la balance, comme l'incantation de nouveaux sorts, la perte d'un compagnon ou l'arrivée de renfort.
Si vous lancez le sort plusieurs fois avant de terminer votre prochain repos long, vous courez dès la deuxième incantation 25 % de risques cumulatifs qu'il vous livre une information aléatoire. Le MD effectue ce jet en secret.");
        $augure->setIncantationTime("1 minute");
        $augure->setAbilityRange("personnelle");
        $augure->setComponent("V, S, M (25 po d'os ou de bâtonnets gravés spécialement, ou d'objets symboliques similaires)");
        $augure->setDuration("instantanée");
        
        $manager->persist($augure);
    
        $auraDuCroise = new Ability;
        $auraDuCroise->setName("Aura du croisé");
        $auraDuCroise->setQuickDescription("Évocation du 3ème niveau");
        $auraDuCroise->setDescription("Évocation du 3ème niveau
La puissance sainte émane de vous dans un rayon de 9 m, réveillant l'audace des créatures amicales. Jusqu'à la fin du sort, l'aura se déplace avec vous, en vous prenant pour centre. Tant qu'elle est comprise dans l'aura, toute créature non hostile inflige 1d4 dégâts radiants supplémentaires lorsqu'elle touche avec une attaque d'arme. Vous profitez aussi de cet effet.");
        $auraDuCroise->setIncantationTime("1 action");
        $auraDuCroise->setAbilityRange("personnelle");
        $auraDuCroise->setComponent("V");
        $auraDuCroise->setDuration("concentration, jusqu'à 1 minute");
        
        $manager->persist($auraDuCroise);
    
        $benediction = new Ability;
        $benediction->setName("Bénédiction");
        $benediction->setQuickDescription("Enchantemant du 1er niveau");
        $benediction->setDescription("Enchantemant du 1er niveau
Vous bénissez jusqu'à trois créatures de votre choix à portée. Chaque fois qu'une cible effectue un jet d'attaque ou un jet de sauvegarde avant la fin du sort, elle peut lancer un d4 et en ajouter le résultat au jet d'attaque ou jet de sauvegarde.
À plus haut niveau. Lorsque vous lancez ce sort par un emplacement du 2° niveau ou supérieur, vous pouvez cibler une créature de plus par niveau d'emplacement au-delà du 1%.");
        $benediction->setIncantationTime("1 action");
        $benediction->setAbilityRange("9m");
        $benediction->setComponent("V, S, M (un peu d'eau bénite aspergée)");
        $benediction->setDuration("concentration, jusqu'à 1 minute");
        
        $manager->persist($benediction);
    
        $blessure = new Ability;
        $blessure->setName("Blessure");
        $blessure->setQuickDescription("Nécromancie du 1er niveau");
        $blessure->setDescription("Nécromancie du 1er niveau
Effectuez une attaque de sort au corps à corps contre une créature à portée d'allonge. Si l'attaque touche, la cible subit 3410 dégâts nécrotiques.
À plus haut niveau. Lorsque vous lancez ce sort par un emplacement du 2° niveau ou supérieur, les dégâts augmentent de 1d10 par niveau d'emplacement au-delà du 1%.");
        $blessure->setIncantationTime("1 action");
        $blessure->setAbilityRange("contact");
        $blessure->setComponent("V, S");
        $blessure->setDuration("instantanée");
        
        $manager->persist($blessure);
    
        $bouclier = new Ability;
        $bouclier->setName("Bouclier");
        $bouclier->setQuickDescription("Abjuration du 1er niveau");
        $bouclier->setDescription("Abjuration du 1er niveau
Une barrière invisible de force magique se forme pour vous protéger. Jusqu'au début de votre tour suivant, vous recevez un bonus de +5 à la CA, y compris contre l'attaque qui a déclenché le sort, et vous ne subissez aucun dégât de projectile magique.");
        $bouclier->setIncantationTime("1 réaction, que vous jouez lorsque vous êtes touché par une attaque ou ciblé par le sort projectile magique.");
        $bouclier->setAbilityRange("personnelle");
        $bouclier->setComponent("V, S");
        $bouclier->setDuration("1 round");
        
        $manager->persist($bouclier);
    
        $bouclierDeLaFoi = new Ability;
        $bouclierDeLaFoi->setName("Bouclier De La Foi");
        $bouclierDeLaFoi->setQuickDescription("Abjuration du 1er niveau");
        $bouclierDeLaFoi->setDescription("Abjuration du 1er niveau
Un champ scintillant apparaît autour d'une créature de votre choix à portée et lui confère un bonus de +2 à la CA pour toute la durée.");
        $bouclierDeLaFoi->setIncantationTime("1 action bonus");
        $bouclierDeLaFoi->setAbilityRange("18m");
        $bouclierDeLaFoi->setComponent("V, S, M (un petit parchemin sur lequel apparaît un extrait d'écritures saintes)");
        $bouclierDeLaFoi->setDuration("concentration, jusqu'à 10 minutes");
        
        $manager->persist($bouclierDeLaFoi);
    
        $bouffeeDePoison = new Ability;
        $bouffeeDePoison->setName("Bouffée de poison");
        $bouffeeDePoison->setQuickDescription("Sort mineur d'invocation");
        $bouffeeDePoison->setDescription("Sort mineur d'invocation
Vous tendez la main vers une créature que vous voyez à portée et votre paume projette un petit nuage de gaz toxique. La créature doit réussir un jet de sauvegarde de Constitution sous peine de subir 1412 dégâts de poison.
Les dégâts du sort augmentent de 1412 lorsque vous atteignez le niveau 5 (2d12), le niveau 11 (3412) et le niveau 17 (4d12).");
        $bouffeeDePoison->setIncantationTime("1 action");
        $bouffeeDePoison->setAbilityRange("3m");
        $bouffeeDePoison->setComponent("V, S");
        $bouffeeDePoison->setDuration("instantanée");
        
        $manager->persist($bouffeeDePoison);
    
        $bouleDeFeu = new Ability;
        $bouleDeFeu->setName("Boule de feu");
        $bouleDeFeu->setQuickDescription("Évocation du 3ème niveau");
        $bouleDeFeu->setDescription("Évocation du 3ème niveau
Une zébrure éblouissante part de votre doigt tendu jusqu'au point que vous choisissez à portée, produisant une déflagration au grondement sourd. Toute créature prise dans une sphère de 6 m de rayon centrée sur ce point doit effectuer un jet de sauvegarde de Dextérité. Elle subit 8d6 dégâts de feu en cas d'échec, la moitié en cas de réussite.
Les flammes contournent les coins. Elles embrasent les objets inflammables de la zone qui ne sont portés par personne.
À plus haut niveau. Lorsque vous lancez ce sort par un emplacement du 4° niveau ou supérieur, les dégâts augmentent de 1d6 par niveau d'emplacement au-delà du 3°.");
        $bouleDeFeu->setIncantationTime("1 action");
        $bouleDeFeu->setAbilityRange("45m");
        $bouleDeFeu->setComponent("V, S, M (une boulette de guano de chauve-souris et de soufre)");
        $bouleDeFeu->setDuration("instantanée");
        
        $manager->persist($bouleDeFeu);

        $charmePersonne = new Ability;
        $charmePersonne->setName("Charme-personne");
        $charmePersonne->setQuickDescription("Enchantement du 1er niveau");
        $charmePersonne->setDescription("Enchantement du 1er niveau
Vous tentez de charmer un humanoïde que vous voyez à portée. Il doit effectuer un jet de sauvegarde de Sagesse, avec avantage si vous ou l'un de vos compagnons êtes en plein combat contre lui. Si elle rate le jet de sauvegarde, la créature est charmée par vous jusqu'à la fin du sort ou jusqu'à ce que vous ou l'un de vos compagnons lui nuisiez directement. La créature charmée vous considère comme une relation de confiance. Lorsque le sort prend fin, la créature sait que vous l'avez charmée.
À plus haut niveau. Lorsque vous lancez ce sort par un emplacement du 2° niveau ou supérieur, vous pouvez cibler une créature de plus par niveau d'emplacement au-delà du 1°. Les créatures ainsi ciblées doivent toutes se trouver dans un rayon de 9 m les unes des autres.");
        $charmePersonne->setIncantationTime("1 action");
        $charmePersonne->setAbilityRange("9m");
        $charmePersonne->setComponent("V, S");
        $charmePersonne->setDuration("1 heure");
        
        $manager->persist($charmePersonne);

        $communicationDistance = new Ability;
        $communicationDistance->setName("Communication à distance");
        $communicationDistance->setQuickDescription("Évocation du 3ème niveau");
        $communicationDistance->setDescription("Évocation du 3ème niveau
Vous envoyez un bref message n'excédant pas vingt-cinq mots à une créature qui vous est familière. L'esprit de la créature perçoit le message, celle-ci vous identifie comme expéditeur si elle vous connaît et peut vous répondre aussitôt dans le même mode. Ce sort permet aux créatures dont la valeur d'Intelligence est d'au moins 1 de comprendre le sens de votre message.
La distance qui vous sépare du destinataire n'a pas d'importance et vous pouvez même atteindre d'autres plans d'existence, mais si la cible se trouve sur un plan différent, il y a 5 % de chance pour que le message n'aboutisse pas.");
        $communicationDistance->setIncantationTime("1 action");
        $communicationDistance->setAbilityRange("illimitée");
        $communicationDistance->setComponent("V, S, M (un bout de fil de cuivre)");
        $communicationDistance->setDuration("1 round");
        
        $manager->persist($communicationDistance);

        $comprehensionLangues = new Ability;
        $comprehensionLangues->setName("Compréhension des langues");
        $comprehensionLangues->setQuickDescription("Divination du 1er niveau (rituel)");
        $comprehensionLangues->setDescription("Divination du 1er niveau (rituel)
Pour toute la durée, vous comprenez le sens littéral de toute langue parlée que vous entendez. Vous comprenez également tout écrit que vous voyez, à condition de toucher la surface sur laquelle il est rédigé. Il vous faut environ 1 minute pour lire une page.
Ce sort ne décrypte pas les messages secrets ni les glyphes, tels que les symboles arcaniques, s'ils ne correspondent pas à une langue écrite.");
        $comprehensionLangues->setIncantationTime("1 action");
        $comprehensionLangues->setAbilityRange("personnelle");
        $comprehensionLangues->setComponent("V, S, M (une pincée de suie et de sel)");
        $comprehensionLangues->setDuration("1 heure");
        
        $manager->persist($comprehensionLangues);

        $deguisement = new Ability;
        $deguisement->setName("Déguisement");
        $deguisement->setQuickDescription("Illusion du 1er niveau");
        $deguisement->setDescription("Illusion du 1er niveau
Vous vous donnez un aspect différent jusqu'à la fin du sort ou jusqu'à ce que vous le révoquiez en y consacrant votre action. Vous pouvez ainsi altérer l'apparence de vos vêtements, de votre armure, de vos armes et autres biens portés. Vous pouvez paraître jusqu'à 30 em plus grand ou plus petit, sembler plus maigre ou plus dodu. Vous ne pouvez pas changer d'anatomie, si bien que la forme choisie doit conserver votre répartition de membres. Pour le reste, les détails de l'illusion vous appartiennent.
Les changements apportés par le sort ne résistent pas à un examen physique. Exemple : si le sort ajoute un chapeau à votre accoutrement, ce couvre-chef n'est pas tangible, si bien que quiconque cherche à le toucher ne sentira sous ses doigts que de l'air, votre crâne ou vos cheveux. Si le sort vous fait paraître plus mince que la réalité, quelqu'un qui tend la main pour vous toucher vous heurtera plus tôt que prévu.
Pour comprendre que vous êtes déguisé, une créature peut consacrer son action à vous examiner et doit réussir un test d'Intelligence (Investigation) assorti de votre DD de sauvegarde des sorts.");
        $deguisement->setIncantationTime("1 action");
        $deguisement->setAbilityRange("personnelle");
        $deguisement->setComponent("V, S");
        $deguisement->setDuration("1 heure");
        
        $manager->persist($deguisement);

        $delivranceMaledictions = new Ability;
        $delivranceMaledictions->setName("Délivrance des malédictions");
        $delivranceMaledictions->setQuickDescription("Abjuration du 3ème niveau");
        $delivranceMaledictions->setDescription("Abjuration du 3ème niveau
À votre contact, toutes les malédictions qui affectent une créature ou un objet prennent fin. Si la cible est un objet maudit, la malédiction reste en place, mais le sort rompt l'harmonisation du propriétaire avec l'objet, si bien qu'il peut s'en défaire ou s'en débarrasser.");
        $delivranceMaledictions->setIncantationTime("1 action");
        $delivranceMaledictions->setAbilityRange("contact");
        $delivranceMaledictions->setComponent("V, S");
        $delivranceMaledictions->setDuration("instantanée");
        
        $manager->persist($delivranceMaledictions);

        $detectionMagie = new Ability;
        $detectionMagie->setName("Détection de la magie");
        $detectionMagie->setQuickDescription("Divination du 1er niveau (rituel)");
        $detectionMagie->setDescription("Divination du 1er niveau (rituel)
Pour toute la durée, vous percevez la présence de la magie dans un rayon de 9 m de vous. Si vous percevez de la magie par ce biais, vous pouvez consacrer votre action à discerner une faible aura entourant les objets et créatures visibles et porteurs de magie de la zone. Vous en apprenez également les écoles de magie associées, le cas échéant.
Le sort perce la plupart des obstacles, mais 30 cm de pierre, 90 cm de bois ou de terre, ou 2,5 em de métal (ou une simple feuille dans le cas du plomb) suffisent à le bloquer.");
        $detectionMagie->setIncantationTime("1 action");
        $detectionMagie->setAbilityRange("personnelle");
        $detectionMagie->setComponent("V, S");
        $detectionMagie->setDuration("concentration, jusqu'à 10 minutes");
        
        $manager->persist($detectionMagie);

        $dissipationMagie = new Ability;
        $dissipationMagie->setName("Dissipation de la magie");
        $dissipationMagie->setQuickDescription("Abjuration du 3ème niveau");
        $dissipationMagie->setDescription("Abjuration du 3ème niveau
Choisissez une créature, un objet ou un effet magique à portée. Tout sort du 3° niveau ou inférieur qui affecte la cible prend fin. Pour chaque sort du 4° niveau ou supérieur affectant la cible, effectuez un test de caractéristique d'incantation. Le DD est égal à 10 + le niveau du sort. En cas de réussite, le sort prend fin.
À plus haut niveau. Lorsque vous lancez ce sort par un emplacement du 4° niveau ou supérieur, vous mettez automatiquement un terme aux sorts qui affectent la cible et sont d'un niveau qui ne dépasse pas celui de votre emplacement.");
        $dissipationMagie->setIncantationTime("1 action");
        $dissipationMagie->setAbilityRange("36m");
        $dissipationMagie->setComponent("V, S");
        $dissipationMagie->setDuration("instantanée");
        
        $manager->persist($dissipationMagie);

        $eclair = new Ability;
        $eclair->setName("Éclair");
        $eclair->setQuickDescription("Évocation du 3ème niveau");
        $eclair->setDescription("Évocation du 3ème niveau
Un éclair foudroyant jaillit de vous sous la forme d'une ligne de 30 m de long et 1,50 m de large, dans la direction de votre choix. Chaque créature prise dans la ligne doit effectuer un jet de sauvegarde de Dextérité. Elle subit 8d6 dégâts de foudre en cas d'échec, la moitié en cas de réussite.
La foudre embrase les objets inflammables de la zone qui ne sont portés par personne.
À plus haut niveau. Lorsque vous lancez ce sort par un emplacement du 4° niveau ou supérieur, les dégâts augmentent de 1d6 par niveau d'emplacement au-delà du 3°.");
        $eclair->setIncantationTime("1 action");
        $eclair->setAbilityRange("personnelle (ligne de 30m)");
        $eclair->setComponent("V, S, M (un peu de fourrure et une tige d'ambre, de cristal ou de verre)");
        $eclair->setDuration("instantanée");
        
        $manager->persist($eclair);

        $espritGardiens = new Ability;
        $espritGardiens->setName("Esprits gardien");
        $espritGardiens->setQuickDescription("Invocation du 3ème niveau");
        $espritGardiens->setDescription("Invocation du 3ème niveau
Vous invoquez la protection d'esprits qui viennent voleter dans un rayon de 4,50 m de vous pour toute la durée. Si vous êtes bon ou neutre, ces formes spectrales paraissent angéliques ou féeriques (à votre convenance). Si vous êtes mauvais, elles paraissent démoniaques ou diaboliques.
À l'incantation, vous désignez autant de créatures que vous le souhaitez parmi celles que vous voyez ; elles ne seront pas sujettes aux esprits. Toutes les autres créatures voient leur vitesse réduite de moitié dans la zone ; de plus, lorsqu'une telle créature entre dans la zone d'effet pour la première fois d'un tour ou y commence son propre tour, elle doit effectuer un jet de sauvegarde de Sagesse. En cas d'échec, elle subit 3d8 dégâts radiants (si vous êtes bon ou neutre) ou 3d8 dégâts nécrotiques (si vous êtes mauvais). En cas de réussite, la créature subit la moitié de ces dégâts.
À plus haut niveau. Lorsque vous lancez ce sort par un emplacement du 4° niveau ou supérieur, les dégâts augmentent de 1d8 par niveau d'emplacement au-delà du 3°.");
        $espritGardiens->setIncantationTime("1 action");
        $espritGardiens->setAbilityRange("personnelle (ligne de 4,50m)");
        $espritGardiens->setComponent("V, S, M (un symbole sacré)");
        $espritGardiens->setDuration("concentration, jusqu'à 10 minutes");
        
        $manager->persist($espritGardiens);

        $faveurDivine = new Ability;
        $faveurDivine->setName("Esprits gardien");
        $faveurDivine->setQuickDescription("Évocation du 1er niveau");
        $faveurDivine->setDescription("Évocation du 1er niveau
Vos prières vous nimbent de radiance divine. Jusqu'à la fin du sort, vos attaques d'arme infligent 1d4 radiants supplémentaires quand elles touchent.");
        $faveurDivine->setIncantationTime("1 action bonus");
        $faveurDivine->setAbilityRange("personnelle");
        $faveurDivine->setComponent("V, S");
        $faveurDivine->setDuration("concentration, jusqu'à 1 minute");
        
        $manager->persist($faveurDivine);
        
        $manager->flush();
    }
}
