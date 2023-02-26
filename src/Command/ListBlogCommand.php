<?php

namespace App\Command;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'list-blog',
    description: 'Lists all blog posts in the database',
)]
class ListBlogCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        // Get all blog posts, sorted by creation date in descending order
        $posts = $this->entityManager->getRepository(Post::class)->findBy([], ['createdAt' => 'DESC']);

        // Define the table headers
        $headers = ['Title', 'Slug', 'Created At'];

        // Define the table rows
        $rows = [];
        foreach ($posts as $post) {
            $rows[] = [$post->getTitle(), $post->getSlug(), $post->getCreatedAt()->format('Y-m-d H:i:s')];
        }

        // Output the table
        $table = new Table($output);
        $table
            ->setHeaders($headers)
            ->setRows($rows)
            ->render();

        return Command::SUCCESS;
    }
}
