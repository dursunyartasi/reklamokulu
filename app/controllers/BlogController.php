<?php

class BlogController
{
    public function index(): void
    {
        require_once __DIR__ . '/../models/Blog.php';
        $blogModel = new Blog();

        $page = max(1, (int) ($_GET['sayfa'] ?? 1));
        $perPage = 9;
        $offset = ($page - 1) * $perPage;

        $posts = $blogModel->getPublished($perPage, $offset);
        $totalPosts = $blogModel->countPublished();
        $totalPages = ceil($totalPosts / $perPage);

        $pageTitle = 'Blog';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/blog/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function show(string $slug): void
    {
        require_once __DIR__ . '/../models/Blog.php';
        $blogModel = new Blog();
        $post = $blogModel->findBySlug($slug);

        if (!$post) {
            http_response_code(404);
            require __DIR__ . '/../views/layouts/404.php';
            return;
        }

        $recentPosts = $blogModel->getPublished(5);

        $pageTitle = $post['title'];
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/blog/show.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}