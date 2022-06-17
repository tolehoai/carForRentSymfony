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
        Request            $request,
        ListCarRequest     $listCarRequest,
        ValidatorInterface $validator,
        CarRepository      $carRepository,
    ): Response
    {
        $query = $request->query->all();
        $params = ['order', 'color', 'brand', 'seats'];
        $listCarParams = $listCarRequest->fromArray($query)->transfer($params, $listCarRequest);
        dd($listCarParams);
        $errors = $validator->validate($listCarParams);

        return $this->json([]);
    }


}
