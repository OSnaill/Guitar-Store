<?php

namespace App\Controller\Api;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use App\Repository\GuitarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/brand', name: 'app_api_brand_')]
class BrandController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(BrandRepository $brandRepository): JsonResponse
    {

        return $this->json($brandRepository->findAll(),200, [], ['groups' => 'brand_list']);
    }

    #[Route('/create', name:'create', methods:['GET','POST'])]
    public function create(BrandRepository $brandRepository, Request $request): JsonResponse
    { 
        $data = json_decode($request->getContent(), true);


        if($brandRepository->findOneBy(['name'=>$data['brand']]))
        {
            return $this->json(
                'Brand already exist',
                303
            );
        }
       
        $newBrand = new Brand();
        $newBrand->setName($data['brand']);
        $brandRepository->save($newBrand, true);

        return $this->json(['message' => 'Okay']);
    }

    #[Route('/{id}/edit', name:'edit', methods:['GET','POST'])]
    public function edit(BrandRepository $brandRepository, Request $request, $id): JsonResponse
    { 
        $data = json_decode($request->getContent(), true);


        if($brandRepository->findOneBy(['name'=>$data['brand']]))
        {
            return $this->json(
                'Brand already exist',
                303
            );
        }
       
        $newBrand = $brandRepository->find($id);
        $newBrand->setName($data['brand']);
        $brandRepository->save($newBrand, true);

        return $this->json(['message' => 'Okay']);
    }

    #[Route('/{id}/delete', name:'delete', methods:['GET','DELETE'])]
    public function delete(BrandRepository $brandRepository, GuitarRepository $guitarRepository,  Request $request, $id): JsonResponse
    { 
        $data = json_decode($request->getContent(), true);
        $guitarsToDelete = $guitarRepository->findBy(['brand' => $id]);
        foreach($guitarsToDelete as $guitar )
        {
            $guitarRepository->remove($guitar, true);
        }
        $brand = $brandRepository->find($id);
        $brandRepository->remove($brand, true);

        return $this->json(['message' => 'Okay']);
    }
}
