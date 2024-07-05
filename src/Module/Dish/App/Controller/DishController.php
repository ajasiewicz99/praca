<?php

namespace App\Module\Dish\App\Controller;

use App\Module\Dish\App\Form\DishType;
use App\Module\Dish\Domain\Entity\Dish;
use App\Module\Dish\Domain\Service\DishServiceInterface;
use App\Module\Dish\Domain\Service\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dish')]
class DishController extends AbstractController
{
    public function __construct(private DishServiceInterface $dishService, private ProductServiceInterface $productService)
    {
    }

    #[Route('/', name: 'dish_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('dish/index.html.twig', [
            'dishes' => $this->dishService->getAllDishes(),
        ]);
    }

    #[Route('/new', name: 'dish_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $dish = new Dish();
        $form = $this->createForm(DishType::class, $dish, [
            'products' => $this->productService->getAllProducts(),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $products = [];
            foreach ($request->request->all()['form']['dishProducts'] as $product) {
                $products[] = ['product' => $this->productService->getProductById($product['product']['id']), 'grams' => $product['grams']];
            }
            $this->dishService->saveDish($dish, $products);

            return $this->redirectToRoute('dish_index');
        }

        return $this->render('dish/new.html.twig', [
            'dish' => $dish,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'dish_show', methods: ['GET'])]
    public function show(Dish $dish): Response
    {
        return $this->render('dish/show.html.twig', [
            'dish' => $this->dishService->getDishById($dish->getId()),
        ]);
    }

    #[Route('/{id}/edit', name: 'dish_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dish $dish): Response
    {
        $form = $this->createForm(DishType::class, $dish, [
            'products' => $this->productService->getAllProducts(),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $products = [];
            if (isset($request->request->all()['form'])) {
                foreach ($request->request->all()['form']['dishProducts'] as $product) {
                    $products[] = ['product' => $this->productService->getProductById($product['product']['id']), 'grams' => $product['grams']];
                }
            }
            $this->dishService->saveDish($dish, $products);

            return $this->redirectToRoute('dish_index');
        }

        return $this->render('dish/edit.html.twig', [
            'dish' => $dish,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'dish_delete', methods: ['POST'])]
    public function delete(Request $request, Dish $dish): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dish->getId(), $request->request->get('_token'))) {
            $this->dishService->deleteDish($dish);
        }

        return $this->redirectToRoute('dish_index');
    }
}
