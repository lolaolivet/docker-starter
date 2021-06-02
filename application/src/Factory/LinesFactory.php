<?php

namespace App\Factory;

use App\Entity\Lines;
use App\Repository\LinesRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Lines|Proxy createOne(array $attributes = [])
 * @method static Lines[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Lines|Proxy find($criteria)
 * @method static Lines|Proxy findOrCreate(array $attributes)
 * @method static Lines|Proxy first(string $sortedField = 'id')
 * @method static Lines|Proxy last(string $sortedField = 'id')
 * @method static Lines|Proxy random(array $attributes = [])
 * @method static Lines|Proxy randomOrCreate(array $attributes = [])
 * @method static Lines[]|Proxy[] all()
 * @method static Lines[]|Proxy[] findBy(array $attributes)
 * @method static Lines[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Lines[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LinesRepository|RepositoryProxy repository()
 * @method Lines|Proxy create($attributes = [])
 */
final class LinesFactory extends ModelFactory
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
            'name' => self::faker()->unique()->city(),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            ->afterInstantiate(function(Lines $lines) {
                return new Lines();
            })
        ;
    }

    protected static function getClass(): string
    {
        return Lines::class;
    }
}
