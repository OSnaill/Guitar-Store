<?php

namespace App\Controller\Api;

use App\Entity\Guitar;
use App\Repository\BrandRepository;
use App\Repository\GuitarRepository;
use JMS\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/guitars', name: 'app_api_guitar_')]
class GuitarController extends AbstractController
{


    #[Route('/', name:'list', methods:'GET')]
    public function index(GuitarRepository $guitarRepository, BrandRepository $brandRepository): JsonResponse
    {
        $guitars = $guitarRepository->findAllForShow();

        return $this->json($guitars, 200,[], ['groups' => 'list'],);
    }

    #[Route('/{id}', name:'read')]
    public function read(GuitarRepository $guitarRepository, Guitar $guitar, BrandRepository $brandRepository): JsonResponse
    {
        $singleGuitar = $guitarRepository->findForDetail($guitar->getId());
        return $this->json($singleGuitar, 200, [], ['groups' => 'detail']);
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
