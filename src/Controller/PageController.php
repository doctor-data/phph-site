<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends Controller
{

    /**
     * @Route("/videos", name="videos")
     * @Method("GET")
     * @return Response
     */
    public function videos()
    {
        $videos = null;
        try {
            $repo = $this->getDoctrine()->getRepository('App:Talk');
            $qb   = $repo->createQueryBuilder('a');
            $qb->where($qb->expr()->not($qb->expr()->eq('a.youtubeId', '?1')));
            $qb->setParameter(1, '');

            $videos = $qb->getQuery()
                         ->getResult();
        } catch (\Exception $e) {
            $session = $this->get('session');
            $session->getFlashBag()->add(
                'warning',
                "Sorry, we can't access the video storage right now"
            );
        }

        return $this->render(
            'page/videos.html.twig',
            [
                'talksWithVidoes' => $videos,
            ]
        );
    }

    /**
     * @Route("/meetups", name="meetups")
     * @Method("GET")
     * @return Response
     */
    public function meetups()
    {
        $talks = null;
        try {
            $repo = $this->getDoctrine()->getRepository('App:Talk');
            $talks  = $repo->findAll();
        } catch (\Exception $e) {
            $session = $this->get('session');
            $session->getFlashBag()->add(
                'warning',
                "Sorry, we can't access the meet storage right now"
            );
        }

        return $this->render(
            'page/meetups.html.twig',
            [
                'talks' => $talks,
            ]
        );
    }

    /**
     * @Route("{slug}", name="page")
     * @Method("GET")
     * @param $slug
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function default($slug = '/'): ?Response
    {
        try {
            $slug = $slug === '/' ? 'index' : $slug;

            return $this->render("page/$slug.html.twig");
        } catch (\Exception $ex) {

            $message = 'This page does not exist'.PHP_EOL;
            if ($this->container->get('kernel')->getEnvironment() === 'dev') {
                $message .= $ex->getMessage();
            }

            throw $this->createNotFoundException($message);
        }
    }
}
