<?php

namespace App\Controller\API;

use App\Repository\CarRepository;
use App\Request\ListCarRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CarController extends AbstractController
{

    #[Route('/api/car', name: 'app_api_car')]
    public function list(
        Request $request,
        ListCarRequest $listCarRequest,
        ValidatorInterface $validator,
        CarRepository $carRepository,
    ): Response {
        $query = $request->query->all();
        $listCarParams = $listCarRequest->fromArray($query);
        $errors = $validator->validate($listCarParams);
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );
        $collection = new ArrayCollection([$listCarParams]);
        dd($collection);
        $arr = $serializer->deserialize($collection, 'Request\ListCarRequest[]', 'json');
        dd($arr);
        return $this->json([]);
    }


}
