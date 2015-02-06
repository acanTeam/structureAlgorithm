<?php

namespace Structure\Util;

use Structure\Base\AbstractObject;

/**
 * A multiplicative linear congruential pseudo-random number generator.
 * Adapted from the minimal standard pseudo-random number generator
 * described in Stephen K. Park and Keith W. Miller,
 * "Random Number Generators: Good Ones Are Hard To Find,"
 * Communications of the ACM, Vol. 31, No. 10, Oct. 1988, pp. 1192-1201.
 *
 * @static
 */
class RandomNumberGenerator extends AbstractObject
{
    /**
     * @var integer The seed for the pseudo-random number generator.
     */
    private static $seed = 1;

    /**
     * The multiplicative coefficient.
     */
    const a = 16807;

    /**
     * The modulus.
     */
    const m = 2147483647;

    /**
     * q=m div a.
     */
    const q = 127773;

    /**
     * r=m mod a.
     */
    const r = 2836;

    /**
     * Sets the seed to the specified value.
     * @param integer s The desired seed.
     */
    public static function setSeed($s)
    {
        if ($s < 1 || $s >= self::m) {
            throw new \Structure\Exception\ArgumentException;
        }
        self::$seed = $s;
    }

    /**
     * Returns the next pseudo-random number in the sequence.
     * The numbers returned are uniformly distributed in the interval (0,1].
     *
     * @return float The next pseudo-random number in the sequence.
     */
    public static function next()
    {
        self::$seed = self::a * (self::$seed % self::q) -
            self::r * intval(self::$seed / self::q);

        if (self::$seed < 0) {
            self::$seed += self::m;
        }
        return self::$seed / self::m;
    }
}
