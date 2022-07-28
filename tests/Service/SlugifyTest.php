<?php

namespace App\Tests\Service;

use App\Service\Slugify;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class SlugifyTest extends TestCase
{
    public function testGenerate(): void
    {
        $slugify = new Slugify();
        assertEquals('games-of-thrones', $slugify->generate('games of thrones'));
        assertEquals('cinquieme-symphonie-de-beethoven', $slugify->generate(' cinquiéme symphonie  de Beethoven'));
        assertEquals('prelude-a-l-apres-midi-d-un-faune', $slugify->generate('Prélude à l\'aprés-midi d\'un faune'));
    }
}