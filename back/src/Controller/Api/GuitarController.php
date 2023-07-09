<?php

namespace App\Controller\Api;

use App\Entity\Guitar;
use App\Repository\BrandRepository;
use App\Repository\GuitarRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/guitars', name: 'app_api_guitar_')]
class GuitarController extends AbstractController
{
    #[Route('/', name:'list')]
    public function index(GuitarRepository $guitarRepository): JsonResponse
    {
        return $this->json($guitarRepository->findAll());
    }

    #[Route('/read', name:'read')]
    public function read(GuitarRepository $guitarRepository, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(!$guitarRepository->find($data["id"]))
        {
            return $this->json(
                'Not Found', 404
            );
        }
        return $this->json($guitarRepository->find());
    }

    #[Route('/create', name:'create', methods:['GET', 'POST'])]
    public function create(GuitarRepository $guitarRepository, BrandRepository $brandRepository, Request $request): JsonResponse
    { 
        $data = json_decode($request->getContent(), true);

        if($guitarRepository->findBy(['reference' => $data['ref']]))
        {
            return $this->json(
                'Already exist',
                303
            );
        }

        if(!$brandRepository->find($data['brand_id']))
        {
            return $this->json(
                'Brand doesn\'t exist',
                303
            );
        }

        $newGuitar = new Guitar();
        $newGuitar->setReference($data['ref']);
        $newGuitar->setBrand($brandRepository->find($data["brand_id"]));
        if($request->files->get('image'))
        {
            // $brochureFileName = $fileUploader->upload($request->files->get('image'));
            // $newGuitar->setImage($brochureFileName);
        } else {
            $newGuitar->setImage('/guitars/guitar_base.png');
        }       

        return $this->json(
            $newGuitar->getImage()
        );
    }
}
