<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentFormType;
use App\Form\PostFormType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private $entityManager;
    private $postRepository;

    /**
     * @param EntityManagerInterface $entityManager
     * @param PostRepository $postRepository
     */
    public function __construct(EntityManagerInterface $entityManager, PostRepository $postRepository)
    {
        $this->entityManager = $entityManager;
        $this->postRepository = $postRepository;
    }

    /**
     * @return Response
     * Route to display all blogs
     */
    #[Route('/post', name: 'post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $this->postRepository->findBy([], ['createdAt' => 'DESC'])
        ]);
    }

    #[Route('/post/create', name: 'post_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newPost = $form->getData();

            $this->entityManager->persist($newPost);
            $this->entityManager->flush();

            return $this->redirectToRoute('post');
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/post/{slug}', name: 'post_show')]
    public function show(Request $request, $slug): Response
    {
        $post = $this->postRepository->findOneBy([
            'slug' => $slug
        ]);

        $comment = new Comment();;
        $form = $this->createForm(CommentFormType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $data->setPost($post);

            $this->entityManager->persist($data);
            $this->entityManager->flush();

            $comment = new Comment();;
            $form = $this->createForm(CommentFormType::class, $comment);
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }
}
