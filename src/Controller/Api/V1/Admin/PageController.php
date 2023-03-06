<?php

namespace App\Controller\Api\V1\Admin;

use App\Attribute\RequestBody;
use App\Model\Request\PageRequest;
use App\Services\Admin\PageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('pages', name: 'page.')]
class PageController extends AbstractController
{
    public function __construct(private readonly PageService $pageService)
    {
    }

    #[Route('/', name: 'index', methods: 'GET')]
    public function index(Request $request): JsonResponse
    {
        return $this->json($this->pageService->getPage(
            $request->query->get('page', 1)
        ));
    }

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): JsonResponse
    {
        return $this->json($this->pageService->getOne($id));
    }

    #[Route('/', name: 'create', methods: 'POST')]
    public function create(#[RequestBody] PageRequest $request): JsonResponse
    {
        return $this->json($this->pageService->create($request), Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'update', methods: 'PUT')]
    public function update(int $id, #[RequestBody] PageRequest $request): JsonResponse
    {
        return $this->json($this->pageService->update($id, $request));
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $this->pageService->remove($id);

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
