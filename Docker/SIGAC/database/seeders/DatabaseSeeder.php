<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(EixoSeeder::class);   
        $this->call(NivelSeeder::class);
        $this->call(CursoSeeder::class);    
        $this->call(RoleSeeder::class);    
        $this->call(ResourceSeeder::class);    
        $this->call(PermissionSeeder::class);    
        $this->call(TurmaSeeder::class);    
        $this->call(CategoriaSeeder::class);    
        $this->call(UserSeeder::class);    
        $this->call(AlunoSeeder::class);    
        $this->call(ComprovanteSeeder::class);    
        $this->call(DeclaracaoSeeder::class);    
    }
}
