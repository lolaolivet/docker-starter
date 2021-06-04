<?php

namespace App\Factory;

use App\Entity\DifficultyLevel;
use App\Repository\DifficultyLevelRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;


/**
 * @method static DifficultyLevel|Proxy createOne(array $attributes = [])
 * @method static DifficultyLevel[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static DifficultyLevel|Proxy find($criteria)
 * @method static DifficultyLevel|Proxy findOrCreate(array $attributes)
 * @method static DifficultyLevel|Proxy first(string $sortedField = 'id')
 * @method static DifficultyLevel|Proxy last(string $sortedField = 'id')
 * @method static DifficultyLevel|Proxy random(array $attributes = [])
 * @method static DifficultyLevel|Proxy randomOrCreate(array $attributes = [])
 * @method static DifficultyLevel[]|Proxy[] all()
 * @method static DifficultyLevel[]|Proxy[] findBy(array $attributes)
 * @method static DifficultyLevel[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static DifficultyLevel[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static DifficultyLevelRepository|RepositoryProxy repository()
 * @method DifficultyLevel|Proxy create($attributes = [])
 */
final class DifficultyLevelFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
            'difficulty' => self::faker()->unique()->randomElement(['Facile', 'Peu difficile', 'Assez difficile', 'Difficile', 'Très Difficile', 'Extrêmement difficile']),
            'notation_fr' => self::faker()->randomElement(['FEEEEEEE', 'PD', 'AD', 'D', 'TD', 'ED']),
            'notation_de' => self::faker()->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
            'colour' => self::faker()->unique()->hexColor()
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            ->afterInstantiate(function(DifficultyLevel $difficultyLevel) {
                return new DifficultyLevel();
            })
        ;
    }

    protected static function getClass(): string
    {
        return DifficultyLevel::class;
    }
}
