<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_original_filename_upload()
    {
        Storage::fake('logos');
        $filename = 'logo.jpg';

        $response = $this->post('projects', [
            'name' => 'Some name',
            'logo' => UploadedFile::fake()->image($filename)
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('projects', [
            'name' => 'Some name',
            'logo' => $filename
        ]);
    }
}
