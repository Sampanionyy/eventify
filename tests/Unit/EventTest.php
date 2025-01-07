<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test la création d'un événement.
     *
     * @return void
     */
    public function test_event_creation()
    {
        // Créer une catégorie
        $category = Category::create([
            'name' => 'Musique',
        ]);

        // Créer un événement
        $event = Event::create([
            'title' => 'Concert de Rock',
            'description' => 'Un concert de rock incroyable!',
            'date' => '2025-01-01',
            'location' => 'Paris',
            'category_id' => $category->id,
            'available_seats' => 200,
        ]);

        // Vérifier si l'événement a bien été créé dans la base de données
        $this->assertDatabaseHas('events', [
            'title' => 'Concert de Rock',
            'description' => 'Un concert de rock incroyable!',
            'date' => '2025-01-01',
            'location' => 'Paris',
            'category_id' => $category->id,
            'available_seats' => 200,
        ]);
    }

    /**
     * Test de la mise à jour d'un événement.
     *
     * @return void
     */
    public function test_event_update()
    {
        // Créer une catégorie
        $category = Category::create([
            'name' => 'Musique',
        ]);

        // Créer un événement
        $event = Event::create([
            'title' => 'Concert de Rock',
            'description' => 'Un concert de rock incroyable!',
            'date' => '2025-01-01',
            'location' => 'Paris',
            'category_id' => $category->id,
            'available_seats' => 200,
        ]);

        // Mettre à jour l'événement
        $event->update([
            'title' => 'Concert Pop',
            'description' => 'Un concert pop sensationnel!',
            'location' => 'Lyon',
            'available_seats' => 150,
        ]);

        // Vérifier si l'événement a été mis à jour dans la base de données
        $this->assertDatabaseHas('events', [
            'title' => 'Concert Pop',
            'description' => 'Un concert pop sensationnel!',
            'location' => 'Lyon',
            'available_seats' => 150,
        ]);
    }

    /**
     * Test de la suppression d'un événement.
     *
     * @return void
     */
    public function test_event_delete()
    {
        // Créer une catégorie
        $category = Category::create([
            'name' => 'Musique',
        ]);

        // Créer un événement
        $event = Event::create([
            'title' => 'Concert de Rock',
            'description' => 'Un concert de rock incroyable!',
            'date' => '2025-01-01',
            'location' => 'Paris',
            'category_id' => $category->id,
            'available_seats' => 200,
        ]);

        // Supprimer l'événement
        $event->delete();

        // Vérifier si l'événement a bien été supprimé de la base de données
        $this->assertDatabaseMissing('events', [
            'title' => 'Concert de Rock',
            'description' => 'Un concert de rock incroyable!',
            'location' => 'Paris',
            'available_seats' => 200,
        ]);
    }

    /**
     * Test de la validation des données d'un événement.
     *
     * @return void
     */
    public function test_event_validation()
    {
        // Essayer de créer un événement sans titre (devrait échouer)
        $response = $this->post('/events', [
            'description' => 'Un concert sans titre.',
            'date' => '2025-01-01',
            'location' => 'Paris',
            'category_id' => 1,
            'available_seats' => 200,
        ]);

        // Vérifier que la validation échoue
        $response->assertSessionHasErrors('title');
    }
}
