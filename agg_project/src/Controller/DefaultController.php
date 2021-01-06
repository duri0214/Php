<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\GiftsService;
use App\Service\MyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class DefaultController
 *
 * @author "Yoshitaka Okada <yoshi@gmail.com>"
 */
class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default")
     * @param GiftsService $gifts
     * @param MyService $myService
     * @return Response
     */
    public function index(GiftsService $gifts, MyService $myService)
    {
        // Doctrineの組み方わかってきたな！InnerJoin先のprice>0を抽出
        // $users = $this->getDoctrine()->getRepository(User::class)->findByOverThan(0);
        $users = $this->getDoctrine()->getRepository(User::class)->findUsingSubQuery([1, 2]);

        VarDumper::dump(
            [
                '$users' => $users,
                '$gifts' => $gifts,
                '$results' => $myService->getMessagesOver0(),
            ]
        );

        return $this->render(
            'default/index.html.twig',
            [
                'controller_name' => 'DefaultController',
                'users' => $users,
                'random_gift' => $gifts,
                'results' => $myService->getMessagesOver0(),
            ]
        );
    }
}
