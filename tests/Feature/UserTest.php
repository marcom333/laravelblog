<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function only_logged_user_can_view_its_projects()
    {
        $response = $this->get('/projects')->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_view_its_projects(){
        $this->actingAs(factory(\App\User::class)->create());
        $response = $this->get('/projects')->assertOk();
    }

    /** @test */
    public function authenticated_users_can_write_a_project(){
        $faker = \Faker\Factory::create();

        /* Login require */
        $this->actingAs(factory(\App\User::class)->create());

        $response = $this->post('/projects',
            [
                "title"=>$faker->catchPhrase(),
                "description"=>$faker->paragraph(3,true),
            ]
        );

        $this->assertCount(1, \App\Project::all());
    }

    /** @test */
    public function authenticated_users_can_write_a_task_in_project(){
        $faker = \Faker\Factory::create();
        /* Login require */
        $this->actingAs(factory(\App\User::class)->create());

        $project = factory(\App\Project::class)->create();

        $response = $this->post('projects/'.\App\Project::all()->first()->id.'/tasks',
            [
                "description"=>$faker->paragraph(3,true),
                "finished"=>$faker->boolean(),
            ]
        );

        $this->assertCount(1, \App\Task::all());
    }


    /** @test */
    public function only_logged_users_can_write_a_project(){
        $faker = \Faker\Factory::create();

        $response = $this->post('/projects',
            [
                "title"=>$faker->catchPhrase(),
                "description"=>$faker->paragraph(3,true),
            ]
        );
        $this->assertCount(0, \App\Project::all());
    }

    /** @test */
    public function only_logged_users_can_write_a_task_in_project(){
        $faker = \Faker\Factory::create();
        /* creating user for project */
        factory(\App\User::class)->create();
        $project = factory(\App\Project::class)->create();
        $response = $this->post('projects/'.\App\Project::all()->first()->id.'/tasks',
            [
                "description"=>$faker->paragraph(3,true),
                "finished"=>$faker->boolean(),
            ]
        );
        $this->assertCount(0, \App\Task::all());
    }


    

}
