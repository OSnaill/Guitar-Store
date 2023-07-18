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
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/api/guitars', name: 'app_api_guitar_')]
class GuitarController extends AbstractController
{


    #[Route('/', name:'index', methods:'GET')]
    public function index(GuitarRepository $guitarRepository, BrandRepository $brandRepository): JsonResponse
    {
        $guitars = $guitarRepository->findEightForShow();

        return $this->json($guitars, 200,[], ['groups' => 'list'],);
    }

    #[Route('/all', name:'all', methods:'GET')]
    public function showAll(GuitarRepository $guitarRepository, BrandRepository $brandRepository): JsonResponse
    {
        $guitars = $guitarRepository->findAllForShow();

        return $this->json($guitars, 200,[], ['groups' => 'list'],);
    }

    #[Route('/filter', name:'filter', methods:'GET')]
    public function filter(GuitarRepository $guitarRepository, BrandRepository $brandRepository, Request $request): JsonResponse
    {
        $brand = $request->query->get('brand');
        $price = $request->query->get('price');
        $guitars = $guitarRepository->findFilteredGuitars($brand);
        return $this->json($guitars, 200,[], ['groups' => 'list'],);
    }

    #[Route('/{id}/read', name:'read', methods:'GET')]
    public function read(GuitarRepository $guitarRepository, Guitar $guitar, BrandRepository $brandRepository): JsonResponse
    {
        $singleGuitar = $guitarRepository->findForDetail($guitar->getId());
        return $this->json($singleGuitar, 200, [], ['groups' => 'detail']);
    }

    #[Route('/create', name:'create', methods:['GET','POST'])]
    public function create(GuitarRepository $guitarRepository, BrandRepository $brandRepository, Request $request, SluggerInterface $slugger): JsonResponse
    { 
        $data = json_decode($request->getContent(), true);
       
        $imageFile = $request->files->get('image');


        $newGuitar = new Guitar();
        $newGuitar->setReference($request->request->get('reference'));
        
        $newGuitar->setPrice($request->request->get('price'));
        
        $newGuitar->setBrand($brandRepository->findOneBy(['name' => $request->request->get('brand')]));
        if($imageFile)
        {
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
            $imageFile->move(
                $this->getParameter('brochures_directory'),
                $newFilename
            );
        }
        $newGuitar->setImageName($newFilename);
        // return $this->json(['message' => 'Okay']);
        $guitarRepository->save($newGuitar, true);
        return $this->json(['message' => 'Okay']);
    }


    #[Route('/{id}/edit', name:'edit', methods:['GET','POST'])]
    public function edit(GuitarRepository $guitarRepository, BrandRepository $brandRepository, Request $request, SluggerInterface $slugger, $id): JsonResponse
    { 
        $data = json_decode($request->getContent(), true);
       
        
        $imageFile = $request->files->get('image');

        $guitar = $guitarRepository->find($id);

        if($request->request->get('reference') != null)
        {
            $guitar->setReference($request->request->get('reference'));
        }
        
        if($request->request->get('price') != null)
        {
            $guitar->setPrice($request->request->get('price'));
        }
        if($request->request->get('brand') != null)
        {
            $guitar->setBrand($brandRepository->findOneBy(['name' => $request->request->get('brand')]));
        }
        
        if($imageFile)
        {
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
            $imageFile->move(
                $this->getParameter('brochures_directory'),
                $newFilename
            );
            $guitar->setImageName($newFilename);
        }
        
        // return $this->json(['message' => 'Okay']);
        $guitarRepository->save($guitar, true);
        return $this->json(['message' => 'Okay']);
    }

    #[Route('/{id}/delete', name:'delete', methods:['DELETE'])]
    public function delete(GuitarRepository $guitarRepository, Request $request, Guitar $guitar)
    {
        $guitarRepository->remove($guitar, true);

        return $this->json(['message' => 'guitare supprimée']);
    }
}
