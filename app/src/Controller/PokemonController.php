<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Category;
use App\Entity\Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Helper\PokemonHelper;
use UnitConverter\UnitConverter;
use Knp\Component\Pager\PaginatorInterface;

class PokemonController extends AbstractController
{

    /**
     * @var PokemonHelper
     */
    private $pokemonHelper;

    public function __construct(PokemonHelper $pokemonHelper)
    {
        $this->pokemonHelper = $pokemonHelper;
    }

    /**
     * @Route("/{_locale}/pokemon", name="pokemon")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        // Instantiate entity repository to load all pokemons.
        $pokemonRepository = $this->getDoctrine()->getRepository(Pokemon::class);
        $entities = $pokemonRepository->findAll();

        // Add KNP pagination.
        $pokemons = $paginator->paginate(
            $entities, // Entities list to paginate.
            $request->query->getInt('page', 1), // Page to display.
            24 // Number of entities per page.
        );
        $pokemons->setCustomParameters(['align' => 'center']);

        return $this->render('pokemon/index.html.twig', [
            'controller_name' => 'PokemonController',
            'pokemons' => $pokemons,
        ]);
    }

    /**
     * @Route("/{_locale}/pokemon/{id}", name="pokemon_show", requirements={"id"="\d+"})
     * @param Request $request
     * @param Pokemon $pokemon
     * @return Response
     */
    public function show(Request $request, Pokemon $pokemon)
    {
        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
            'convertHeight' => $this->pokemonHelper->getHeightByLocale($request->getLocale(), $pokemon),
            'convertWeight' => $this->pokemonHelper->getweightByLocale($request->getLocale(), $pokemon),
        ]);
    }

    /**
     * @Route("/{_locale}/pokemon/{slug}", name="pokemon_show_by_slug")
     * @param Request $request
     * @param string $slug
     * @return Response
     */
    public function showBySlug(Request $request, string $slug)
    {
        $pokemon = $this->getDoctrine()
            ->getRepository('Gedmo\\Translatable\\Entity\\Translation')
            ->findObjectByTranslatedField('slug', $slug, 'App\Entity\Pokemon');

        if (!$pokemon) {
            throw $pokemon->createNotFoundException(
                'No pokemon found for slug ' . $slug
            );
        }

        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
            'convertHeight' => $this->pokemonHelper->getHeightByLocale($request->getLocale(), $pokemon),
            'convertWeight' => $this->pokemonHelper->getweightByLocale($request->getLocale(), $pokemon),
            'translations' => $this->pokemonHelper->getTranslations($pokemon),
        ]);
    }

    /**
     * @Route("/{_locale}/create/pokemon", name="create_pokemon")
     * @return Response
     */
    public function createPokemon()
    {
        // Instantiate entity repositories.
        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $typeRepository = $this->getDoctrine()->getRepository(Type::class);

        // Init new Pokemon object.
        $pokemon = new Pokemon();
        $pokemon->setNumber(18);
        $pokemon->setName('Pidgeot');
        $pokemon->setDescription('This Pokémon has a dazzling plumage of beautifully glossy feathers. Many Trainers are captivated by the striking beauty of the feathers on its head, compelling them to choose Pidgeot as their Pokémon.');
        $pokemon->setHeight(1500); // millimeters.
        $pokemon->setWeight(39500); // grams.

        // Relates this pokemon to the category.
        $category = $categoryRepository->findOneBy(['name' => 'Bird']);
        $pokemon->setCategory($category);

        // Relates this pokemon to the category.
        $types = [
            $typeRepository->findOneBy(['name' => 'Normal']),
            $typeRepository->findOneBy(['name' => 'Flying']),
        ];
        foreach ($types as $type) {
            $pokemon->addType($type);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pokemon);
        $entityManager->flush();

        return new Response('<html><body><p>Saved new pokemon <strong>' . $pokemon->getName() . ' (' . $pokemon->getNumber() . ')</strong></p></body></html>');
    }

    /**
     * Another test route, to translate all pokemons.
     *
     * @Route("/{_locale}/translate/pokemons", name="translate_pokemons")
     * @return Response
     */
    public function translatePokemons()
    {
        // Load the pokemon repository & manager.
        $pokemonRepository = $this->getDoctrine()->getRepository(Pokemon::class);
        $entityManager = $this->getDoctrine()->getManager();
        $pokemons = $pokemonRepository->findAll();

        $names = [
            'fr' => [
                1 => [
                    'name' => 'Bulbizarre',
                    'desc' => 'Bulbizarre passe son temps à faire la sieste sous le soleil. Il y a une graine sur son dos. Il absorbe les rayons du soleil pour faire doucement pousser la graine.',
                ],
                2 => [
                    'name' => 'Herbizarre',
                    'desc' => 'Un bourgeon a poussé sur le dos de ce Pokémon. Pour en supporter le poids, Herbizarre a dû se muscler les pattes. Lorsqu\'il commence à se prélasser au soleil, ça signifie que son bourgeon va éclore, donnant naissance à une fleur.',
                ],
                3 => [
                    'name' => 'Florizarre',
                    'desc' => 'Une belle fleur se trouve sur le dos de Florizarre. Elle prend une couleur vive lorsqu\'elle est bien nourrie et bien ensoleillée. Le parfum de cette fleur peut apaiser les gens.',
                ],
                4 => [
                    'name' => 'Salamèche',
                    'desc' => 'La flamme qui brûle au bout de sa queue indique l\'humeur de ce Pokémon. Elle vacille lorsque Salamèche est content. En revanche, lorsqu\'il s\'énerve, la flamme prend de l\'importance et brûle plus ardemment.',
                ],
                5 => [
                    'name' => 'Reptincel',
                    'desc' => 'Reptincel lacère ses ennemis sans pitié grâce à ses griffes acérées. S\'il rencontre un ennemi puissant, il devient agressif et la flamme au bout de sa queue s\'embrase et prend une couleur bleu clair.',
                ],
                6 => [
                    'name' => 'Dracaufeu',
                    'desc' => 'Dracaufeu parcourt les cieux pour trouver des adversaires à sa mesure. Il crache de puissantes flammes capables de faire fondre n\'importe quoi. Mais il ne dirige jamais son souffle destructeur vers un ennemi plus faible.',
                ],
                7 => [
                    'name' => 'Carapuce',
                    'desc' => 'La carapace de Carapuce ne sert pas qu\'à le protéger. La forme ronde de sa carapace et ses rainures lui permettent d\'améliorer son hydrodynamisme. Ce Pokémon nage extrêmement vite.',
                ],
                8 => [
                    'name' => 'Carabaffe',
                    'desc' => 'Carabaffe a une large queue recouverte d\'une épaisse fourrure. Elle devient de plus en plus foncée avec l\'âge. Les éraflures sur la carapace de ce Pokémon témoignent de son expérience au combat.',
                ],
                9 => [
                    'name' => 'Tortank',
                    'desc' => 'Tortank dispose de canons à eau émergeant de sa carapace. Ils sont très précis et peuvent envoyer des balles d\'eau capables de faire mouche sur une cible située à plus de 50 m.',
                ],
                10 => [
                    'name' => 'Chenipan',
                    'desc' => 'C\'est peut-être parce qu\'il a envie de grandir le plus vite possible qu\'il est si vorace. Il engloutit une centaine de feuilles par jour.',
                ],
                11 => [
                    'name' => 'Chrysacier',
                    'desc' => 'Sa carapace contient un liquide gluant. Sa structure cellulaire est en cours de modification en vue de son évolution prochaine.',
                ],
                12 => [
                    'name' => 'Papilusion',
                    'desc' => 'Lorsqu\'il surprend un Pokémon oiseau attaquant un Chenipan, il répand les écailles très toxiques qui recouvrent ses ailes sur l\'assaillant.',
                ],
                13 => [
                    'name' => 'Aspicot',
                    'desc' => 'L\'odorat d\'Aspicot est extrêmement développé. Il lui suffit de renifler ses feuilles préférées avec son gros appendice nasal pour les reconnaître entre mille.',
                ],
                14 => [
                    'name' => 'Coconfort',
                    'desc' => 'Coconfort est la plupart du temps immobile et reste accroché à un arbre. Cependant, intérieurement, il est très actif, car il se prépare pour sa prochaine évolution. En touchant sa carapace, on peut sentir sa chaleur.',
                ],
                15 => [
                    'name' => 'Dardargnan',
                    'desc' => 'Dardargnan est extrêmement possessif. Il vaut mieux ne pas toucher son nid si on veut éviter d\'avoir des ennuis. Lorsqu\'ils sont en colère, ces Pokémon attaquent en masse.',
                ],
                16 => [
                    'name' => 'Roucool',
                    'desc' => 'Roucool a un excellent sens de l\'orientation. Il est capable de retrouver son nid sans jamais se tromper, même s\'il est très loin de chez lui et dans un environnement qu\'il ne connaît pas.',
                ],
                17 => [
                    'name' => 'Roucoups',
                    'desc' => 'Roucoups utilise une vaste surface pour son territoire. Ce Pokémon surveille régulièrement son espace aérien. Si quelqu\'un pénètre sur son territoire, il corrige l\'ennemi sans pitié d\'un coup de ses terribles serres.',
                ],
                18 => [
                    'name' => 'Roucarnage',
                    'desc' => 'Ce Pokémon est doté d\'un plumage magnifique et luisant. Bien des Dresseurs sont captivés par la beauté fatale de sa huppe et décident de choisir Roucarnage comme leur Pokémon favori.',
                ],
                19 => [
                    'name' => 'Rattata',
                    'desc' => 'Ses incisives poussent tout au long de sa vie. Si elles dépassent une certaine longueur, il ne peut plus s\'alimenter et meurt de faim.',
                ],
                20 => [
                    'name' => 'Rattatac',
                    'desc' => 'Les petites palmes de ses pattes postérieures lui permettraient de se rendre d\'île en île à la nage afin d\'échapper à ses prédateurs.',
                ],
                21 => [
                    'name' => 'Piafabec',
                    'desc' => 'Un Pokémon téméraire qui n\'hésite pas à affronter des Pokémon plus gros que lui pour protéger son territoire.',
                ],
                22 => [
                    'name' => 'Rapasdepic',
                    'desc' => 'Si vous vous promenez sur le territoire d\'un Rapasdepic en transportant de la nourriture, vous risquez de vite la voir s\'envoler !',
                ],
                23 => [
                    'name' => 'Abo',
                    'desc' => 'Il peut se déboîter la mâchoire pour avaler tout rond des proies plus grosses que lui. Il se replie ensuite sur lui-même pour digérer.',
                ],
                24 => [
                    'name' => 'Arbok',
                    'desc' => 'Une étude récente aurait recensé plus de vingt motifs différents pouvant orner le devant du capuchon des Arbok.',
                ],
                25 => [
                    'name' => 'Pikachu',
                    'desc' => 'Son corps peut accumuler de l\'électricité. Les forêts abritant des groupes de Pikachu sont d\'ailleurs souvent frappées par la foudre.',
                ],
                26 => [
                    'name' => 'Raichu',
                    'desc' => 'Plus il est chargé en électricité, plus il se montre agressif. D\'aucuns pensent que ce courant électrique le stresse.',
                ],
                27 => [
                    'name' => 'Sabelette',
                    'desc' => 'Il vit dans les régions où il pleut rarement. Quand il est en danger, il se roule en boule pour protéger son ventre, qui est son point faible.',
                ],
                28 => [
                    'name' => 'Sablaireau',
                    'desc' => 'Ses épines et ses griffes se cassent souvent. Ces pointes brisées peuvent servir d\'outils pour creuser le sol.',
                ],
                29 => [
                    'name' => 'Nidoran♀',
                    'desc' => 'Nidoran♀ est couvert de pointes qui sécrètent un poison puissant. On pense que ce petit Pokémon a développé ces pointes pour se défendre. Lorsqu\'il est en colère, une horrible toxine sort de sa corne.',
                ],
                30 => [
                    'name' => 'Nidorina',
                    'desc' => 'Lorsqu\'un Nidorina est avec ses amis ou sa famille, il replie ses pointes pour ne pas blesser ses proches. Ce Pokémon devient vite nerveux lorsqu\'il est séparé de son groupe.',
                ],
                31 => [
                    'name' => 'Nidoqueen',
                    'desc' => 'Le corps de Nidoqueen est protégé par des écailles extrêmement dures. Il aime envoyer ses ennemis voler en leur fonçant dessus. Ce Pokémon utilise toute sa puissance lorsqu\'il protège ses petits.',
                ],
                32 => [
                    'name' => 'Nidoran♂',
                    'desc' => 'Nidoran♂ a développé des muscles pour bouger ses oreilles. Ainsi, il peut les orienter à sa guise. Ce Pokémon peut entendre le plus discret des bruits.',
                ],
                33 => [
                    'name' => 'Nidorino',
                    'desc' => 'Nidorino dispose d\'une corne plus dure que du diamant. S\'il sent une présence hostile, toutes les pointes de son dos se hérissent d\'un coup, puis il défie son ennemi.',
                ],
                34 => [
                    'name' => 'Nidoking',
                    'desc' => 'L\'épaisse queue de Nidoking est d\'une puissance incroyable. En un seul coup, il peut renverser une tour métallique. Lorsque ce Pokémon se déchaîne, plus rien ne peut l\'arrêter.',
                ],
                35 => [
                    'name' => 'Mélofée',
                    'desc' => 'Il est très rare en dépit de sa popularité. Ne le laissez pas sans surveillance, car il risquerait de se faire dérober par un voleur de Pokémon !',
                ],
                36 => [
                    'name' => 'Mélodelfe',
                    'desc' => 'Il préfère vivre au fond des montagnes, loin des humains et des Pokémon, car il peut entendre une aiguille tomber à un kilomètre de distance.',
                ],
                37 => [
                    'name' => 'Goupix',
                    'desc' => 'Ses queues magnifiques en font un Pokémon très populaire. Il faut toutefois les lui brosser fréquemment pour éviter les nœuds.',
                ],
                38 => [
                    'name' => 'Feunard',
                    'desc' => 'Un Pokémon très rancunier. S\'il est offensé, son ressentiment peut poursuivre le coupable et sa descendance pendant un millénaire.',
                ],
                39 => [
                    'name' => 'Rondoudou',
                    'desc' => 'Les rayons literie des magasins proposent généralement des CD de berceuses chantées par des Rondoudou.',
                ],
                40 => [
                    'name' => 'Grodoudou',
                    'desc' => 'Il est célébré pour son corps élastique et son pelage soyeux. Quel bonheur que de faire une sieste en serrant un Grodoudou contre soi !',
                ],
                41 => [
                    'name' => ' Dépourvu d\'yeux, il se repère dans l\'espace grâce aux ultrasons qu\'il émet avec sa bouche.',
                    'desc' => 'Bulbizarre',
                ],
                42 => [
                    'name' => 'Nosferalto',
                    'desc' => 'On rencontre parfois des Nosferalto édentés que la faim a poussés à attaquer un Pokémon de type Acier.',
                ],
            ]
        ];

        foreach ($names as $language => $values) {
            foreach ($pokemons as $pokemon) {
                // Define new value for title
                $pokemon->setName($values[$pokemon->getNumber()]['name']);
                $pokemon->setDescription($values[$pokemon->getNumber()]['desc']);

                // Define locale.
                $pokemon->setTranslatableLocale($language); // change locale

                // Persist entity.
                $entityManager->persist($pokemon);
            }
        }

        // Store everything in database.
        $entityManager->flush();

        return new Response('<html><body><p>Pokemons translated!</p></body></html>');
    }

    /**
     * Another test route to create pokemons based on PokemonHelper data.
     *
     * @Route("/create/pokemons", name="create_pokemons")
     * @return Response
     */
    public function createPokemons()
    {
        $pokemons = $this->pokemonHelper->createPokemons($this->getDoctrine());
        return new Response('<html><body><p>' . count($pokemons) . ' pokemons created!</p></body></html>');
    }

    /**
     * Another test route to create pokemons from PokeAPI.
     *
     * @Route("/papi/create/pokemons/{limit}/{offset}", name="papi_pokemons")
     * @param int $limit
     * @param int $offset
     * @return Response
     */
    public function createPokemonsFromAPI($limit = 20, $offset = 0)
    {
        // Set a limit (to improve) to create only 1st gen Pokemons.
        $max = 151;
        if ($limit + $offset > $max) {
            $limit = $max % $offset;
        }

        $types = $this->pokemonHelper->createPokemonsFromPAPI($this->getDoctrine(), $limit, $offset);
        return new Response('<html><body>
            <p>' . count($types) . ' pokemons created, from PokeAPI V2!</p>
            <p><a href="' . $this->generateUrl('papi_pokemons', ['limit' => $limit, 'offset' => $offset+20]) . '">Next batch</a></p>
        </body></html>');
    }
}
