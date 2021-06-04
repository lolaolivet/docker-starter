<?php

namespace App\Factory;

use App\Entity\Feedback;
use App\Repository\FeedbackRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Feedback|Proxy createOne(array $attributes = [])
 * @method static Feedback[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Feedback|Proxy find($criteria)
 * @method static Feedback|Proxy findOrCreate(array $attributes)
 * @method static Feedback|Proxy first(string $sortedField = 'id')
 * @method static Feedback|Proxy last(string $sortedField = 'id')
 * @method static Feedback|Proxy random(array $attributes = [])
 * @method static Feedback|Proxy randomOrCreate(array $attributes = [])
 * @method static Feedback[]|Proxy[] all()
 * @method static Feedback[]|Proxy[] findBy(array $attributes)
 * @method static Feedback[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Feedback[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static FeedbackRepository|RepositoryProxy repository()
 * @method Feedback|Proxy create($attributes = [])
 */
final class FeedbackFactory extends ModelFactory
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
            'rate' => self::faker()->numberBetween(0, 7),
            'date' => self::faker()->dateTimeThisDecade(),
            'comment' => self::faker()->paragraph(),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            ->afterInstantiate(function(Feedback $feedback) {
                return new Feedback();
            })
        ;
    }

    protected static function getClass(): string
    {
        return Feedback::class;
    }
}
