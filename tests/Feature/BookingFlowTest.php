<?php

namespace Tests\Feature;

use App\Models\Paket;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BookingFlowTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('role')->default('user');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->text('facilities')->nullable();
            $table->timestamps();
        });

        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('paket_id');
            $table->string('bride_name', 100)->nullable();
            $table->string('groom_name', 100)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->text('contact_address')->nullable();
            $table->date('event_date');
            $table->time('event_time')->nullable();
            $table->string('event_location', 150)->nullable();
            $table->text('event_address')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('final_price', 10, 2)->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function test_booking_form_shows_the_new_event_details(): void
    {
        $user = User::factory()->create();
        $paket = Paket::create([
            'name' => 'Gold',
            'price' => 120000000,
            'description' => 'Paket pernikahan lengkap.',
            'facilities' => 'Dekorasi, katering',
        ]);

        $this->actingAs($user)
            ->get(route('booking.create', $paket->id))
            ->assertOk()
            ->assertSee('Nama calon pengantin wanita')
            ->assertSee('Nomor telepon / WhatsApp')
            ->assertSee('Alamat domisili')
            ->assertSee('Tanggal acara')
            ->assertSee('Alamat lengkap lokasi acara');
    }

    public function test_booking_submission_saves_contact_and_event_details(): void
    {
        $user = User::factory()->create();
        $paket = Paket::create([
            'name' => 'Gold',
            'price' => 120000000,
            'description' => 'Paket pernikahan lengkap.',
            'facilities' => 'Dekorasi, katering',
        ]);

        $this->actingAs($user)
            ->post(route('booking.store', $paket->id), [
                'bride_name' => 'Alya Putri',
                'groom_name' => 'Raka Pratama',
                'contact_phone' => '+6281234567890',
                'contact_address' => 'Jl. Mawar No. 10, Malang',
                'tanggal_acara' => '2027-06-20',
                'waktu_acara' => '10:30',
                'event_location' => 'Graha Bahagia',
                'event_address' => 'Jl. Raya Tlogomas, Malang',
                'catatan' => 'Dekorasi bernuansa putih dan rose gold.',
            ])
            ->assertRedirect(route('user.dashboard'));

        $this->assertDatabaseHas('booking', [
            'user_id' => $user->id,
            'paket_id' => $paket->id,
            'bride_name' => 'Alya Putri',
            'groom_name' => 'Raka Pratama',
            'contact_phone' => '+6281234567890',
            'contact_address' => 'Jl. Mawar No. 10, Malang',
            'event_date' => '2027-06-20',
            'event_time' => '10:30',
            'event_location' => 'Graha Bahagia',
            'event_address' => 'Jl. Raya Tlogomas, Malang',
            'notes' => 'Dekorasi bernuansa putih dan rose gold.',
            'status' => 'pending',
        ]);
    }
}
