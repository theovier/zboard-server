<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder {

    public function run() {
        Post::factory()->create([
            'title' => 'Super-Papagei entflogen',
            'content' => 'Hey! Du hast ja wohl \'n Vogel!
                          Hoffentlich unseren! Unser Vogel "Blacky" ist entfolgen.
                          Er ist klein, schwarz und geschwätzig.
                          Wenn Du ihn gesehen hast, schreib uns bitte!',
            'author_id' => 1
        ]);

        Post::factory()->create([
            'title' => 'Launch Partner gesucht',
            'content' => 'Howdy, suche für heute Mittag noch jemanden,
                          der mit mir zusammen in der Mensa den veganen Eintopf essen möchte.',
            'author_id' => 4
        ]);

        Post::factory()->create([
            'title' => 'Biete Nachhilfe in englischer Literatur',
            'content' => 'Biete kostenlose Nachhilfe in englischer Literatur heute um 16:00 im Raum 404 an.',
            'author_id' => 2
        ]);

        Post::factory()->create([
            'title' => 'Verkaufe Surfboard',
            'content' => 'Schwerenherzens verkaufe ich mein neues Surfboard. Das Brett ist kaum benutzt und
                          ich hab auch irgendwo noch die Quittung!
                          Schickt mir einfach eure Preisvorstellung als Antwort auf diesen Post!',
            'author_id' => 3
        ]);

        Post::factory()->create([
            'title' => 'Kegelklub sucht Verstärkung!',
            'content' => 'Wir suchen Dich! Unser Kegelklub "Les Miserabowls" braucht dringend Verstärkung!
                          Wir treffen uns immer Montag Abends um 20:00 Uhr im Klubhaus an der Musterstraße.
                          Anfänger sind auch gerne willkommen!',
            'author_id' => 5
        ]);

        Post::factory()->create([
            'title' => 'Party People!111!',
            'content' => 'Dicke Fete auf dem Campus am Sonntag! Ihr seid alle eingeladen.',
            'author_id' => 6
        ]);

        Post::factory()->create([
            'title' => 'Verkaufe Tiger',
            'content' => '5 Jahre alt, 178cm groß, orange-schwarz gestreift. Er
						ist ganz lieb und zutraulich. Er war der Tiger in
						Hangover. Er isst hauptsächlich nervige
						Menschen, die nicht anklopfen.',
            'author_id' => 7
        ]);

        Post::factory()->create([
            'title' => 'Karten für das Spiel Dortmund-Schalke abzugeben',
            'content' => 'Da ich es am Samstag leider nicht schaffe selbst in Stadtion zu gehen, verschenke ich meine Karte.',
            'author_id' => 5
        ]);

        Post::factory()->create([
            'title' => 'Wer das hier liest...',
            'content' => 'dem wünsche ich einen unglaublich schönen Tag! :-)',
            'author_id' => 8
        ]);
    }
}
