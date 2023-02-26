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
        // Fetch blog post data and return it to the view
        return $this->render('post/index.html.twig', [
            'posts' => $this->postRepository->findBy([], ['createdAt' => 'DESC'])
        ]);
    }

    #[Route('/post/create', name: 'post_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $post = new Post();

        // creating form object for Blog form
        $form = $this->createForm(PostFormType::class, $post);

        // handle blog post form request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // set data from form
            $newPost = $form->getData();

            // persist the blog content in database
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
        // fetch blog post with slug column from route parameter
        $post = $this->postRepository->findOneBy([
            'slug' => $slug
        ]);

        $comment = new Comment();

        // create form object for comments
        $form = $this->createForm(CommentFormType::class, $comment);

        // handle add comment request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // set comment data from form request
            $data = $form->getData();

            // attach post in comment
            $data->setPost($post);

            // persist comment data in database
            $this->entityManager->persist($data);
            $this->entityManager->flush();

            // re-initialize comment object for new comment form to reset it
            $comment = new Comment();;
            $form = $this->createForm(CommentFormType::class, $comment);
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }
}
