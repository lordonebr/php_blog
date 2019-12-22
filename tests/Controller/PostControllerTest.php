<?php

namespace App\Tests\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Doctrine\ORM\Tools\SchemaTool;

final class PostControllerTest extends WebTestCase
{
    private EntityManagerInterface $em;
    private KernelBrowser $client;

    public function setUp(): void {

        $this->client = self::createClient();

        // cria a ferramenta para manipulação do banco de dados
        $this->em = self::$kernel->getContainer()->get('doctrine')->getManager();
        $tool = new SchemaTool($this->em);
        
        // recupera a tabela associada a entidade post
        $metadata = $this->em->getClassMetadata(Post::class);

        // apaga a tabela associada a entidade post
        $tool->dropSchema([$metadata]);

        try {
            // cria a tabela post
            $tool->createSchema([$metadata]);
        } catch (ToolsExceptions $e) {
            $this->fail("Impossivel criar tabela post". $e->getMessage());
        }
    }  

    public function test_create_post(): void
    {
        $this->client->request('POST', '/posts', [], [], [], json_encode([
            'title' => 'Primeiro Teste Funcional',
            'description' => 'Alguma descrição'
        ]));
        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }

    public function test_update_post(): void 
    {
        $post = new Post('teste titulo', 'teste descrição');
        $this->em->persist($post);
        $this->em->flush();
        
        $this->client->request('PUT','/posts/1', [], [], [], json_encode([
            'title' => 'novo titulo',
            'description' => 'nova descrição'
            ]));    
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function test_delete_post(): void
    {
        $post = new Post('teste titulo', 'teste descrição');
        $this->em->persist($post);
        $this->em->flush();

        $this->client->request('DELETE', '/posts/1', [], [], [], null);
        $this->assertEquals(Response::HTTP_NO_CONTENT, $this->client->getResponse()->getStatusCode());
    }

    public function test_list_post(): void
    {
        $post = new Post('teste titulo', 'teste descrição');
        $this->em->persist($post);
        $this->em->flush();

        $this->client->request('GET', '/posts', [], [], [], null);
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function test_post_details(): void
    {
        $post = new Post('teste titulo', 'teste descrição');
        $this->em->persist($post);
        $this->em->flush();

        $this->client->request('GET', '/posts/1', [], [], [], null);
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function test_invalid_post_details(): void
    {
        $this->client->request('GET', '/posts/1', [], [], [], null);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }
    
    public function test_invalid_update_post(): void
    {
        $this->client->request('PUT','/posts/1', [], [], [], json_encode([
            'title' => 'novo titulo',
            'description' => 'nova descrição'
            ])); 
        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }

    public function test_invalid_delete_post(): void
    {
        $this->client->request('DELETE', '/posts/1', [], [], [], null);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }

    /*public function test_create_post_with_invalid_title(): void
    {
        $this->client->request('POST', '/posts',[],[],[], json_encode([
            'title' => 1234,
            'description' => 'Alguma descrição'
        ]));
        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR , $this->client->getResponse()->getStatusCode());
    }*/
}